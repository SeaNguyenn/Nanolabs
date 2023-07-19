import { defineStore } from 'pinia'
import categoryService from '../services/categoryService'

export const useCategoryStore = defineStore('category', {
  state: () => {
    return {
      categories: [],
      category: null,
      loading: false,
      error: null
    }
  },
  actions: {
    async fetchcategorys(conditions) {
      try {
        this.loading = true
        this.error = null
        const response = await categoryService.fetchCategories(conditions)
        this.categories = response.data
      } catch (error) {
        this.error = error.message
      }

      this.loading = false
    },

    async showCategory(categoryId) {
      try {
        this.loading = true
        this.error = null
        const response = await categoryService.showCategory(categoryId)
        this.category = response.data
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    },

    async addCategory(category) {
      try {
        this.loading = true
        this.error = null
        const response = await categoryService.addCategory(category)
        this.categories.push(response.data);
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    },

    async updateCategory(categoryId, category) {
      try {
        this.loading = true
        this.error = null
        const response = await categoryService.updateCategory(categoryId, category)
        const index = this.categories.findIndex((p) => p.id === categoryId)
        if (index !== -1) { 
          this.categories.splice(index, 1, response.data)
        }
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    },

    async deleteCategory(categoryId) {
      try {
        this.loading = true
        this.error = null
        await categoryService.deleteCategory(categoryId)
        const index = this.categories.findIndex((p) => p.id === categoryId)
        if (index !== -1) { 
          this.categories.splice(index, 1)
        }
      } catch (error) {
        this.error = error.message
      }
      this.loading = false
    }
  },

  getters: {
    getCategories() {
      return this.categories
    },
    getCategory() {
      return this.category
    },
    getLoading() {
      return this.loading
    },
    getError() {
      return this.error
    }
  }
})
