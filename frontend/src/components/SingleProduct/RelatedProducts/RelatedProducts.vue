<template>
  <div class="flex flex-wrap gap-2.5 md:gap-5">
    <Products :headingText="headingText"/>
  </div>
</template>

<script>
import Products from '@/components/Products/Products.vue';
export default {
  components: {
    Products,
  },

  setup(props) {
    const headingText = "Những sản phẩm liên quan";

    return {
      headingText,
    }
  }
}
</script>

<style scoped></style>