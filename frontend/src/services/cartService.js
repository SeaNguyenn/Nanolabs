import http from '@/httpCommon.js'

export default {
  async fetchCart(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/cart', conditions)
  },

  async addToCart(cart) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/cart/create', cart)
  },

  async updateCart(cartId, cart) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/cart/update/${cartId}`, cart)
  },

  async deleteCart(cartIds) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/cart/delete/', cartIds)
  }
}
