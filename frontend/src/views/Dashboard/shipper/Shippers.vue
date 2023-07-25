<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Shippers</h1>
    <button type="button" @click="showAddNewModal"
      class="rounded-md bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
      Tạo mới
    </button>
  </div>
  <ShipperModal v-model="showShipperModal" :shipper="shipperModel" @close="onModalClose"/>
  <ShipperTable @clickEdit="editshipper" />
</template>

<script setup>
import { ref } from 'vue'
import { useShipperStore } from '@/stores/shipper.js';
import ShipperTable from './ShipperTable.vue'
import ShipperModal from './ShipperModal.vue'

const DEFAULT_SHIPPER = {
  id: '',
  name: '',
  email: '',
  phone: '',
  address: '',
  avatar: '',
}

function showAddNewModal() {
  showShipperModal.value = true
}

const showShipperModal = ref(false);

const shipperModel = ref({...DEFAULT_SHIPPER});


function onModalClose() {
  shipperModel.value = {...DEFAULT_SHIPPER}
}

const shipperStore = useShipperStore();

function editshipper(p) {
  shipperStore.showShipper(p.id).then(res => {
    shipperModel.value = res.data.data;
    showAddNewModal();
  });
}
</script>

