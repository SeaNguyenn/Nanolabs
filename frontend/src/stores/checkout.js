import { defineStore } from 'pinia';
import checkoutService from '../services/checkoutService';

export const useCheckoutStore = defineStore('checkout', {
  state: () => ({
    checkoutUrl: '',
  }),
  actions: {
    async startCheckout(data) {
      try {
        const url = await checkoutService.createCheckout(data);
        
        return url
      } catch (error) {
        console.error('Error starting checkout:', error);

        return error
      }
    },
  },
});
