<template>
  <q-layout >
    <q-header elevated class="text-grey-8 q-py-xs" height-hint="58">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          @click="toggleLeftDrawer"
          aria-label="Menu"
          icon="menu"
        />

        <q-btn flat no-caps no-wrap class="q-ml-xs"  to="/">
          <!-- <q-icon :name="fabYoutube" color="red" size="28px" /> -->
          <q-toolbar-title shrink class="text-weight-bold">
            Rafael Coldebella
          </q-toolbar-title>
        </q-btn>

        <q-space />

        <!-- <div class="YL__toolbar-input-container row no-wrap">
          <q-input dense outlined square v-model="search" placeholder="Search" class="bg-white col" />
          <q-btn class="YL__toolbar-input-btn" color="grey-3" text-color="grey-8" icon="search" unelevated />
        </div>

        <q-space /> -->

        <div class="q-gutter-sm row items-center no-wrap" >
          <q-btn round dense flat color="grey-8" @click="toggleDark">
            <q-avatar size="23px" class="q-icon">
              <svg viewBox="0 0 24 24"><path d="M19,3H14V5H19V18L14,12V21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M10,18H5L10,12M10,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H10V23H12V1H10V3Z"></path></svg>
            </q-avatar>
            <q-tooltip>{{ $q.dark.isActive ? "Modo light" : "Modo dark"}}</q-tooltip>
          </q-btn>
          <template v-if="checkAuth">
            <q-btn round dense flat color="grey-8" icon="notifications">
              <q-badge v-if="false" color="red" text-color="white" floating>
                5
              </q-badge>
              <q-tooltip>Notifications</q-tooltip>
            </q-btn>
            <q-btn round flat>
              <q-avatar size="26px">
                <img src="https://cdn.quasar.dev/img/boy-avatar.png">
              </q-avatar>
              <q-tooltip>Account</q-tooltip>
            </q-btn>
            <q-btn flat no-caps class="q-ml-ml" @click="logoutKeycloak">
              <q-item-label>
                Logout
              </q-item-label>
            </q-btn>
          </template>
          <template v-else>
            <q-btn flat no-caps class="q-ml-ml" @click="loginKeycloak">
              <q-item-label>
               Fazer login
              </q-item-label>
            </q-btn>
          </template>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      :width="240"
    >
      <q-scroll-area class="fit">
        <q-list padding>
          <q-item v-for="link in links1" :key="link.text" :target="link.target ? '_blank' : '_self'" :href="link.link" v-ripple clickable>
            <q-item-section avatar>
              <q-icon color="grey" :name="link.icon" />
            </q-item-section>
            <q-item-section>
              <q-item-label>{{ link.text }}</q-item-label>
            </q-item-section>
          </q-item>

          <q-separator class="q-my-md" />
          <q-item-label header class="text-weight-bold text-uppercase">
            Aplicativos
          </q-item-label>

          <tamplate v-for="link in links2" :key="link.text">
            <q-item v-if="link.auth == false || (link.auth == true && checkAuth)" :target="link.target ? '_blank' : '_self'" :href="link.link" v-ripple clickable>
              <q-item-section avatar>
                <q-icon color="grey" :name="link.icon" />
              </q-item-section>
              <q-item-section>
                <q-item-label>{{ link.text }}</q-item-label>
              </q-item-section>
            </q-item>
          </tamplate>

          <q-separator class="q-mt-md q-mb-xs" />
          <q-item-label header class="text-weight-bold text-uppercase">
            Em Breve
          </q-item-label>

          <q-item v-for="link in links3" disable="disable" :key="link.text" v-ripple clickable>
            <q-item-section avatar>
              <q-icon color="grey" :name="link.icon" />
            </q-item-section>
            <q-item-section>
              <q-item-label>{{ link.text }}</q-item-label>
            </q-item-section>
          </q-item>

          <q-separator class="q-mt-md q-mb-xs" />

        </q-list>
      </q-scroll-area>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref } from 'vue';
import { useQuasar } from 'quasar';
import { storeMain } from "../stores/storeMain.js";
import { mapActions } from "pinia";
import { keycloak } from 'src/boot/keycloak';

export default {
  name: 'MyLayout',
  setup () {
    const leftDrawerOpen = ref(false)
    const $q = useQuasar()
    function toggleLeftDrawer () {
      leftDrawerOpen.value = !leftDrawerOpen.value
    };

    if($q.dark.isActive || localStorage.dark == 'true'){
      $q.dark.set(true)
    }

    function toggleDark () {
      $q.dark.toggle()
      localStorage.dark = $q.dark.isActive;
    };

    return {
      leftDrawerOpen,
      toggleLeftDrawer,
      toggleDark,
      links1: [
        { icon: 'home',
          text: 'Início',
          link: window.location.protocol + "//" + window.location.host,
        },
        {
          icon: 'code',
          text: 'GitHub',
          link: 'https://github.com/RafaelcVinicius',
          target: true
        },
      ],
      links2: [
        {
          icon: 'link',
          text: 'Gerador de CPF',
          link: window.location.protocol + "//" + window.location.host + "/gerador-cpf",
          auth: false,
        },
        {
          icon: 'link',
          text: 'Wallet dashboard',
          link: window.location.protocol + "//" + window.location.host + "/wallet",
          auth: true,
        },
      ],
      links3: [
        {
          icon: 'code',
          text: 'Gerador de CNPJ',
        },
        {
          icon: 'link',
          text: 'Validador de CNPJ',
        },
        {
          icon: 'link',
          text: 'Validador de CPF',
        },
      ],
      buttons1: [
        { text: 'About' },
        { text: 'Press' },
        { text: 'Copyright' },
        { text: 'Contact us' },
        { text: 'Creators' },
        { text: 'Advertise' },
        { text: 'Developers' }
      ],
      buttons2: [
        { text: 'Terms' },
        { text: 'Privacy' },
        { text: 'Policy & Safety' },
        { text: 'Test new features' }
      ]
    }
  },

  methods:{
    ...mapActions(storeMain, ['loginKeycloak']),
    ...mapActions(storeMain, ['logoutKeycloak']),
    // ...mapActions(storeMain, ['getUser']),
  },

  computed:{
    checkAuth(){
      return keycloak.authenticated;
    }
  },

  created(){
    if(this.checkAuth){
      // this.getUser();
    }
  },
}
</script>

<style lang="sass">
.YL
  &__toolbar-input-container
    min-width: 100px
    width: 55%
  &__toolbar-input-btn
    border-radius: 0
    border-style: solid
    border-width: 1px 1px 1px 0
    border-color: rgba(0,0,0,.24)
    max-width: 60px
    width: 100%
  &__drawer-footer-link
    color: inherit
    text-decoration: none
    font-weight: 500
    font-size: .75rem
    &:hover
      color: #000
</style>
