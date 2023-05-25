<template>
  <div class="my-5 md:my-[75px]">
    <div class="max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
      <div class="flex flex-col md:flex-row">
        <div class="w-full bg-[#0000000d] flex-shrink-0 md:w-[600px] md:h-[600px]">
          <img src="@/assets/images/earbuds-prod-1.webp" alt="" class="w-full block">
        </div>
        <div class="flex flex-col pt-5 md:px-[35px]">
          <span class="text-xl mb-5 md:text-2xl">product name</span>

          <star-rating :star-size="15" :rounded-corners="true" :border-width="4"
            :star-points="[23, 2, 14, 17, 0, 19, 10, 34, 7, 50, 23, 43, 38, 50, 36, 34, 46, 19, 31, 17]"
            :show-rating="false" @update:rating="setRating" class="mb-5"></star-rating>

          <span class="text-3xl mb-5"><sup>₫</sup>price</span>

          <div class="flex items-center gap-5 mb-5 md:gap-10">
            <span class="text-base md:text-lg text-second-text-color">Số lượng</span>
            <div class="text-base md:text-lg flex">
              <button class="border-[1px] px-2 border-[rgba(0,0,0,.09)]"><Icon icon="humbleicons:minus" /></button>
              <a-input v-model:value="quantityNum" placeholder="1" class="w-[40px] border-[1px] border-[rgba(0,0,0,.09)] text-center"/>
              <button class="border-[1px] px-2 border-[rgba(0,0,0,.09)]"><Icon icon="octicon:plus-24" /></button>
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

      <RelatedProducts />
    </div>
  </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide } from 'vue3-carousel'
import Button from '@/components/Button.vue'
import RelatedProducts from '@/components/SingleProduct/RelatedProducts/RelatedProducts.vue'
import { ref } from 'vue'
import { Icon } from '@iconify/vue';
export default {
  components: {
    StarRating,
    Carousel,
    Slide,
    Navigation,
    Button,
    RelatedProducts,
    Icon,
  },

  setup(props) {

    let quantityNum = ref(1);
    let countRating = ref(0);

    const setRating = (rating) => {
      countRating.value = rating;
    }



    return {
      setRating,
      quantityNum,
    }
  }
}
</script>

<style scoped></style>