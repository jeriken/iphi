<template>
  <div id="app">
    <div>{{ posts }}</div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      posts: {},
    };
  },
  mounted() {
    this.getPost(this.$route.params.id);
  },
  methods: {
    getPost(slug) {
      try {
        this.axios.get("/badaso-api/module/post/v1/post/read-slug?slug="+slug).then((response) => {
          this.posts = response.data;
        });
      } catch (error) {}
    },
  },
};
</script>
