import { defineStore } from 'pinia'

export const authStore = defineStore('auth', {
  state: () => ({
    user: null,
  }),
  getters: {
    isAuthenticated: (state) => !!state.user,
    authUser: (state) => state.user,
  },
  actions: {
    async login(account_id, password) {
      const response = await authService.login(account_id, password);
      console.log("Đăng nhập thành công");
      this.user.name = response.data.data.account_id;
    },

    // async register(account_id, password, email) {
    //   const response = await authService.register(account_id, password, email);
    //   console.log(response);
    //   // localStorage.setItem('NAME', response.data.data.account_id);
    //   // console.log("Đăng kí thành công");
    // },

    async logout() {
      await authService.logout();
      document.cookie = 'XSRF-TOKEN=; max-age=0';
      this.user.name = null;
    },
  },

  persist: {
    enabled: true,
    strategies: [{
        key: 'user',
        paths: ['user'],
        storage: localStorage,
      }
    ],
  },
})
