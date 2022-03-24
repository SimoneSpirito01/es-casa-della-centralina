import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./components/pages/Home";
import InterventionsOpen from "./components/pages/InterventionsOpen";
import InterventionsLatests from "./components/pages/InterventionsLatests";
import InterventionsSearch from "./components/pages/InterventionsSearch";
import TechnicianFree from "./components/pages/TechnicianFree";
import Dynamic from "./components/pages/Dynamic";
import PageNotFound from "./components/pages/PageNotFound";


const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/interventions/open",
            name: "interventions-open",
            component: InterventionsOpen
        },
        {
            path: "/interventions/latests",
            name: "interventions-latests",
            component: InterventionsLatests
        },
        {
            path: "/interventions/search",
            name: "interventions-search",
            component: InterventionsSearch
        },
        {
            path: "/technician/free",
            name: "technician-free",
            component: TechnicianFree
        },
        {
            path: "/dynamic",
            name: "dynamic",
            component: Dynamic
        },
        // error 404
        {
            path: '/404',
            alias: '*',
            name: "not-found",
            component: PageNotFound,
        },
        
        
    ]
});

export default router