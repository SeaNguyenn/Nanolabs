import http from '@/httpCommon.js'

export default {
  async createCheckout(data) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/checkout/payment', data)
  },
}
