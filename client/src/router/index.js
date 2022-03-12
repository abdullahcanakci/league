import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      component: () => import("@/views/Index.vue"),
      children: [
        {
          path: "",
          name: "home",
          component: () => import("@/views/HomePage.vue"),
        },
        {
          path: "seasons/:id",
          name: "seasons.show",
          component: () => import("@/views/seasons/Show.vue"),
        },
      ],
    },
  ],
});

export default router;
