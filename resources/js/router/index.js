import { createRouter, createWebHistory } from "vue-router";
import ExampleComponent from "../components/TheHeader.vue";
import DashboardPage from "../pages/DashboardPage.vue";

const routes = [{ path: "/", component: DashboardPage }];

const router = createRouter({
    history: createWebHistory("/"),
    routes,
});

export default router;
