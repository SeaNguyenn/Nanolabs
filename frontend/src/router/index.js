import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { 
      path: '/',
      redirect: '/dashboard',
      component: () => import('@/layouts/DefaultLayout.vue'),
      children: [
        {
          path: '/dashboard',
          name: 'dashboard',
          component: () => import('@/views/Dashboard.vue'),
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
          component: () => import('@/views/Login.vue')
        },
        // {
        //   path: '/register',
        //   name: 'register',
        //   component: () => import('@/views/Register.vue'),
        // },
      ]
    }
  ]
})

// router.beforeEach((to,from,next) => {

// })

export default router 
