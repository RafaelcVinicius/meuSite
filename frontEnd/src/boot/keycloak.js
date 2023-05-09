import { boot } from 'quasar/wrappers'
import Keycloak from 'keycloak-js'

const keycloak = Keycloak({
  url: "https://auth.rafaelcoldebella.com.br",
  realm: "meusite",
  clientId: "meusite"
})

export default boot(({ app /* , store } */ }) => {
  let cookie = document.cookie.split("; "),
  index = cookie.findIndex((e) => e.includes("refreshToken="));

  if(!(index > 0|| location.hash.includes('#state=')))
    return false;

  async function createRefreshTokenTimer(keycloak) {
    setInterval(() => {
      keycloak.updateToken(60).then((refreshed) => {
        if (refreshed) {
          console.log("Token refreshed" + refreshed)
        } else {
          // Do Something
        }
      }).catch(() => {
        console.log("Failed to refresh token")
      })
    }, 6000)
  }

  return new Promise(resolve => {
    keycloak.init({
        onLoad: "login-required",
        checkLoginIframe: false,
        enableLogging: true
    })
    .then(async (authenticated) => {
      if (authenticated) {
          document.cookie = 'refreshToken=' + keycloak.refreshToken;
          await createRefreshTokenTimer(keycloak);
          resolve()
      } else {
          console.log("Not authenticated");
          window.location.reload()
      }
    }).catch((error) => {
      console.log("Authentication failure", error)
      window.location.reload()
    });
    app.config.globalProperties.$keycloak = keycloak
    app.use(keycloak)
  })
})

export { keycloak }
