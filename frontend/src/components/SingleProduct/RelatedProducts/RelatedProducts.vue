<template>
  <div class="flex flex-wrap gap-2.5 md:gap-5">
    <Products/>
  </div>
</template>

<script>
import Products from '@/components/Products/Products.vue';
export default {
  components: {
    Products,
  },
}
</script>

<style scoped></style>