import { defineStore } from 'pinia'
import cartService from '../services/cartService'

export const useCartStore = defineStore('cart', {
  state: () => {
    return {
      cart: [],
      error: null
    }
  },
  actions: {
    async fetchCart(conditions) {
      try {
        this.error = null
        const response = await cartService.fetchCart(conditions)
        this.cart = response.data.data

        return response
      } catch (error) {
        this.error = error.message
        return error
      }
    },

    async addToCart(cart) {
      try {
        this.error = null
        const response = await cartService.addToCart(cart)
        await cartService.fetchCart()
        this.cart.push(response.data.data)
        return response
      } catch (error) {
        this.error = error.message

        return error
      }
    },

    async updateCart(cartId, cart) {
      try {
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
      }
    },

    async deleteCart(cartId) {
      try {
        this.error = null
        const result = await cartService.deleteCart([cartId])
        await cartService.fetchCart()
        
        return result
      } catch (error) {
        this.error = error.message

        return error
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
