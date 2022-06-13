<template>
  <div id="app">
    <div>{{ posts }}</div>
    <div>{{ halaman }}</div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      posts: {},
      halaman: {},
    };
  },
  mounted() {
    this.getPost();
    this.getHalaman();
  },
  methods: {
    getPost() {
      try {
        this.axios.get("/badaso-api/module/post/v1/post?limit=4").then((response) => {
          this.posts = response.data;
        });
      } catch (error) {}
    },
    getHalaman() {
      try {
        this.axios.get("/badaso-api/v1/entities/halaman").then((response) => {
          this.halaman = response.data;
        });
      } catch (error) {}
    },
  },
};
</script>
