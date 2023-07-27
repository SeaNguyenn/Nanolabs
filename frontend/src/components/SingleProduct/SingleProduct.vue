<template>
  <div class="my-5 md:my-[75px]">
    <div class="max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
      <div class="flex flex-col md:flex-row">
        <div class="w-full bg-[#0000000d] flex-shrink-0 md:w-[600px] md:h-[600px]">
          <img :src="productData.image" alt="" class="w-full block">
        </div>
        <div class="flex flex-col pt-5 md:px-[35px]">
          <span class="text-xl mb-5 md:text-2xl">{{productData.name}}</span>

          <div class="star-rating flex gap-1 mb-5">
            <Rating :rating="star" />
          </div>

          <span class="text-3xl mb-5"><sup class="mr-1">₫</sup>9000000 </span>

          <div class="flex items-center gap-5 mb-5 md:gap-10">
            <span class="text-base md:text-lg text-second-text-color">Số lượng</span>
            <div class="text-base md:text-lg flex">
              <button class="border-[1px] px-2 border-[rgba(0,0,0,.09)]" @click="minusQuantity"><Icon icon="humbleicons:minus" /></button>
              <a-input v-model:value="quantityNum" placeholder="1" class="w-[40px] border-[1px] border-[rgba(0,0,0,.09)] text-center"/>
              <button class="border-[1px] px-2 border-[rgba(0,0,0,.09)]" @click="plusQuantity"><Icon icon="octicon:plus-24" /></button>
            </div>
            <span class="text-base md:text-lg text-second-text-color">
              <span class="text-base text-second-text-color">5</span> sản phẩm có sẵn
            </span>
          </div>

          <div class="flex gap-2.5 mb-8">
            <span class="text-base md:text-lg text-second-text-color mr-2.5 md:mr-5">Màu sắc</span>
            <div class="w-[30px] h-[30px] bg-red-500 rounded-full"></div>
            <div class="w-[30px] h-[30px] bg-blue-500 rounded-full"></div>
            <div class="w-[30px] h-[30px] bg-green-500 rounded-full"></div>
            <div class="w-[30px] h-[30px] bg-black rounded-full"></div>
          </div>

          <div class="flex gap-5 items-center flex-wrap">
            <Button class="flex gap-1 items-center justify-center px-2 py-3 bg-red-200 text-red-600 text-lg border-[1px] border-solid border-red-700 md:text-xl md:p-5">
              <Icon icon="mi:shopping-cart-add" class="mr-2 text-2xl"/>Thêm vào giỏ hàng
            </Button>
            <Button class="px-2 py-3 bg-red-600 text-white text-lg md:text-xl md:p-5">Mua ngay</Button>
          </div>
        </div>
      </div>
      <ProductDetail/>
      <RelatedProducts />
    </div>
  </div>
</template>

<script setup>
import Button from '@/components/Button.vue'
import RelatedProducts from '@/components/SingleProduct/RelatedProducts/RelatedProducts.vue'
import { ref,defineProps ,watch} from 'vue'
import ProductDetail from './ProductDetail/ProductDetail.vue'
import { Rating } from 'flowbite-vue'
import { Icon } from '@iconify/vue';

const props = defineProps({
  product: Object,
})

const productData = ref([])
const star = ref()

watch(() => props.product, (value) => {
  productData.value = value
  console.log();
  star.value = Number(productData.value.evaluate)
})
let quantityNum = ref(1);

const minusQuantity = () => {
  if (quantityNum.value === 0) return
  quantityNum.value -= 1
}

const plusQuantity = () => {
  quantityNum.value += 1;
}

</script>

<style scoped></style>