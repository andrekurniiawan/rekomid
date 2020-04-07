import VueRouter from "vue-router";
import Guest from "./components/Guest.vue";

require("./bootstrap");
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
    ],
});

const app = new Vue({
    el: "#app",
    router,
});
