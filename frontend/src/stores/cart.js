import { defineStore } from 'pinia'
import cartService from '../services/cartService'

export const useCartStore = defineStore('cart', {
  state: () => {
    return {
      cart: [],
      loading: false,
      error: null
    }
  },
  actions: {
    async fetchCart(conditions) {
      try {
        this.loading = true
        this.error = null
        const response = await cartService.fetchCart(conditions)
        this.cart = response.data.data

        return response
      } catch (error) {
        this.error = error.message
        return error
      } finally {
        this.loading = false
      }
    },

    async addCart(cart) {
      try {
        this.loading = true
        this.error = null
        const response = await cartService.addCart(cart)
        this.cart.push(response.data.data)
        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async updateCart(cartId, cart) {
      try {
        this.loading = true
        this.error = null
        const response = await cartService.updateCart(cartId, cart)
        const index = this.cart.findIndex((p) => p.id === cartId)
        if (index !== -1) {
          this.cart.splice(index, 1, response.data.data.data)
        }
        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async deleteCart(cartId) {
      try {
        this.loading = true
        this.error = null
        const result = await cartService.deleteCart(cartId)
        const index = this.cart.findIndex((p) => p.id === cartId)
        if (index !== -1) {
          this.cart.splice(index, 1)
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
    getCart() {
      return this.cart
    },
    getLoading() {
      return this.loading
    },
    getError() {
      return this.error
    }
  }
})
