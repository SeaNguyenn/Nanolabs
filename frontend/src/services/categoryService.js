import http from '@/httpCommon.js'

export default {
  async fetchCategories(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/categories', {
      params: conditions
    })
  },

  async showCategory(categoryId) {
    return http.get(import.meta.env.VITE_API_BASE_PATH + `/category/${categoryId}`)
  },

  async addCategory(category) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/category/create', category)
  },

  async updateCategory(categoryId, category) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/category/update/${categoryId}`, category)
  },

  async deleteCategory(categoryId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/category/delete/${categoryId}`)
  }
}
