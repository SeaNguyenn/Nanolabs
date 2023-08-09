<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Danh sách hoá đơn</h1>
    <button type="button" @click="showAddNewModal"
            class="rounded-md bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
      Tạo mới
    </button>
  </div>
  <OrderModal v-model="showOrderModal" :order="orderModel" @close="onModalClose"/>
  <OrderTable @clickEdit="editOrder" />
</template>

<script setup>
import { ref } from 'vue';
import OrderTable from './OrderTable.vue'
import OrderModal from './OrderModal.vue'
import { useOrderStore } from '@/stores/order.js';

const DEFAULT_PRODUCT = {
  id: '',
  shipper_id: '',
  user_id: '',
  shipping_method_id: '',
  order_status: '',
  order_date: '',
  shipped_date: '',
  required_date: '',
}

function showAddNewModal() {
  showOrderModal.value = true
}

const showOrderModal = ref(false);

const orderModel = ref({...DEFAULT_PRODUCT});

function onModalClose() {
  orderModel.value = {...DEFAULT_PRODUCT}
}

const orderStore = useOrderStore();

function editOrder(p) {
  orderStore.showOrder(p.id).then(res => {
    orderModel.value = res.data.data;
    showAddNewModal();
  });
}
</script>

<style scoped></style>