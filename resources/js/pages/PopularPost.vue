<template>
  <div id="app">
    <div>{{ posts }}</div>
  </div>
</template>

<script>
export default {
  name: "latest",
  data() {
    return {
      posts: {},
    };
  },
  mounted() {
    this.getPost(this.$route.params.id);
  },
  methods: {
    getPost(page = 1) {
      try {
        this.axios.get("/badaso-api/module/post/v1/post/popular?page="+page).then((response) => {
          this.posts = response.data;
        });
      } catch (error) {}
    },
  },
};
</script>
