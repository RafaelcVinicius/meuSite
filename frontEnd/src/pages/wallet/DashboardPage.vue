<template>
  <q-page v-resize="onResize" class="flex-c flex-as">
    <DashboardComponent :mobile="mobile"></DashboardComponent>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import DashboardComponent from "components/wallet/DashboardComponent.vue"

export default defineComponent({
  name: "DeshboardPage",
  components: {
    DashboardComponent,
  },

  data(){
    return {
      mobile: true,
    }
  },

  methods:{
    onResize(on){
      console.log(on);
    }
  },

});
</script>
