import { boot } from 'quasar/wrappers'
import Keycloak from 'keycloak-js'

const keycloak = Keycloak({
  url: "https://auth.rafaelcoldebella.com.br",
  realm: "meusite",
  clientId: "meusite"
})

export default boot(({ app /* , store } */ }) => {

  // async function createRefreshTokenTimer(keycloak) {
  //   setInterval(() => {
  //     keycloak.updateToken(60).then((refreshed) => {
  //       if (refreshed) {
  //         console.log("Token refreshed" + refreshed)
  //       } else {
  //         // Do Something
  //       }
  //     }).catch(() => {
  //       console.log("Failed to refresh token")
  //     })
  //   }, 6000)
  // }

    app.config.globalProperties.$keycloak = keycloak
})

export { keycloak }
