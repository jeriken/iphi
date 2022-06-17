<template>
  <div class="card card-outline mb-4">
    <div class="card-body">
      <h4 class="card-title">Populer</h4>
      <div v-if="popular.data">
        <div
          :data="pop"
          :key="index"
          v-for="(pop, index) in popular.data.posts"
          class="p-2"
        >
          <a :href="pop.slug" class="d-inline-block">
            <h4 class="h6">{{ pop.title }}</h4>
            <img class="card-img" :src="pop.thumbnail" alt="" />
          </a>

          <hr />
        </div>
      </div>
      <div v-if="isloadpop">
        <a href="" :key="index" v-for="index in 2">
          <b-card>
            <b-skeleton animation="wave" width="100%"></b-skeleton>
            <b-skeleton animation="wave" width="55%"></b-skeleton>
          </b-card>
          <b-skeleton-img></b-skeleton-img>
          <hr/>
        </a>
      </div>
    </div>
  </div>
  <!-- /.card -->
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      popular: {},
      isloadpop: true,
    };
  },
  async mounted() {
    await this.getPopular();
  },
  methods: {
    async getPopular() {
      try {
        this.axios
          .get("/badaso-api/module/post/v1/post/popular?limit=2")
          .then((response) => {
            this.popular = response.data;
            this.isloadpop = false;
          });
      } catch (error) {}
    },
  },
};
</script>

<style>
</style>