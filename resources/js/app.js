import Vue from "vue";
import VueRouter from "vue-router";
import Guest from "./components/Guest.vue";

require("./bootstrap");
require("admin-lte");
require("@ckeditor/ckeditor5-build-balloon-block");

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "welcome",
            component: Guest,
        },
    ],
});

const app = new Vue({
    el: "#app",
    router,
});
