<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-[#2196F3] text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <Header @scrolled="scroll" @inputSearch="handleInput" />
  </header>

  <section>
    <SingleProduct :product="productData"/>
  </section>
  
  <Footer />
</template>

<script setup>
import Header from '@/components/Header/Header.vue';
import Footer from '@/components/Footer/Footer.vue';
import SingleProduct from '@/components/SingleProduct/SingleProduct.vue';
// import ProductDetail from '@/components/SingleProduct/ProductDetail/ProductDetail.vue';
import { ref, defineComponent, computed, onBeforeMount } from 'vue'
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

const onScroll = ref(false);
const scroll = (e) => {
  onScroll.value = e;
}

const handleInput = (e) => {
  console.log(e);
}
</script>

<style scoped></style>