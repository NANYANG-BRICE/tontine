import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', redirect: '/dashboard' },
    {
      path: '/',
      component: () => import('../layouts/default.vue'),
      children: [
        { path: 'utilisateurs', component: () => import('../pages/utilisateur.vue') },
        { path: 'finance', component: () => import('../pages/finance.vue') },
        { path: 'messagerie', component: () => import('../pages/messagerie.vue') },
        { path: 'importations', component: () => import('../pages/importation.vue') },
        { path: 'parametres', component: () => import('../pages/parametre.vue') },
        { path: 'statistiques', component: () => import('../pages/statistique.vue') },
        { path: 'dashboard', component: () => import('../pages/dashboard.vue') },
      ],
    },
    {
      path: '/',
      component: () => import('../layouts/blank.vue'),
      children: [
        {
          path: 'login',
          component: () => import('../pages/login.vue'),
        },
        {
          path: 'register',
          component: () => import('../pages/register.vue'),
        },
        {
          path: '/:pathMatch(.*)*',
          component: () => import('../pages/[...all].vue'),
        },
      ],
    },
  ],
})

export default router
