<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Danh sách sản phẩm</h1>
    <button type="button" @click="showAddNewModal"
      class="rounded-md bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
      Tạo mới
    </button>
  </div>
  <ProductModal v-model="showProductModal" :product="productModel" @close="onModalClose"/>
  <ProductTable @clickEdit="editProduct" />
</template>

<script setup>
import { ref } from 'vue';
import ProductTable from './ProductTable.vue'
import ProductModal from './ProductModal.vue'
import { useProductStore } from '@/stores/product.js';

const DEFAULT_PRODUCT = {
  id: '',
  supplier_id: '',
  name: '',
  code: '',
  description: '',
  price: '',
  sale_price: '',
  image: '',
  evaluate: '',
  color: '',
  material: '',
  warranty: '',
  material: '',
}

function showAddNewModal() {
  showProductModal.value = true
}

const showProductModal = ref(false);

const productModel = ref({...DEFAULT_PRODUCT});

function onModalClose() {
  productModel.value = {...DEFAULT_PRODUCT}
}

const productStore = useProductStore();

function editProduct(p) {
  productStore.showProduct(p.id).then(res => {
    productModel.value = res.data.data;
    showAddNewModal();
  });
}
</script>

<style scoped></style>