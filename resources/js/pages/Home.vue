<template>
  <div id="app">
    <!-- Div Slider -->
    <article class="card card-outline mb-4">
      <div class="card-body" v-if="slider.data">
        <div
          id="carouselExampleCaptions"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <ol class="carousel-indicators">
            <li
              :data="rec"
              :key="index"
              v-for="(rec, index) in slider.data.data"
              data-bs-target="#carouselExampleCaptions"
              :data-bs-slide-to="index"
              :class="{ active: index == 0 }"
            ></li>
          </ol>
          <div class="carousel-inner">
            <div
              :data="rec"
              :key="index"
              v-for="(rec, index) in slider.data.data"
              class="carousel-item"
              :class="{ active: index == 0 }"
              :href="rec.link"
            >
              <img class="d-block w-100" :src="removeLink(rec.image)" />
              <div class="carousel-caption d-none d-md-block">
                <h5>{{ rec.name }}</h5>
                <p>
                  {{ rec.desc }}
                </p>
              </div>
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleCaptions"
            role="button"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleCaptions"
            role="button"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div v-if="isloadslider">
        <b-skeleton-img></b-skeleton-img>
      </div>
    </article>
    <!-- /.card -->

    <!-- Div Kas -->
    <div class="d-flex justify-content-center">
      <div class="col-lg-10 col-sm-6 col-xs-12 text-center">
        <div class="container">
          <article class="card card-outline mb-4">
            <div class="row">
              <div class="col-lg-8">
                <div class="card-body">
                  <header>
                    <h4 class="card-title">Laporan Dana Kas</h4>
                  </header>

                  <table class="table table-hover" v-if="kas.data">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        :data="rec"
                        :key="index"
                        v-for="(rec, index) in kas.data.data.slice(0, 5)"
                      >
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ cv(rec.jumlah) }}</td>
                        <td>{{ date(rec.tanggal) }}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div v-if="isloadkas">
                    <b-skeleton-table
                      :rows="5"
                      :columns="3"
                      :table-props="{ bordered: true, striped: true }"
                      v-if="isloadkas"
                    ></b-skeleton-table>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <h5 class="card-title m-4">Jumlah Saldo</h5>
                <h3 class="pb-2" v-if="jumlah.data">
                  {{ cv(jumlah.data[0].jumlah) }}
                </h3>
                <b-card v-if="isloadjumlah">
                  <b-skeleton type="input"></b-skeleton>
                  <br>
                </b-card>
                <div class="bg-primary text-white p-4">
                  Bank BRI<br />
                  Kode: 19106050024<br />
                  Atas Nama: Muhammad Razin M
                </div>
                <div class="m-4">
                  <a href="/kas">
                    <button type="button" class="btn btn-outline-primary">
                      Lihat Laporan
                    </button>
                  </a>
                </div>
              </div>
            </div>
          </article>
          <!-- /.card -->
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center mt-4 mb-2">
      <h2>Beberapa Artikel yang Patut Dibaca</h2>
    </div>

    <main class="main pt-4">
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
        <div v-if="isloadposts">
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
  </div>
</template>

<script>
export default {
  title:"Beranda",
  name: "Home",
  data() {
    return {
      slider: {},
      isloadslider: true,
      kas: {},
      isloadkas: true,
      jumlah: {},
      isloadjumlah: true,
      posts: {},
      isloadposts: true,
    };
  },
  async mounted() {
    await this.getSlider();
    await this.getKas();
    await this.jumlahKas();
    await this.getPost();
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
    async getSlider() {
      try {
        this.axios.get("/badaso-api/v1/entities/slider").then((response) => {
          this.slider = response.data;
          this.isloadslider = false;
        });
      } catch (error) {}
    },
    async getKas() {
      try {
        this.axios.get("/badaso-api/v1/entities/kas").then((response) => {
          this.kas = response.data;
          this.isloadkas = false;
        });
      } catch (error) {}
    },
    async jumlahKas() {
      try {
        this.axios.get("/api/kas/jumlah").then((response) => {
          this.jumlah = response.data;
          this.isloadjumlah = false;
        });
      } catch (error) {}
    },
    async getPost() {
      try {
        this.axios
          .get("/badaso-api/module/post/v1/post?limit=8")
          .then((response) => {
            this.posts = response.data;
            this.isloadposts = false;
          });
      } catch (error) {}
    },
  },
};
</script>
