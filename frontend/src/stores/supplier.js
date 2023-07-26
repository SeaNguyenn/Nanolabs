import { defineStore } from 'pinia'
import supplierService from '../services/supplierService'

export const useSupplierStore = defineStore('supplier', {
  state: () => {
    return {
      suppliers: [],
      supplier: null,
      loading: false,
      error: null
    }
  },
  actions: {
    async fetchSuppliers(conditions) {
      try {
        this.loading = true
        this.error = null
        const response = await supplierService.fetchSuppliers(conditions)
        this.suppliers = response.data.data
      } catch (error) {
        this.error = error.message
      }

      this.loading = false
    },

    async showSupplier(supplierId) {
      try {
        this.loading = true
        this.error = null
        const response = await supplierService.showSupplier(supplierId)
        this.supplier = response.data.data

        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async addSupplier(supplier) {
      try {
        this.loading = true
        this.error = null
        const response = await supplierService.addSupplier(supplier)
        this.suppliers.push(response.data.data)
        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async updateSupplier(supplierId, supplier) {
      try {
        this.loading = true
        this.error = null
        const response = await supplierService.updateSupplier(supplierId, supplier)
        const index = this.suppliers.findIndex((p) => p.id === supplierId)
        if (index !== -1) {
          this.suppliers.splice(index, 1, response.data.data.data)
        }
        return response
      } catch (error) {
        this.error = error.message

        return error
      } finally {
        this.loading = false
      }
    },

    async deleteSupplier(supplierId) {
      try {
        this.loading = true
        this.error = null
        const result = await supplierService.deleteSupplier(supplierId)
        const index = this.suppliers.findIndex((p) => p.id === supplierId)
        if (index !== -1) {
          this.suppliers.splice(index, 1)
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
    getSuppliers() {
      return this.suppliers
    },
    getSupplier() {
      return this.supplier
    },
    getLoading() {
      return this.loading
    },
    getError() {
      return this.error
    }
  }
})
