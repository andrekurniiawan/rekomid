import Vue from "vue";
import VueRouter from "vue-router";
import Guest from "./components/Guest.vue";

require("./bootstrap");
require("admin-lte");

require("../bower_components/select2/dist/js/select2");
require("../plugins/ckeditor5-build-balloon-block/ckeditor");

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
