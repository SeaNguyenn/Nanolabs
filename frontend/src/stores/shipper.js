import { defineStore } from 'pinia'
import shipperService from '../services/shipperService'

export const useShipperStore = defineStore('shipper', {
  state: () => {
    return {
      shippers: [],
      shipper: null,
      loading: false,
      error: null
    }
  },
  actions: {
    async fetchShippers(conditions) {
      try {
        this.loading = true
        this.error = null
        const response = await shipperService.fetchShippers(conditions)
        this.shippers = response.data.data
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    },

    async showShipper(shipperId) {
      try {
        this.loading = true
        this.error = null
        const response = await shipperService.showShipper(shipperId)
        this.shipper = response.data.data
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    },

    async addShipper(shipper) {
      try {
        this.loading = true
        this.error = null
        const response = await shipperService.addShipper(shipper)
        this.shippers.push(response.data.data);
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    },

    async updateShipper(shipperId, shipper) {
      try {
        this.loading = true
        this.error = null
        const response = await shipperService.updateShipper(shipperId, shipper)
        const index = this.shippers.findIndex((p) => p.id === shipperId)
        if (index !== -1) { 
          this.shippers.splice(index, 1, response.data.data)
        }
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    },

    async deleteShipper(shipperId) {
      try {
        this.loading = true
        this.error = null
        await shipperService.deleteShipper(shipperId)
        const index = this.shippers.findIndex((p) => p.id === shipperId)
        if (index !== -1) { 
          this.shippers.splice(index, 1)
        }
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    }
  },

  getters: {
    getShippers() {
      return this.shippers
    },
    getShipper() {
      return this.shipper
    },
    getLoading() {
      return this.loading
    },
    getError() {
      return this.error
    }
  }
})
