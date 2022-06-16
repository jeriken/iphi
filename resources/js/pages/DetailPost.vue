<template>
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
                    :datetime="posts.data.post.createdAt"
                    >{{ date(posts.data.post.createdAt) }}</time
                  ></a
                >
                di <a :href="getCatLink(posts.data.post.category.slug)">{{ posts.data.post.category.title }}</a>
              </div>
              <a href="#">
                <h1 class="card-title">{{ posts.data.post.title }}</h1>
              </a>
            </header>
            <a href="#">
              <img class="card-img" :src="posts.data.post.thumbnail" alt="" />
            </a>
            <div class="card-body">
              <div v-html="posts.data.post.content" />
              <hr />
            </div>
          </article>
          <!-- /.card -->
        </div>
        <div class="col-md-3 ms-auto">
          <aside class="sidebar">
            <div class="card mb-4 card-outline">
              <div class="card-body">
                <h4 class="card-title">Kilasan</h4>
                <p class="card-text">{{ posts.data.post.summary }}</p>
              </div>
            </div>
            <!-- /.card -->
          </aside>

          <aside class="sidebar sidebar-sticky">
            <div class="card card-outline mb-4">
              <div class="card-body">
                <h4 class="card-title">Tags</h4>
                <a
                  :data="rec"
                  :key="index"
                  v-for="(rec, index) in posts.data.post.tags"
                  class="btn btn-light btn-sm mb-1"
                  href="#"
                >
                  {{ rec.title }}
                </a>
              </div>
            </div>
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
    getCatLink(url) {
      return "/berita/1/"+url;
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
          .get("/badaso-api/module/post/v1/post/read-slug?slug=" + slug)
          .then((response) => {
            this.posts = response.data;
          });
      } catch (error) {}
    },
    getPopular() {
      try {
        this.axios
          .get("/badaso-api/module/post/v1/post/popular?limit=2")
          .then((response) => {
            this.popular = response.data;
          });
      } catch (error) {}
    },
  },
};
</script>
