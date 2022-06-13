<template>
  <div id="app">
    <div>{{ kas }}</div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      kas: {},
    };
  },
  mounted() {
    this.getKas();
  },
  methods: {
    getKas() {
      try {
        this.axios.get("/badaso-api/v1/entities/kas").then((response) => {
          this.kas = response.data;
        });
      } catch (error) {}
    },
  },
};
</script>
