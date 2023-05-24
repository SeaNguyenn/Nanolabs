<template>
  <div>
    <div>Những sản phẩm đang bán chạy</div>
    <div>
      <Product/>
      <Product/>
      <Product/>
      <Product/>
      <Product/>
      <Product/>
    </div>
  </div>
</template>

<script>
import Product from '@/components/Product.vue';
export default {
  components: {
    Product,
  },
}
</script>

<style scoped></style>