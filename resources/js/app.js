window.Vue = require("vue");
require("./bootstrap");
window.Fire = new Vue();

// import app store

// load vue router and use it ----------
import VueRouter from "vue-router"; // import vue router
Vue.use(VueRouter);

import index from "./components/index.vue";
import notFound from "./components/not-found";
let routes = [
    {
        path: "/",
        name: "Index",
        component: index
    },
    {
        path: "*",
        name: "any",
        component: notFound
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

const app = new Vue({
    el: "#app",
    router
});