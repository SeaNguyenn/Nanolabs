import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { 
      path: '/',
      redirect: '/home',
      component: () => import('@/layouts/DefaultLayout.vue'),
      children: [
        {
          path: '/dashboard',
          name: 'dashboard',
          component: () => import('@/views/Dashboard.vue'),
        },
        {
          path: '/home',
          name: 'home',
          component: () => import('@/views/pages/HomePage.vue'),
        },
        {
          path: '/products',
          name: 'products',
          component: () => import('@/views/pages/ProductsPage.vue'),
        },
      ],
    },
    {
      path: '/auth',
      name: 'auth',
      component: () => import('@/layouts/AuthLayout.vue'),
      children: [
        {
          path: '/login',
          name: 'login',
          component: () => import('@/views/auth/Login.vue')
        },
        {
          path: '/register',
          name: 'register',
          component: () => import('@/views/auth/Register.vue'),
        },
      ]
    }
  ]
})

// router.beforeEach((to,from,next) => {

// })

export default router 
