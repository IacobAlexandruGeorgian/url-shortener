import { createRouter, createWebHistory } from "vue-router";
import DashboardPage from "../pages/DashboardPage.vue";
import NotFoundPage from "../pages/NotFoundPage.vue";
import axios from "axios";

const routes = [
    { path: "/", component: DashboardPage, name: "dashboard" },
    { path: "/:slug", name: "url" },
    { path: "/path/:slug", name: "path" },
    { path: "/404", component: NotFoundPage, name: "notFound" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.name == "url" || to.name == "path") {
        axios.get("redirect/" + to.params.slug)
        .then((response) => {
            window.open(response.data, null);
        }).catch((error) => {
            next({name: 'notFound'});
        });
    } else {
        next();
    }
});

export default router;
