import http from '@/httpCommon.js'

export default {
  async fetchProducts(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/products', conditions)
  },

  async showProduct(productId) {
    return http.get(import.meta.env.VITE_API_BASE_PATH + `/product/${productId}`)
  },

  async addProduct(product) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/product/create', product, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  async updateProduct(productId, product) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/product/update/${productId}`, product,{
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  async deleteProduct(productId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/product/delete/${productId}`)
  },

}
