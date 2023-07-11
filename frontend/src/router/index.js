import { createRouter, createWebHistory } from 'vue-router'
import { authStore } from '../stores/auth';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { 
      path: '/',
      redirect: '/home',
      component: () => import('@/layouts/DefaultLayout.vue'),
      children: [
        //admin
        {
          path: '/dashboard',
          name: 'dashboard',
          component: () => import('@/views/Dashboard/Dashboard.vue'),
          meta: { admin: true },
          children: [
            {
              path: '/admin/products',
              name: 'adminProducts',
              component: () => import('@/views/Dashboard/Products.vue'),
              meta: { admin: true},
            },
            {
              path: '/admin/analytics',
              name: 'adminAnalytics',
              component: () => import('@/views/Dashboard/Analytics.vue'),
              meta: { admin: true},
            },
            {
              path: '/admin/payments',
              name: 'adminPayments',
              component: () => import('@/views/Dashboard/Payments.vue'),
              meta: { admin: true},
            },
            {
              path: '/admin/orders',
              name: 'adminOrders',
              component: () => import('@/views/Dashboard/Orders.vue'),
              meta: { admin: true},
            },
            {
              path: '/admin/settings',
              name: 'adminSettings',
              component: () => import('@/views/Dashboard/Settings.vue'),
              meta: { admin: true},
            },
          ],
        },

        //users
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
          path: '/payments',
          name: 'payments',
          component: () => import('@/views/pages/PaymentPage.vue'),
        },
        {
          path: '/payments/:paymentId/edit',
          name: 'paymentsEdit',
          component: () => import('@/views/pages/PaymentPage.vue'),
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
        {
          path: '/all_categories',
          name: 'all_categories',
          component: () => import('@/views/pages/AllCategoriesPage.vue'),
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
    },
  ]
})

router.beforeEach((to,from,next) => {

  const cookiesArray = document.cookie.split(';');
  let cookieFlg = false;
  for (let i = 0; i < cookiesArray.length; i++) {
    let cookies = cookiesArray[i].split('=');
    if (cookies[0].match(/XSRF-TOKEN/)) {
      cookieFlg = true;
      break;
    }
  }

  // const auth = authStore();
  // if (
  //   to.matched.some((record) => record.meta.admin) && auth.isAuthenticated && cookieFlg
  // ) {
  //   next('/dashboard');
  //   return;
  // }

  next();
})

export default router 
