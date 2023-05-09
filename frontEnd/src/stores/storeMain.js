import { defineStore } from 'pinia'
import { api } from "boot/axios";
import { keycloak } from "boot/keycloak.js";

export const storeMain = defineStore('storeMain', {
  state: () => ({
    user: {
      email:"",
      name:"",
      token:"",
    },
    keycloak: {},
  }),

  getters: {
    getCheckAuth (state) {
      return state.user.token.length > 0;
    }
  },

  actions: {
    loginKeycloak(){
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
    },

    logoutKeycloak(){
      cookieStore.delete('refreshToken');
      location.href = '/';

      keycloak.logout();
    },

    getTeste(){
      api.get("/app", {
        headers: {
          Authorization: 'Bearer ' +  keycloak.token,
        }
      })
      .then((res) => {
        console.log(res);
        // window.location.href = res.;
      })
      .catch((error) => {
        console.log("error", error.response.data.message);
      });
    },
  }
})
