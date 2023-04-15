<template>
  <div class="home">
    <GeradorCpf />
  </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import GeradorCpf from "components/GeradorCpf.vue";

export default {
  name: "HomeView",
  components: {
    GeradorCpf,
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap");
* {
  margin: 0;
  border: 0;
  padding: 0;
}

a {
  color: #e7e7e7;
  text-decoration: none;
}
nav {
  display: flex;
  justify-content: center;
  padding: 20px;
  background-color: #000408;
}
nav a {
  width: 100px;
}
.home {
  margin: 30px;
}
.div-titulo {
  display: flex;
  justify-content: flex-start;
  max-width: 1000px;
  width: 100%;
}
.titulo {
  font-size: 25px;
}
.div-acoes {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 550px;
  width: 100%;
}
.div-btn {
  max-width: 200px;
  width: 100%;
  height: 40px;
  border: none;
  background-color: #3c97f1;
  color: #e7e7e7;
  border-radius: 8px;
  font-size: 16px;
  box-shadow: 3px 3px 10px #cccccc;
  letter-spacing: 2px;
  cursor: pointer;
}
.light-div{
  background-color: rgb(241, 241, 241);
  border: 1px solid #e7e7e7;
}
.div-content {
  display: flex;
  justify-content: center;
  align-items: center;
  max-width: 550px;
  width: 100%;
  height: 150px;
  font-size: 35px;
}

@media only screen and (max-width: 450px) {
  .div-content {
    font-size: 25px;
  }
  .div-titulo {
    display: flex;
    justify-content: center;
  }
}
</style>
