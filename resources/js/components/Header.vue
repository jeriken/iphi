<template>
  <header>
    <nav class="navbar navbar-expand-md navbar-light bg-white absolute-top">
      <div class="container">
        <button
          class="navbar-toggler order-2 order-md-1"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target=".navbar-collapse"
          aria-controls="navbar-left navbar-right"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div
          class="collapse navbar-collapse order-3 order-md-2"
          id="navbar-left"
        >
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/berita/1/berita">Berita</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/berita/1/kesehatan">Kegiatan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/berita/1/pengumuman">Pengumuman</a>
            </li>
          </ul>
        </div>
        <a class="navbar-brand mx-auto order-1 order-md-3" href="/"
          >Iphi</a
        >

        <div
          class="collapse navbar-collapse order-4 order-md-4"
          id="navbar-right"
        >
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="/halaman/15">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/halaman/16">Sejarah</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/halaman/17">Pengurus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kas">Kas</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<style>
</style>
<script>
export default {
  name: "Header",
  components: {},
};
</script>
