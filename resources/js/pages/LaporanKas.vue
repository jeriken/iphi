<template>
  <div id="app">
    <!-- Div Kas -->
    <div class="d-flex justify-content-center pt-4">
      <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
        <div class="container">
          <article class="card card-outline mb-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-body">
                  <header>
                    <h4 class="card-title pb-4">Laporan Dana Kas</h4>
                  </header>

                  <table class="table table-hover" v-if="kas.data">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        :data="rec"
                        :key="index"
                        v-for="(rec, index) in countedList"
                      >
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ date(rec.tanggal) }}</td>
                        <td v-if="rec.jumlah > 0">{{ cv(rec.jumlah) }}</td>
                        <td v-else>-</td>
                        <td v-if="rec.jumlah < 0">{{ cv(rec.jumlah) }}</td>
                        <td v-else>-</td>
                        <td>
                          <i>{{ cv(rec.total) }}</i>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <b-skeleton-table
                    :rows="5"
                    :columns="5"
                    :table-props="{ bordered: true, striped: true }"
                    v-if="isloadkas"
                  ></b-skeleton-table>
                </div>
              </div>
            </div>
          </article>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  title: "Kas",
  name: "Home",
  data() {
    return {
      kas: {},
      isloadkas: true,
      jumlah: 0,
    };
  },
  async mounted() {
    await this.getKas();
  },
  methods: {
    jumlahKas(kas) {
      this.jumlah = kas;
      return this.jumlah;
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
    async getKas() {
      try {
        this.axios.get("/badaso-api/v1/entities/kas").then((response) => {
          this.kas = response.data;
          this.isloadkas = false;
        });
      } catch (error) {}
    },
  },
  computed: {
    countedList() {
      console.log(this.kas);
      if (this.kas.data.data == undefined) return [];
      let totalNow = 0;
      return this.kas.data.data.map((value) => {
        totalNow =
          value.jumlah > 0
            ? totalNow + Math.abs(value.jumlah)
            : totalNow - Math.abs(value.jumlah);
        return {
          tanggal: value.tanggal,
          jumlah: value.jumlah,
          total: totalNow,
        };
      });
    },
  },
};
</script>
