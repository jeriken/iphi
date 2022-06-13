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
    getPost(id) {
      try {
        this.axios.get("/badaso-api/v1/entities/halaman/read?slug=halaman&id="+id).then((response) => {
          this.posts = response.data;
        });
      } catch (error) {}
    },
  },
};
</script>
