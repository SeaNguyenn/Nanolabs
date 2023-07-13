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
        this.product = response.data
      } catch (error) {
        this.error = error.message;
      }
      this.loading = false;
    },

    async updateProduct(productId, product) {
      this.loading = true;
      this.error = null;
      try {
        const response =  await productService.updateProduct(productId, product);
        this.product = response.data
      } catch (error) {
        this.error = error.message;
      }
      this.loading = false;
    },

    async deleteProduct(productId) {
      this.loading = true;
      this.error = null;
      try {
        this.product = await productService.deleteProduct(productId);
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
