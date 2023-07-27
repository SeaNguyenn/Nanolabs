import http from '@/httpCommon.js'

export default {
  async fetchShippers(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/shippers', conditions)
  },

  async showShipper(shipperId) {
    return http.get(import.meta.env.VITE_API_BASE_PATH + `/shipper/${shipperId}`)
  },

  async addShipper(shipper) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/shipper/create', shipper , {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  async updateShipper(shipperId, shipper) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/shipper/update/${shipperId}`, shipper, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  async deleteShipper(shipperId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/shipper/delete/${shipperId}`)
  }
}
