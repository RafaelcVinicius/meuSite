import { defineStore } from 'pinia'
import { api } from "boot/axios";
import { keycloak } from "boot/keycloak.js";

export const storeMainWallet = defineStore('storeMainWallet', {
  state: () => ({
      wallet:{ff:"olá"},
  }),

  getters: {
    getWallet (state) {
      return state.wallet;
    }
  },

  actions: {
    setWallet(){
      api.get("/wallet", {
        headers: {
          Authorization: 'Bearer ' +  keycloak.token,
        }
      })
      .then((res) => {
        this.wallet = res;
      })
      .catch((error) => {
        console.log("error", error.response.data.message);
      });
    },

    storeWallet(){
      api.post("/wallet", {
        headers: {
          Authorization: 'Bearer ' +  keycloak.token,
        },
        data:{

        }
      })
      .then((res) => {
        console.log(res);
      })
      .catch((error) => {
        console.log("error", error.response.data.message);
      });
    },

    getWalletById(id){
      api.get("/wallet/" + id, {
        headers: {
          Authorization: 'Bearer ' +  keycloak.token,
        }
      })
      .then((res) => {
        console.log(res);
      })
      .catch((error) => {
        console.log("error", error.response.data.message);
      });
    },
  }
})
