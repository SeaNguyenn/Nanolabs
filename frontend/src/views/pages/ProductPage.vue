<template>
  <SingleProduct :product="productData"/>
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

const product = computed(() => productStore.product);
const productData = ref(null)
const getProduct = async () => {
  await productStore.showProduct(productId)
}

onBeforeMount(async () => {
  await getProduct()
  productData.value = productStore.product
});
</script>

<style scoped></style>