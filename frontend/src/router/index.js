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
        {
          path: '/product/:productId',
          name: 'productScreen',
          component: () => import('@/views/pages/ProductPage.vue'),
        },
        {
          path: '/product/:productId/edit',
          name: 'productEdit',
          component: () => import('@/views/pages/ProductPage.vue'),
        },
        {
          path: '/blogs',
          name: 'blogs',
          component: () => import('@/views/pages/BlogPage.vue'),
        },
        {
          path: '/blogs/:blogId/edit',
          name: 'blogEdit',
          component: () => import('@/views/pages/BlogPage.vue'),
        },
        {
          path: '/cart',
          name: 'cart',
          component: () => import('@/views/pages/CartPage.vue'),
        },
        {
          path: '/checkout',
          name: 'checkout',
          component: () => import('@/views/pages/CheckoutPage.vue'),
        },
        {
          path: '/contact',
          name: 'contact',
          component: () => import('@/views/pages/ContactPage.vue'),
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
