<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Danh sách danh mục</h1>
    <button type="button" @click="showAddNewModal"
      class="rounded-md bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
      Tạo mới
    </button>
  </div>
  <CategoryModal v-model="showCategoryModal" :category="categoryModel" @close="onModalClose"/>
  <CategoryTable @clickEdit="editCategory" />
</template>

<script setup>
import { ref } from 'vue';
import CategoryTable from './CategoryTable.vue'
import CategoryModal from './CategoryModal.vue'
import { useCategoryStore } from '@/stores/category.js';

const DEFAULT_CATEGORY = {
  id: '',
  name: '',
  parent_id: '',
}

function showAddNewModal() {
  showCategoryModal.value = true
}

const showCategoryModal = ref(false);

const categoryModel = ref({...DEFAULT_CATEGORY});

function onModalClose() {
  categoryModel.value = {...DEFAULT_CATEGORY}
}

const categoryStore = useCategoryStore();

function editCategory(p) {
  categoryStore.showCategory(p.id).then(res => {
    categoryModel.value = res.data.data;
    showAddNewModal();
  });
}
</script>

<style scoped></style>