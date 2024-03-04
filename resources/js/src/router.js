import * as VueRouter from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('./pages/Home.vue')
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('./pages/About.vue')
  },
  {
    path: '/404',
    name: '404',
    component: () => import('./pages/404.vue')
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: { name: '404' }
  }
]

const router = VueRouter.createRouter({
  history: VueRouter.createWebHashHistory(),
  routes,
})

export default router