const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/IndexPage.vue") }],
  },
  {
    path: "/gerador-cpf",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Gerador.vue") }],
  },
  {
    path: "/gerador-cnpj",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/Gerador.vue") }],
  },
  {
    path: "/wallet",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/wallet/DashboardPage.vue") },
      { path: "create", component: () => import("pages/wallet/CreatePage.vue") }

    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
