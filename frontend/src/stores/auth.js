import { defineStore } from 'pinia'
import authService from '../services/authService';
import { checkCookie } from './utils';

export const authStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
  }),
  getters: {
    isAuthenticated: (state) => !!state.user,
    authUser: (state) => state.user,
  },
  actions: {
    async login(account_id, password) {
      const tonken = await authService.login(account_id, password);
      console.log("Đăng nhập thành công");
      const response = await authService.getInfo();
      this.user = response.data.data;
      this.token = tonken.data.access_token;
    },

    async register(account_id, email, password, password_confirmation) {
      const response = await authService.register(account_id, email, password, password_confirmation);
      console.log("Đăng kí thành công");
      console.log(response);
      this.user = response.data.data.user;
      this.token = response.data.data.token;
    },

    async logout() {
      await authService.logout();
      checkCookie('XSRF-TOKEN', '');
      sessionStorage.removeItem('token');
      sessionStorage.removeItem('user');
      window.location.reload();
    },
  },

  persist: {
    enabled: true,
    strategies: [{
        key: 'user',
        paths: ['user'],
        storage: sessionStorage,
      },
      {
        key: 'token',
        paths: ['token'],
        storage: sessionStorage,
      }
    ],
  },
})
