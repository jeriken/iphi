<template>
  <div>
    <article class="d-flex justify-content-center">
      <div class="col-lg-10 col-sm-6 col-xs-12 text-center">
        <div class="card-body text-grey bg-white">
          <header>
            <div class="m-8">
              <button
                type="button"
                class="btn btn-outline-secondary text-dark p-6"
              >
                {{ title }}
              </button>
            </div>
          </header>
        </div>
      </div>
    </article>
    <!-- /.card -->

    <main class="main pt-5">
      <div class="container">
        <div class="row" v-if="posts.data">
          <div
            class="col-md-3"
            :data="rec"
            :key="index"
            v-for="(rec, index) in posts.data.posts.data"
          >
            <article class="card mb-4">
              <header class="card-header">
                <div class="card-meta">
                  <a href="#"
                    ><time class="timeago" :datetime="rec.createdAt">
                      {{ date(rec.createdAt) }}
                    </time></a
                  >
                  di
                  <a :href="getCatLink(rec.category.slug)">
                    {{ rec.category.title }}
                  </a>
                </div>
                <a :href="getPostLink(rec.slug)">
                  <h4 class="card-title">{{ rec.title }}</h4>
                </a>
              </header>
              <a :href="getPostLink(rec.slug)">
                <img class="card-img" :src="rec.thumbnail" alt="" />
              </a>
              <div class="card-body">
                <p class="card-text">
                  {{ rec.summary }}
                </p>
                <p>
                  Ditulis oleh:<b> {{ rec.user.name }} </b>
                </p>
              </div>
            </article>
            <!-- /.card -->
          </div>
        </div>
        <div v-if="isloadpost">
          <div class="row">
            <div class="col-md-3" :key="index" v-for="index in 4">
              <article class="card mb-4">
                <header class="card-header">
                  <b-card>
                    <b-skeleton width="60%"></b-skeleton>
                    <b-skeleton width="100%"></b-skeleton>
                    <b-skeleton width="90%"></b-skeleton>
                  </b-card>
                </header>
                <b-skeleton-img></b-skeleton-img>
                <div class="card-body">
                  <b-card>
                    <b-skeleton width="100%"></b-skeleton>
                    <b-skeleton width="100%"></b-skeleton>
                    <b-skeleton width="55%"></b-skeleton>
                  </b-card>
                  <b-skeleton width="60%"></b-skeleton>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </main>
    <div class="pb-4">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center" v-if="posts.data">
          <li
            class="page-item"
            :data="rec"
            :key="index"
            v-for="(rec, index) in posts.data.posts.links"
            :class="{ active: rec.active == true }"
            v-show="rec.label"
          >
            <a class="page-link" :href="getPageLink(rec.label)">
              {{ rec.label }}
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  title: "Semua",
  name: "latest",
  data() {
    return {
      posts: {},
      isloadpost: true,
      title: "Semua",
    };
  },
  async mounted() {
    await this.getPost(this.$route.params.id, this.$route.params.cat);
  },
  updated() {
    if(this.posts.data.posts.data[0].category.title){
      this.$title = this.posts.data.posts.data[0].category.title;
      this.title = this.posts.data.posts.data[0].category.title;
    }
  },
  methods: {
    getPageLink(url) {
      return "/berita/" + url;
    },
    getPostLink(url) {
      return "/posting/" + url;
    },
    getCatLink(url) {
      return "/berita/1/" + url;
    },
    date(date) {
      var dateNew = new Date(date);
      return new Intl.DateTimeFormat("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
      }).format(dateNew);
    },
    async getPost(page = 1, cat = "") {
      try {
        this.axios
          .get(
            "/badaso-api/module/post/v1/post?limit=8&page=" +
              page +
              "&category=" +
              cat
          )
          .then((response) => {
            this.posts = response.data;
            this.posts.data.posts.links.splice(0, 1);
            this.posts.data.posts.links.splice(-1, 1);
            this.isloadpost = false;
          });
      } catch (error) {}
    },
  },
};
</script>
