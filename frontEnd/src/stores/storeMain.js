import { defineStore } from 'pinia'
import { api } from "boot/axios";

export const storeMain = defineStore('storeMain', {
  state: () => ({
    user: {
      email:"",
      name:"",
      token:"",
    }
  }),

  getters: {
    getCheckAuth (state) {
      return state.user.token.length > 0;
    }
  },

  actions: {
    checkAuth () {
      let cookie = document.cookie.split("; "),
          index = cookie.findIndex((e) => e.includes("token="));
        console.log(index);

      if(index >= 0){
        console.log(index);
        return true;
      }
      return false;
    },

    getUrlLogin(){
      api
      .get("/login")
      .then((res) => {
        console.log(res);
        // window.location.href = res.;
      })
      .catch((error) => {
        console.log("error", error.response.data.message);
      });
    }
  }
})
