import Vue from "vue";
import VueRouter from "vue-router";
import Guest from "./components/Guest.vue";

require("./bootstrap");
require("admin-lte");

require("../bower_components/select2/dist/js/select2");
require("../bower_components/datatables.net/js/jquery.dataTables");
require("../bower_components/datatables.net-responsive/js/dataTables.responsive");

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

window.deleteConfirm = function (event) {
    if (confirm("Are you sure you want to delete?")) {
        //
    } else {
        event.preventDefault();
    }
};
