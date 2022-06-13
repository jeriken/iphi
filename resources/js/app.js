require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

import App from './App.vue';
import Home from './pages/Home.vue';
import Latest from './pages/LatestPost.vue';
import Popular from './pages/PopularPost.vue';
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
        component: Latest
    },
    {
        path: '/berita/:id',
        component: Latest
    },
    {
        path: '/popular',
        component: Popular
    },
    {
        path: '/popular/:id',
        component: Popular
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