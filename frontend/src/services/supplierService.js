import http from '@/httpCommon.js'

export default {
  async fetchSuppliers(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/suppliers', conditions)
  },

  async showSupplier(supplierId) {
    return http.get(import.meta.env.VITE_API_BASE_PATH + `/supplier/${supplierId}`)
  },

  async addSupplier(supplier) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/supplier/create', supplier, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  async updateSupplier(supplierId, supplier) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/supplier/update/${supplierId}`, supplier, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  async deleteSupplier(supplierId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/supplier/delete/${supplierId}`)
  }
}
