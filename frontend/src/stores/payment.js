import { defineStore } from 'pinia'

export const usePaymentStore = defineStore('payment', {
  state: () => ({
    paymentData: null
  }),
  actions: {
    setPaymentData(data) {
      this.paymentData = data
    }
  }
})
