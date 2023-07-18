import { defineStore } from 'pinia'
import productService from '../services/productService'

export const useProductStore = defineStore('product', {
  state: () => {
    return {
      products: [],
      product: null,
      loading: false,
      error: null,
    }
  },
  actions: {
    async fetchProducts(conditions) {
      this.loading = true;
      this.error = null;
      try {
        const response = await productService.fetchProducts(conditions);
        this.products = response.data
      } catch (error) {
        this.error = error.message;
      }

      this.loading = false;
    },

    async showProduct(productId) {
      this.loading = true;
      this.error = null;
      try {
        const response = await productService.showProduct(productId);
        this.product = response.data;
      } catch (error) {
        this.error = error.message;
      }
      this.loading = false;
    },

    async addProduct(product) {
      this.loading = true;
      this.error = null;
      try {
        const response = await productService.addProduct(product);
        this.products.push(response.data);
      } catch (error) {
        this.error = error.message;
      }
      this.loading = false;
    },

    async updateProduct(productId, product) {
      try {
        this.loading = true;
        this.error = null;
        const response =  await productService.updateProduct(productId, product);
        const index = this.products.findIndex((p) => p.id === productId)
        if (index !== -1) { 
          this.products.splice(index, 1, response.data)
        }
      } catch (error) {
        this.error = error.message;
      }
      this.loading = false;
    },

    async deleteProduct(productId) {
      try {
        this.loading = true;
        this.error = null;
        await productService.deleteProduct(productId);
        const index = this.products.findIndex((p) => p.id === productId)
        if (index !== -1) { 
          this.products.splice(index, 1)
        }
      } catch (error) {
        this.error = error.message;
      }
      this.loading = false;
    },
  },

  getters: {
    getProducts() {
      return this.products;
    },
    getProduct() { 
      return this.product;
    },
    getLoading() {
      return this.loading;
    },
    getError() {
      return this.error;
    }
  },
})