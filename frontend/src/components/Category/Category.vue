<template>
  <div class="my-[30px] md:my-[75px]">
    <div class="max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
      <div class="title text-2xl md:text-3xl">
        Category Title
      </div>
      <Products :offHeading= 'true'/>
    </div>
  </div>
</template>

<script>
import Products from '@/components/Products/Products.vue'
import { ref } from 'vue'
export default {
  components: {
    Products,
  },

  setup(props,{emit}) {
  }
}
</script>

<style scoped></style>