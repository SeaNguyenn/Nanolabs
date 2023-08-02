<template>
  <SingleProduct :product="productData" :products="products"/>
</template>

<script setup>
import SingleProduct from '@/components/SingleProduct/SingleProduct.vue';
import { ref, computed, onBeforeMount } from 'vue'
import { useRoute } from "vue-router";
import { useProductStore } from '@/stores/product.js';

const route = useRoute();
const productId = route.params.productId;
const productStore = useProductStore();
productStore.showProduct(productId)

const perPage = ref(5);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');

productStore.fetchProducts({
  search: search.value,
  per_page: perPage.value,
  sort_field: sortField.value,
  sort_direction: sortDirection.value,
})

const product = computed(() => productStore.product);
const productData = ref(null)
const getProduct = async () => {
  await productStore.showProduct(productId)
}

const productList = computed(() => productStore.products);
const products = ref(null)
const getProducts = async () => {
  await productStore.fetchProducts({
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
  })
}

onBeforeMount(async () => {
  await getProduct()
  productData.value = productStore.product
  products.value = productList.value.data
});
</script>

<style scoped></style>