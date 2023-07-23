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
      try {
        this.loading = true;
        this.error = null;
        const response = await productService.fetchProducts(conditions);
        this.products = response.data.data
      } catch (error) {
        this.error = error.message;
      }

      this.loading = false;
    },

    async showProduct(productId) {
      try {
        this.loading = true;
        this.error = null;
        const response = await productService.showProduct(productId);
        this.product = response.data.data

        return response;
      }catch (error) {
        this.error = error.message

        return error;
      }finally {
        this.loading = false
      }
    },

    async addProduct(product) {
      try {
        this.loading = true;
        this.error = null;
        const response = await productService.addProduct(product);
        this.products.push(response.data.data);
        return response;
      } catch (error) {
        this.error = error.message

        return error;
      }finally {
        this.loading = false
      }
    },

    async updateProduct(productId, product) {
      try {
        this.loading = true;
        this.error = null;
        const response =  await productService.updateProduct(productId, product);
        const index = this.products.findIndex((p) => p.id === productId)
        if (index !== -1) { 
          this.products.splice(index, 1, response.data.data.data)
        }
        return response;
      } catch (error) {
        this.error = error.message
        
        return error
      }finally {
        this.loading = false
      }
    },

    async deleteProduct(productId) {
      try {
        this.loading = true;
        this.error = null;
        const result = await productService.deleteProduct(productId);
        const index = this.products.findIndex((p) => p.id === productId)
        if (index !== -1) { 
          this.products.splice(index, 1)
        }
        return result;
      } catch (error) {
        this.error = error.message

        return error
      }finally {
        this.loading = false
      }
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
