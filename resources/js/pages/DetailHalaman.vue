<template>
<div>
    <main class="main pt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <article class="card mb-4">
            <header class="card-header text-center">
              <div class="card-meta">
                <a href="#"
                  ><time
                    class="timeago"
                    :datetime="posts.data.createdAt"
                    >{{ date(posts.data.createdAt) }}</time
                  ></a
                >
                
              </div>
              <a href="">
                <h1 class="card-title">{{ posts.data.judul }}</h1>
              </a>
            </header>
            <div class="card-body">
              <div v-html="posts.data.konten" />
              <hr />
            </div>
          </article>
          <!-- /.card -->
        </div>
        <div class="col-md-3 ms-auto">

          <aside class="sidebar sidebar-sticky">
            
            <!-- /.card -->
            <div class="card card-outline mb-4">
              <div class="card-body">
                <h4 class="card-title">Populer</h4>
                <div
                  :data="pop"
                  :key="index"
                  v-for="(pop, index) in popular.data.posts"
                  class="p-2"
                >
                  <a href="post-image.html" class="d-inline-block">
                    <h4 class="h6">{{ pop.title }}</h4>
                    <img class="card-img" :src="pop.thumbnail" alt="" />
                  </a>
                  
                  <hr/>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </aside>
        </div>
      </div>
    </div>
  </main>
</div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      posts: {},
      popular: {},
    };
  },
  mounted() {
    this.getPost(this.$route.params.id);
    this.getPopular();
  },
  methods: {
    removeLink(url) {
      url = url.replace("http://localhost:8000/storage/", "");
      url = url.replace("thumbs/", "");
      return url;
    },
    getPostLink(url) {
      return "/posting/" + url;
    },
    cv(num) {
      num = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(num);

      return num;
    },
    date(date) {
      var dateNew = new Date(date);
      return new Intl.DateTimeFormat("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
      }).format(dateNew);
    },
    getPost(slug) {
      try {
        this.axios
          .get("/badaso-api/v1/entities/halaman/read?id=" + slug)
          .then((response) => {
            this.posts = response.data;
          });
      } catch (error) {}
    },
    getPopular() {
      try {
        this.axios
          .get("/badaso-api/module/post/v1/post/popular?limit=3")
          .then((response) => {
            this.popular = response.data;
          });
      } catch (error) {}
    },
  },
};
</script>
