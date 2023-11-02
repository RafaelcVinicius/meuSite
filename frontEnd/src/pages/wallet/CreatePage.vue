<template>
  <q-page class="flex-c flex-as">
    <CreateComponent :mobile="mobile"></CreateComponent>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import CreateComponent from "components/wallet/CreateComponent.vue"

export default defineComponent({
  name: "DeshboardCreatePage",
  components: {
    CreateComponent,
  },

  data(){
    return {
      mobile: true,
    }
  },
});
</script>
