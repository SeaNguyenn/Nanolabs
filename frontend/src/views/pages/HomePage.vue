<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-[#2196F3] text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <HeaderComp @scrolled="scroll" @inputSearch="handleInput"/>
  </header>

  <section>
    <BannerComp />
    <div class="main-content max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
      <div class="layout">
        <CategoryComp />
        <ProductsComp :headingText="headingText" :products="productData"/>
      </div>
    </div>
    <WrapperComp />
    <NewsletterComp />
  </section>

  <FooterComp />
</template>

<script setup>
import Header from '@/components/Header/Header.vue';
import Banner from '@/components/Home/Banner/Banner.vue';
import Newsletter from '@/components/Footer/Newsletter/Newsletter.vue';
import Footer from '@/components/Footer/Footer.vue';
import Products from '@/components/Products/Products.vue';
import Category from '@/components/Home/Category/Category.vue';
import { ref, defineComponent, computed, onBeforeMount } from 'vue'
import Wrapper from '@/components/Home/Wrapper/Wrapper.vue';
import { useProductStore } from '@/stores/product.js';

const HeaderComp = defineComponent(Header)
const BannerComp = defineComponent(Banner)
const NewsletterComp = defineComponent(Newsletter)
const FooterComp = defineComponent(Footer)
const CategoryComp = defineComponent(Category)
const ProductsComp = defineComponent(Products)
const WrapperComp = defineComponent(Wrapper)

const productStore = useProductStore();
const perPage = ref(5);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');
const onScroll = ref(false);
const headingText = "Những sản phẩm đang bán chạy";

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
  console.log(e);
}
</script>