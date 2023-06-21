import http from '@/httpCommon.js'

export default {
  async login(account_id, password) {
    await http.get('/sanctum/csrf-cookie')
    return http.post('/login', {
      account_id: account_id,
      password: password,
    })
  },

  async register(account_id, email, password) {
    return http.post('/register', {
      account_id: account_id,
      email: email,
      password: password,
    })
  },

  async getInfo() {
    return http.get(import.meta.env.VITE_API_BASE_PATH + "/get-info");
  },

  async logout() {
    return http.post('/logout');
  },
}
