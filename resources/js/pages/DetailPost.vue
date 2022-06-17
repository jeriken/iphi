<template>
  <main class="main pt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <article class="card mb-4" v-if="posts.data">
            <header class="card-header text-center">
              <div class="card-meta">
                <a href="#"
                  ><time
                    class="timeago"
                    :datetime="posts.data.post.createdAt"
                    >{{ date(posts.data.post.createdAt) }}</time
                  ></a
                >
                di
                <a :href="getCatLink(posts.data.post.category.slug)">{{
                  posts.data.post.category.title
                }}</a>
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
          <article class="card mb-4" v-if="isloadpost">
            <b-skeleton animation="wave" width="20%"></b-skeleton>
            <h1 class="card-title">
              <b-card>
                <b-skeleton
                  animation="wave"
                  width="80%"
                  height="1.6rem"
                ></b-skeleton>
                <b-skeleton
                  animation="wave"
                  width="40%"
                  height="1.6rem"
                ></b-skeleton>
              </b-card>
            </h1>
            <b-skeleton-img></b-skeleton-img>
            <div class="card-body">
              <b-card>
                <b-skeleton animation="wave" width="85%"></b-skeleton>
                <b-skeleton animation="wave" width="55%"></b-skeleton>
                <b-skeleton animation="wave" width="70%"></b-skeleton>
              </b-card>
              <br />
              <b-card>
                <b-skeleton animation="wave" width="85%"></b-skeleton>
                <b-skeleton animation="wave" width="55%"></b-skeleton>
                <b-skeleton animation="wave" width="70%"></b-skeleton>
              </b-card>
            </div>
          </article>
          <!-- /.card -->
        </div>
        <div class="col-md-3 ms-auto">
          <aside class="sidebar">
            <div class="card mb-4 card-outline">
              <div class="card-body">
                <h4 class="card-title">Kilasan</h4>
                <p class="card-text" v-if="posts.data">
                  {{ posts.data.post.summary }}
                </p>
                <p v-if="isloadpost">
                  <b-card>
                    <b-skeleton animation="wave" width="85%"></b-skeleton>
                    <b-skeleton animation="wave" width="55%"></b-skeleton>
                    <b-skeleton animation="wave" width="70%"></b-skeleton>
                  </b-card>
                </p>
              </div>
            </div>
            <!-- /.card -->
          </aside>

          <aside class="sidebar sidebar-sticky">
            <div class="card card-outline mb-4">
              <div class="card-body">
                <h4 class="card-title">Tags</h4>
                <div v-if="posts.data">
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
                <a v-if="isloadpost"><b-skeleton type="input"></b-skeleton></a>
              </div>
            </div>
            <!-- /.card -->
            <Populer />
          </aside>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import Populer from "../components/Populer.vue";
export default {
  title: "Postingan",
  name: "Home",
  data() {
    return {
      posts: {},
      isloadpost: true,
    };
  },
  components: {
    Populer,
  },
  async mounted() {
    await this.getPost(this.$route.params.id);
  },
  updated() {
    this.$title = this.posts.data.post.title;
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
      return "/berita/1/" + url;
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
    async getPost(slug) {
      try {
        this.axios
          .get("/badaso-api/module/post/v1/post/read-slug?slug=" + slug)
          .then((response) => {
            this.posts = response.data;
            this.isloadpost = false;
          });
      } catch (error) {}
    },
  },
};
</script>
