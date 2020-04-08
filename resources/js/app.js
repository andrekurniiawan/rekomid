import VueRouter from "vue-router";
import Guest from "./components/Guest.vue";
import Home from "./components/user/Home.vue";
import Post from "./components/user/Post.vue";

require("./bootstrap");
require("admin-lte");
window.Vue = require("vue");

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "welcome",
            component: Guest,
        },
        {
            path: "/home",
            name: "home",
            component: Home,
        },
        {
            path: "/post",
            name: "post",
            component: Post,
        },
    ],
});

const app = new Vue({
    el: "#app",
    router,
});
