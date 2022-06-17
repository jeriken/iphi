<template>
<div>
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
          <article class="card mb-4" v-if="isloadpost">
              <b-skeleton animation="wave" width="15%"></b-skeleton>
            <h1 class="card-title">
              <b-card>
                <b-skeleton animation="wave" width="60%" height="1.6rem"></b-skeleton>
              </b-card>
            </h1>
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

          <aside class="sidebar sidebar-sticky">
            
            <!-- /.card -->
            <Populer/>
            <!-- /.card -->
          </aside>
        </div>
      </div>
    </div>
  </main>
</div>
</template>

<script>
import Populer from "../components/Populer.vue";
export default {
  title: "Halaman",
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
    this.$title = this.posts.data.judul;
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
    async getPost(slug) {
      try {
        this.axios
          .get("/badaso-api/v1/entities/halaman/read?id=" + slug)
          .then((response) => {
            this.posts = response.data;
            this.isloadpost = false;
          });
      } catch (error) {}
    },
  },
};
</script>
