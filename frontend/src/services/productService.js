import http from '@/httpCommon.js'

export default {
  async fetchProducts(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/products', {
      params: conditions,
    })
  },

  async showProduct(productId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/products/${productId}`)
  },

  async addProduct(product) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/products/create', product)
  },

  async updateProduct(productId, product) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/products/update/${productId}`, product)
  },

  async deleteProduct(productId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/products/delete/${productId}`)
  },

}
