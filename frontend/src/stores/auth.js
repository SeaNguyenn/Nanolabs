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
      const loginData = await authService.login(account_id, password);
      const response = await authService.getInfo();
      this.user = response.data.data;
      this.token = loginData.data.token;
    },

    async register(account_id, email, password, password_confirmation) {
      const response = await authService.register(account_id, email, password, password_confirmation);
      this.user = response.data.user;
      this.token = response.data.token;
    },

    async logout() {
      await authService.logout();
      checkCookie('XSRF-TOKEN', '');
      sessionStorage.removeItem('token');
      sessionStorage.removeItem('user');
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
