import http from '@/httpCommon.js'

export default {
  async fetchCategories(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/categorys', {
      params: conditions
    })
  },

  async showCategory(categoryId) {
    return http.get(import.meta.env.VITE_API_BASE_PATH + `/categorys/${categoryId}`)
  },

  async addCategory(category) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/categorys/create', category)
  },

  async updateCategory(categoryId, category) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/categorys/update/${categoryId}`, category)
  },

  async deleteCategory(categoryId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/categorys/delete/${categoryId}`)
  }
}
