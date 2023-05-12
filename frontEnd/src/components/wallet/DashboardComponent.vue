<template>
    <div class="row p1 flex-jc w100 gapC1 gapR1">
      <div class="col-12 col-sm flex-jc">
        <div class="cardValue green">
          <span>Saldo atual</span>
          <span class="font-18 m-1t fontw700"> {{ 7 }}</span>
        </div>
      </div>
      <div class="col-12 col-sm flex-jc">
        <div class="cardValue blue">
          <span>Receita mensal</span>
          <span class="font-18 m-1t font-w700"> {{ 50 }}</span>
        </div>
      </div>
      <div class="col-12 col-sm flex-jc">
        <div class="cardValue yellow">
          <span>Valor total investido</span>
          <span class="font-18 m-1t font-w700"> {{ 5 }}</span>
        </div>
      </div>
    </div>
    <TablePopUp>
    </TablePopUp>

</template>

<script>
import { defineComponent } from "vue";
import { storeMainWallet } from "../../stores/storeMainWallet";
import  TablePopUp  from "./TablePopUp.vue"

export default defineComponent({
  name: "DashboardComponent",
  setup()
  {
    const useStoreMainWallet = storeMainWallet();
    return { useStoreMainWallet }
  },

  components:{
    TablePopUp
  },

  props:{
    mobile:Boolean
  },

  created()
  {
    this.useStoreMainWallet.setWallet();
  },

  computed:
  {
    getWallet() {
      return this.useStoreMainWallet.getWallet;
    },
  },

});
</script>

<style>
.cardValue{
  max-width: 450px;
  width: 100%;
  height: 80px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  display: flex;
  flex-direction: column;
  padding: 0.6rem;
}
</style>
