<template>
  <Banner />
  <div class="main-content max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
    <div class="layout">
      <Category />
      <Products :headingText="headingFeaturedProducts" :products="productData" />
      <Products :headingText="headingProducts" :products="productData" />
    </div>
  </div>
  <Wrapper />
  <Newsletter />
</template>

<script setup>
import Banner from '@/components/Home/Banner/Banner.vue';
import Newsletter from '@/components/Footer/Newsletter/Newsletter.vue';
import Products from '@/components/Products/Products.vue';
import Category from '@/components/Home/Category/Category.vue';
import Wrapper from '@/components/Home/Wrapper/Wrapper.vue';
import { ref, computed, onBeforeMount } from 'vue'
import { useProductStore } from '@/stores/product.js';

const productStore = useProductStore();
const perPage = ref(5);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');

const headingFeaturedProducts = "Những sản phẩm đang bán chạy";
const headingProducts = "Những sản phẩm mới";

productStore.fetchProducts({
  search: search.value,
  per_page: perPage.value,
  sort_field: sortField.value,
  sort_direction: sortDirection.value,
})

const productList = computed(() => productStore.products);
const productData = ref(null)
const getProducts = async () => {
  await productStore.fetchProducts({
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
  })
}

onBeforeMount(async () => {
  await getProducts()
  productData.value = productList.value.data
});

</script>