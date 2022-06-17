require('./bootstrap');

import Vue from 'vue';
import BootstrapVue from "bootstrap-vue"
import { SkeletonPlugin } from 'bootstrap-vue'
import "bootstrap-vue/dist/bootstrap-vue.css"
import "../css/app.css"
import "./custom"
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(SkeletonPlugin)

import App from './App.vue';
import Home from './pages/Home.vue';
import Berita from './pages/Berita.vue';
import DetailPost from './pages/DetailPost.vue';
import DetailHalaman from './pages/DetailHalaman.vue';
import Kas from './pages/LaporanKas.vue';

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/berita',
        component: Berita
    },
    {
        path: '/berita/:id',
        component: Berita
    },
    {
        path: '/berita/:id/:cat',
        component: Berita
    },
    {
        path: '/posting/:id',
        component: DetailPost
    },
    {
        path: '/halaman/:id',
        component: DetailHalaman
    },
    {
        path: '/kas',
        component: Kas
    },

  ];

const router = new VueRouter({ mode: 'history', routes: routes});
new Vue(Vue.util.extend({ router }, App)).$mount('#app');