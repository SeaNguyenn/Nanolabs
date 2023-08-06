<template>
  <FilterProductsComp :products="productData" :productList="productList"/>
</template>

<script setup>
import FilterProducts from '@/components/Products/FilterProducts/FilterProducts.vue';
import { ref, defineComponent, computed, onBeforeMount } from 'vue'
import { useProductStore } from '@/stores/product.js';
import { useRoute } from "vue-router";

const FilterProductsComp = defineComponent(FilterProducts)

const route = useRoute();
const productStore = useProductStore();
const perPage = ref(15);
const search = route.query.search;
const sortField = ref('created_at');
const sortDirection = ref('desc');

productStore.fetchProducts({
  search: search,
  per_page: perPage.value,
  sort_field: sortField.value,
  sort_direction: sortDirection.value,
})

const productList = computed(() => productStore.products);
const productData = ref(null)
const getProduct = async () => {
  await productStore.fetchProducts({
    search: search,
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