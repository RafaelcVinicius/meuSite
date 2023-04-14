<template>
  <q-layout>
    <q-page-container>
      <q-page class="q-pa-md text-grey-8 q-py-xs" style="max-width: 550px">
        <q-toolbar-title shrink class="text-weight-bold">
          Gerador de CPF
        </q-toolbar-title>
        <q-item >
          <q-item-section>
            <q-toggle
              v-model="ativarFormatacao"
              checked-icon="check"
              color="secondary"
              unchecked-icon="clear"
            />
            <!-- <q-tooltip>Formata CPF</q-tooltip> -->
          </q-item-section>
          <q-item-section>
            <q-btn push no-caps no-wrap class="q-ml-sm" @click="gerarCPF" color="secondary" label="Gerar CPF" />
          </q-item-section>
        </q-item>
        <q-card flat bordered class="flex-ac flex-jc" style="max-width: 550px; height: 100px;">
          <q-card-section>
            <div class="text-h6">{{ filter }}</div>
          </q-card-section>
        </q-card>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { Dark } from 'quasar';

export default {
  name: "GeradorCpf",
  data() {
    return {
      cpf: "",
      gerandocfp: "",
      numero: "",
      dig1: "",
      dig2: "",
      dig3: "",
      numdvpri: "",
      numdvseg: "",
      ativarFormatacao: false,
    };
  },

  computed: {
    filter() {
      let cpfFormatado = "";
      if (this.ativarFormatacao) {
        const arr = this.cpf.split("");
        arr.splice(3, 0, ".");
        arr.splice(7, 0, ".");
        arr.splice(11, 0, "-");
        arr.forEach((element) => {
          cpfFormatado += element;
        });
      } else {
        cpfFormatado = this.cpf;
      }
      return cpfFormatado.length < 11 ? "Gere seu CPF" : cpfFormatado;
    },
  },

  methods: {
    gerarCPF() {
      this.dig1 = String(this.numeroRandom());
      this.dig2 = String(this.numeroRandom());
      this.dig3 = String(this.numeroRandom());
      this.numdvpri = String(this.dvpri(this.dig1, this.dig2, this.dig3));
      this.numdvseg = String(
        this.dvseg(this.dig1, this.dig2, this.dig3, this.numdvpri)
      );

      this.cpf = String(
        this.dig1 + this.dig2 + this.dig3 + this.numdvpri + this.numdvseg
      );
    },

    numeroRandom() {
      this.numero = String(Math.floor(Math.random() * 999));
      if (this.numero.length === 2) {
        this.numero = "0".concat(this.numero);
      } else if (this.numero.length === 1) {
        this.numero = "00".concat(this.numero);
      }
      return this.numero;
    },

    dvpri(dig1, dig2, dig3) {
      let x = 0;
      let ret = 0;
      let j = 0;
      const nums = dig1.split("").concat(dig2.split(""), dig3.split(""));
      for (let i = 10; i >= 2; i -= 1) {
        x += Number(nums[j]) * i;
        j += 1;
      }
      const y = x % 11;
      if (y < 2) {
        ret = 0;
      } else {
        ret = 11 - y;
      }
      return ret;
    },

    dvseg(dig1, dig2, dig3, numdvpri) {
      let x = 0;
      let ret = 0;
      let j = 0;
      const nums = dig1.split("").concat(dig2.split(""), dig3.split(""));
      nums[9] = numdvpri;
      for (let i = 11; i >= 2; i -= 1) {
        x += Number(nums[j]) * i;
        j += 1;
      }
      const y = x % 11;
      if (y < 2) {
        ret = 0;
      } else {
        ret = 11 - y;
      }
      return ret;
    },
  },
};
</script>

<style>
#cpf {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 1rem;
  color: rgb(77, 76, 76);
}
.ativo {
  background-color: rgb(219, 219, 255) !important;
  border: 1px solid rgb(213, 213, 247) !important;
}
.ativo span {
  transition: 0.1s;
  left: 20px !important;
  border: 1px solid rgb(112, 112, 221) !important;
  background-color: #497ecc !important;
}
.btn-check {
  cursor: pointer;
  width: 48px;
  height: 15px;
  background-color: rgb(226, 226, 226);
  border-radius: 20px;
  border: 1px solid rgb(219, 219, 219);
  position: relative;
}
.btn-check span {
  transition: 0.1s;
  position: absolute;
  top: -7px;
  left: -1px;
  width: 26px;
  height: 26px;
  background-color: rgb(255, 255, 255);
  box-shadow: 1px 3px 6px rgb(133, 132, 132);
  border-radius: 100%;
}
</style>
