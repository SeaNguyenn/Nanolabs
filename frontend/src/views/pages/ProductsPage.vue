<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-[#2196F3] text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <HeaderComp @scrolled="scroll" @inputSearch="handleInput" />
  </header>

  <section>
    <FilterProductsComp :products="productData" :productList="productList"/>
  </section>

  <FooterComp />
</template>

<script setup>
import Header from '@/components/Header/Header.vue';
import Footer from '@/components/Footer/Footer.vue';
import FilterProducts from '@/components/Products/FilterProducts/FilterProducts.vue';
import { ref, defineComponent, computed, onBeforeMount } from 'vue'
import { useProductStore } from '@/stores/product.js';

const HeaderComp = defineComponent(Header)
const FooterComp = defineComponent(Footer)
const FilterProductsComp = defineComponent(FilterProducts)

const onScroll = ref(false);
const productStore = useProductStore();
const perPage = ref(15);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');

productStore.fetchProducts({
  search: search.value,
  per_page: perPage.value,
  sort_field: sortField.value,
  sort_direction: sortDirection.value,
})

const productList = computed(() => productStore.products);
const productData = ref(null)
const getProduct = async () => {
  await productStore.fetchProducts({
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
  })
}

onBeforeMount(async () => {
  await getProduct()
  productData.value = productList.value.data
});


const scroll = (e) => {
  onScroll.value = e;
}

const handleInput = (e) => {
  productStore.fetchProducts({
    search: e,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
  })
}
</script>

<style scoped></style>