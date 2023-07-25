import { createRouter, createWebHistory } from 'vue-router'
import { authStore } from '../stores/auth';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin',
      redirect: 'dashboard',
      component: () => import('@/layouts/DefaultLayout.vue'),
      meta: { admin: true },
      children: [
        {
          path: '/dashboard',
          name: 'dashboard',
          component: () => import('@/views/Dashboard/Dashboard.vue'),
          children: [
            {
              path: 'products',
              name: 'adminProducts',
              component: () => import('@/views/Dashboard/product/Products.vue'),
            },
            {
              path: 'shippers',
              name: 'adminShipper',
              component: () => import('@/views/Dashboard/shipper/Shippers.vue'),
            },
            {
              path: 'categories',
              name: 'adminCategories',
              component: () => import('@/views/Dashboard/category/Categories.vue'),
            },
            {
              path: 'orders',
              name: 'adminOrders',
              component: () => import('@/views/Dashboard/order/Orders.vue'),
            },
            {
              path: 'settings',
              name: 'adminSettings',
              component: () => import('@/views/Dashboard/Settings.vue'),
            },
          ],
        },
      ],
    },

    //user
    { 
      path: '/',
      redirect: '/home',
      component: () => import('@/layouts/DefaultLayout.vue'),
      meta: { user: true },
      children: [
        {
          path: '/home',
          name: 'home',
          component: () => import('@/views/pages/HomePage.vue'),
          children: [
            {
              path: '/homepage',
              name: 'homepage',
              component: () => import('@/views/pages/Home.vue'),
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
              path: '/payments',
              name: 'payments',
              component: () => import('@/views/pages/CheckoutPage.vue'),
            },
            {
              path: '/cart',
              name: 'cart',
              component: () => import('@/views/pages/CartPage.vue'),
            },
            {
              path: '/category',
              name: 'category',
              component: () => import('@/views/pages/CategoriesPage.vue'),
            },
          ],
        },
      ],
    },
    {
      path: '/auth',
      name: 'auth',
      component: () => import('@/layouts/AuthLayout.vue'),
      meta: { guest: true },
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
  
  const auth = authStore();
  const cookiesArray = document.cookie.split(';');
  let cookieFlg = false;
  for (let i = 0; i < cookiesArray.length; i++) {
    let cookies = cookiesArray[i].split('=');
    if (cookies[0].match(/XSRF-TOKEN/)) {
      cookieFlg = true;
      break;
    }
  }
  if (auth.isAuthenticated || cookieFlg) {
    if (to.matched.some((record) => record.meta.admin)) {
      if (auth.$state.user?.role_id === 'Admin' || auth.$state.user?.role_id === 'Boss') {
        next();
      } else {
        next({ path: '/homepage' });
      }
    } else if (
      to.matched.some((record) => record.meta.user)
    ) {
      next();
    } else if (
      to.matched.some((record) => record.meta.guest)
    ) {
      next({ path: '/homepage' });
    } else {
      next({ path: '/login' });
    }
  } else {
    if (to.matched.some((record) => record.meta.guest)) {
      next();
    } else {
      next({ path: '/login' });
    }
  }
})

export default router 
