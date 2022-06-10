// App.vue

<template>
  <div id="app" class="container">
    <div>
      <header></header>
      <router-view></router-view>
      <footer></footer>
    </div>
  </div>
</template>

<style>
</style>

<script>
import header from "./components/Header.vue";
import footer from "./components/Footer.vue";
export default {
  name: "app",
  components: {
      header,
      footer
  },
};
</script>