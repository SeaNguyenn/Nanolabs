<template>
  <div v-bind:class="offHeading ? 'my-[20px] md:my-[50px]' : 'my-[50px] md:my-[75px]' ">
    <div
      class="mb-4 text-lg font-medium uppercase md:mb-9 md:text-2xl after:content-[''] after:block after:mt-1 after:w-[70px] after:h-1 after:bg-fuchsia-500 md:mt-3"
      v-if="!offHeading"
      >
      {{headingText}}</div>
    <div class="flex flex-wrap gap-2.5 md:gap-5">
      <Product />
      <Product />
      <Product />
      <Product />
      <Product />
      <Product />
      <Product />
      <Product />
    </div>
  </div>
</template>

<script>
import Product from '@/components/Products/Product/Product.vue';
export default {
  props:{
    offHeading: Boolean,
    headingText: String,
  },

  components: {
    Product,
  },

  setup(props) {

  }
}
</script>

<style scoped></style>