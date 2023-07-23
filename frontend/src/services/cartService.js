import http from '@/httpCommon.js'

export default {
  async fetchCart(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/cart', {
      params: conditions
    })
  },

  async addCart(cart) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/cart/create', cart)
  },

  async updateCart(cartId, cart) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/cart/update/${cartId}`, cart)
  },

  async deleteCart(cartId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/cart/delete/${cartId}`)
  }
}
