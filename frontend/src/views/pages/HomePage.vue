<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-black text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <HeaderComp @scrolled="scroll" :countCart="countCart" />
  </header>

  <section>
    <BannerComp />
    <div class="main-content max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
      <div class="layout">
        <CategoryComp />
        <ProductsComp :headingText="headingText" />
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
import { ref, defineComponent } from 'vue'
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
const { products } = productStore;
// productStore.fetchProducts({
//   keyword: "a",
// });


// console.log(products);
const countCart = ref(1);
const onScroll = ref(false);
const scroll = (e) => {
  onScroll.value = e;
}
const headingText = "Những sản phẩm đang bán chạy";


</script>

<style scoped></style>