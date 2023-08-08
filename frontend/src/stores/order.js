import { defineStore } from 'pinia'
import orderService from '../services/orderService'

export const useOrderStore = defineStore('order', {
  state: () => {
    return {
      orders: [],
      order: null,
      loading: false,
      error: null
    }
  },
  actions: {
    async fetchOrders(conditions) {
      try {
        this.loading = true
        this.error = null
        const response = await orderService.fetchOrders(conditions)
        this.orders = response.data.data
      } catch (error) {
        this.error = error.message
      }

      this.loading = false
    },

    async showOrder(orderId) {
      try {
        this.loading = true
        this.error = null
        const response = await orderService.getOrder(orderId)
        this.order = response.data.data

        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async addOrder(order) {
      try {
        this.loading = true
        this.error = null
        const response = await orderService.addOrder(order)
        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async updateOrderStatusAndShipper(orderId, order) {
      try {
        this.loading = true
        this.error = null
        const response = await orderService.updateOrderStatusAndShipper(orderId, order)
        const index = this.orders.findIndex((p) => p.id === orderId)
        if (index !== -1) {
          this.orders.splice(index, 1, response.data.data.data)
        }
        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async canceledOrder(orderId) {
      try {
        this.loading = true
        this.error = null
        const result = await orderService.canceledOrder(orderId)
      
        return result
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async deleteOrder(orderId) {
      try {
        this.loading = true
        this.error = null
        const result = await orderService.deleteOrder(orderId)
        const index = this.orders.findIndex((p) => p.id === orderId)
        if (index !== -1) {
          this.orders.splice(index, 1)
        }
        return result
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    }
  },

  getters: {
    getOrders() {
      return this.orders
    },
    getOrder() {
      return this.order
    },
    getLoading() {
      return this.loading
    },
    getError() {
      return this.error
    }
  }
})
