<template>
  <div v-bind:class="offHeading ? 'my-[20px] md:my-[50px]' : 'my-[50px] md:my-[75px]'">
    <div
      class="mb-4 text-lg font-medium uppercase md:mb-9 md:text-2xl after:content-[''] after:block after:mt-1 after:w-[70px] after:h-1 after:bg-fuchsia-500 md:mt-3"
      v-if="!offHeading">
      {{ headingText }}</div>
    <div class="flex flex-wrap gap-3">
      <div v-for="(product, index) in products" :key="index" >
        <ProductTemp :product="product" :index="index"/>
      </div>
    </div>
    
  </div>
</template>

<script setup>
import Product from '@/components/Products/Product/Product.vue';
import { defineComponent, defineProps, ref, watch } from 'vue'

const ProductTemp = defineComponent(Product)

const props = defineProps({
  offHeading: Boolean,
  headingText: String,
  products: Object,
})

const products = ref([])

watch(() => props.products, (value) => {
  products.value = value
})
</script>

<style scoped></style>