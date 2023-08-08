import http from '@/httpCommon.js'

export default {
  async fetchOrders(conditions) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/orders', conditions)
  },

  async getOrder(orderId) {
    return http.get(import.meta.env.VITE_API_BASE_PATH + `/order/${orderId}`)
  },

  async addOrder(order) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + '/order/create', order)
  },

  async updateOrderStatusAndShipper(orderId, order) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/order/update/${orderId}`, order)
  },
  
  async canceledOrder(orderId, order) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/order/canceled/${orderId}`, order)
  },

  async deleteOrder(orderId) {
    return http.post(import.meta.env.VITE_API_BASE_PATH + `/order/delete/${orderId}`)
  }
}
