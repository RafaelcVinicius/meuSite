<template>
  <router-view />
</template>

<script>
import { defineComponent } from 'vue';
import { mapActions } from 'pinia';
import { storeMain } from "stores/storeMain.js";
import keycloak from './boot/keycloak';

export default defineComponent({
  name: 'App',

  // created(){
  //   console.log(keycloak.authenticated);
  //   if(location.hash.includes('#state=')){
  //     setTimeout(()=>{
  //       this.loginKeycloak();
  //     },50)
  //   }
  // },

  methods:{
    ...mapActions(storeMain, ['loginKeycloak']),
  }
})
</script>
