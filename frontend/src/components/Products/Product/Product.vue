<template>
  <a :href="`product/${index}`">
    <div class="w-[250px] rounded border-[1px] bg-white p-2 mb-5 relative hover:border-red-400">
        <div v-if="product.sale_price" class="absolute top-0 left-0 z-[1]">
        <div class="bg-yellow-300 h-12 rounded-b-lg flex items-center justify-center flex-col p-1">
          <span class="text-red-500">{{ Math.round(discount) }}%</span>
          <span class="text-white">GIẢM</span>
        </div>
      </div>
      <div class="w-full bg-white mb-2.5 p-6 flex items-center border-b-[1px]">
        <img :src="product.image" alt="">
      </div>
      <div class="prod-detail flex flex-col gap-2 mt-3">
        <span class="prod-name text-black text-base block text-ellipsis whitespace-nowrap overflow-hidden md:text-sm">{{
          product.name
        }}</span>
        <Rating :rating="star" />
        <span class="price text-base text-red-400 md:text-sm py-2">
          <sup>₫</sup>{{ product.sale_price ? Number(product.sale_price).toLocaleString("en-US") :
            Number(product.price).toLocaleString("en-US") }}
        </span>
      </div>
    </div>
  </a>
</template>

<script setup>
import { ref, defineProps,computed } from 'vue'
import { Rating } from 'flowbite-vue'

const props = defineProps({
  product: Object,
  index: Number
})

const discount = (props.product.price - props.product.sale_price) / props.product.price * 100;
const star = ref(Number(props.product.evaluate))
</script>
<style scoped>
img {
  transition: all ease 0.3s;
  display: block;
  width: 100%;
}
</style>