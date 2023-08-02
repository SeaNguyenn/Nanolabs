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

          <span class="text-3xl mb-5 text-red-500 line-through decoration-red-400">{{ Number(productData.price).toLocaleString("en-US") }}<sup>₫</sup></span>
          <span class="text-3xl mb-5 text-red-500" v-if="productData.sale_price > 0">{{ Number(productData.sale_price).toLocaleString("en-US") }}<sup>₫</sup></span>

          <div class="flex items-center gap-5 mb-5 md:gap-10">
            <span class="text-base md:text-lg text-second-text-color">Số lượng</span>
            <div class="text-base md:text-lg flex">
              <a-input v-model:value="quantityNum" placeholder="1" class="w-[40px] border-[1px] border-[rgba(0,0,0,.09)] text-center"/>
            </div>
          </div>

          <div class="flex gap-2.5 mb-8">
            <span class="text-base md:text-lg text-second-text-color mr-2.5 md:mr-5">Được bảo hành {{ productData.warranty }} tháng</span>
          </div>

          <div class="flex gap-5 items-center flex-wrap">
            <Button @click="addToCart" class="flex gap-1 items-center justify-center px-2 py-3 bg-red-200 text-red-600 text-lg border-[1px] border-solid border-red-700 md:text-xl md:p-5">
              <Icon icon="mi:shopping-cart-add" class="mr-2 text-2xl"/>Thêm vào giỏ hàng
            </Button>
            <Button class="px-2 py-3 bg-red-600 text-white text-lg md:text-xl md:p-5">Mua ngay</Button>
          </div>
        </div>
      </div>
      <ProductDetail :description="productData.description"/>
      <Products :headingText="headingFeaturedProducts" :products="products" />
    </div>
  </div>
  <AddToCartModal v-if="showSuccessModal" @close="showSuccessModal = false" />
</template>

<script setup>
import Button from '@/components/Button.vue'
import { ref,defineProps ,watch} from 'vue'
import ProductDetail from './ProductDetail/ProductDetail.vue'
import Products from '@/components/Products/Products.vue';
import { Rating } from 'flowbite-vue'
import { Icon } from '@iconify/vue';
import { useCartStore } from '@/stores/cart.js';
import AddToCartModal from './AddToCartModal.vue'

const props = defineProps({
  product: Object,
  products: Object,
})

const showSuccessModal = ref(false);
const headingFeaturedProducts = "Những sản phẩm đang bán chạy";
const productData = ref([])
const star = ref()
const quantityNum = ref(1);
const cartStore = useCartStore();

watch(() => props.product, (value) => {
  productData.value = value
  star.value = Number(productData.value.evaluate)
})

const addToCart = async () => {
  try {
    const cartItem = { product_id: productData.value?.id, quantity: quantityNum.value };

    cartStore.addToCart(cartItem).then(res => {
      showSuccessModal.value = true;
    });
  } catch (error) {
    console.error('Lỗi khi thêm vào giỏ hàng:', error);
  }
};


</script>
