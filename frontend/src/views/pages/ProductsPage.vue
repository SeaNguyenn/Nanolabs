<template>
  <FilterProductsComp :products="productData" :productList="productList"/>
</template>

<script setup>
import FilterProducts from '@/components/Products/FilterProducts/FilterProducts.vue';
import { ref, defineComponent, computed, onBeforeMount } from 'vue'
import { useProductStore } from '@/stores/product.js';

const FilterProductsComp = defineComponent(FilterProducts)

const productStore = useProductStore();
const perPage = ref(15);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');

productStore.fetchProducts({
  search: search.value,
  per_page: perPage.value,
  sort_field: sortField.value,
  sort_direction: sortDirection.value,
})

const productList = computed(() => productStore.products);
const productData = ref(null)
const getProduct = async () => {
  await productStore.fetchProducts({
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
  })
}

onBeforeMount(async () => {
  await getProduct()
  productData.value = productList.value.data
});
</script>

<style scoped></style>