<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Danh sách nhà cung cấp</h1>
    <button type="button" @click="showAddNewModal"
      class="rounded-md bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
      Tạo mới
    </button>
  </div>
  <SupplierModal v-model="showSupplierModal" :supplier="supplierModel" @close="onModalClose" />
  <SupplierTable @clickEdit="editSupplier" />
</template>
  
<script setup>
import { ref } from 'vue';
import SupplierTable from './SupplierTable.vue'
import SupplierModal from './SupplierModal.vue'
import { useSupplierStore } from '@/stores/supplier.js';

const DEFAULT_SUPPLIER = {
  id: '',
  name: '',
  image: '',
  email: '',
  phone: '',
  address: '',
}

function showAddNewModal() {
  showSupplierModal.value = true
}

const showSupplierModal = ref(false);

const supplierModel = ref({ ...DEFAULT_SUPPLIER });

function onModalClose() {
  supplierModel.value = { ...DEFAULT_SUPPLIER }
}

const supplierStore = useSupplierStore();

function editSupplier(p) {
  supplierStore.showSupplier(p.id).then(res => {
    supplierModel.value = res.data.data;
    showAddNewModal();
  });
}
</script>
  
<style scoped></style>