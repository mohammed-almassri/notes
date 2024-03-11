import * as VueRouter from 'vue-router';
import store from './store/index';

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('./pages/Home.vue'),
    meta: {
      title: 'Home',
      auth: true
    }
  },
  {
    path: '/add',
    name: 'add',
    component: () => import('./pages/Add.vue'),
    meta: {
      title: 'Create New Note',
      auth: true
    }
  },
  {
    path: '/view/:id',
    name: 'view',
    component: () => import('./pages/Add.vue'),
    meta: {
      title: 'View Note',
      auth: true
    }
  },
  {
    path: '/settings/',
    name: 'settings',
    component: () => import('./pages/Settings.vue'),
    meta: {
      title: 'settings',
      auth: true
    }
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('./pages/Login.vue'),
    meta: {
      title: 'Login',
      auth: false,
      guest: true
    }
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('./pages/Register.vue'),
    meta: {
      title: 'Register',
      auth: false,
      guest: true
    }
  },
  {
    path: '/onboarding',
    name: 'onboarding',
    component: () => import('./pages/Onboarding.vue'),
    meta: {
      title: 'Onboarding',
    }
  },
  {
    path: '/404',
    name: '404',
    component: () => import('./pages/404.vue'),
    meta: {
      title: 'Page Not Found',
    }
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

router.beforeEach((to, from, next) => {

  if (store.state.auth.token == null && to.meta.auth) {
    return next('/login');
  }

  document.title = `${to.meta.title} | Notes App` || 'Notes App'
  next()
});

export default router