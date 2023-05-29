<template>
  <div class="my-[30px] md:my-[75px]">
    <div class="max-w-[calc(100%-20px)] my-0 mx-auto grid md:max-w-7xl grid-cols-[1fr] md:grid-cols-[0.2fr,1fr]">
      <div class="filter-section">
        <FilterSection/>
      </div>
      <div class="prorduct-view">
        <div class="sort-filter">
          <Sort/>
        </div>

        <div class="main-product-list">
          <ProductList/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FilterSection from './FilterSection.vue'
import Sort from './Sort.vue'
import ProductList from './ProductList.vue'
export default {
  components: {
    Sort,
    FilterSection,
    ProductList,
  },
}
</script>

<style scoped>
</style>