// App.vue

<template>
  <div id="app" class="container">
    <div>
      <Header/>
      <router-view></router-view>
      <Footer/>
    </div>
  </div>
</template>

<style>
</style>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "app",
  components: {
      Header,
      Footer
  },
};
</script>