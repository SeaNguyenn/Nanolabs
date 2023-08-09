import {defineStore} from 'pinia'
import categoryService from '../services/categoryService'

export const useCategoryStore = defineStore('category', {
    state: () => {
        return {
            categories: [],
            category: null,
            error: null
        }
    },
    actions: {
        async fetchCategories(conditions) {
            try {
                this.error = null
                const response = await categoryService.fetchCategories(conditions)
                this.categories = response.data.data
            } catch (error) {
                this.error = error.message
            }
        },

        async showCategory(categoryId) {
            try {
                this.error = null;
                const response = await categoryService.showCategory(categoryId);
                this.category = response.data.data

                return response;
            } catch (error) {
                this.error = error.message

                return error;
            }
        },

        async addCategory(category) {
            try {
                this.error = null
                const response = await categoryService.addCategory(category)
                this.categories.push(response.data.data);
            } catch (error) {
                this.error = error.message
            }
        },

        async updateCategory(categoryId, category) {
            try {
                this.error = null
                const response = await categoryService.updateCategory(categoryId, category)
                const index = this.categories.findIndex((p) => p.id === categoryId)
                if (index !== -1) {
                    this.categories.splice(index, 1, response.data.data.data)
                }
            } catch (error) {
                this.error = error.message
            }
        },

        async deleteCategory(categoryId) {
            try {
                this.error = null
                await categoryService.deleteCategory(categoryId)
                const index = this.categories.findIndex((p) => p.id === categoryId)
                if (index !== -1) {
                    this.categories.splice(index, 1)
                }
            } catch (error) {
                this.error = error.message
            }
        }
    },

    getters: {
        getCategories() {
            return this.categories
        },
        getCategory() {
            return this.category
        },
        getError() {
            return this.error
        }
    }
})
