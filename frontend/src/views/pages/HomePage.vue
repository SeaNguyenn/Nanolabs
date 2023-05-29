<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-black text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <Header @scrolled="scroll" />
  </header>

  <SingleProduct/>

  <!-- <section>
    <Banner />
    <div class="main-content max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
      <div class="layout">
        <Category/>
        <Products :headingText="headingText"/>
      </div>
    </div>
  </section>

  <Newsletter /> -->
  <!-- <Footer /> -->
</template>

<script>
import Header from '@/components/Header/Header.vue';
import Banner from '@/components/Home/Banner/Banner.vue';
import Newsletter from '@/components/Footer/Newsletter/Newsletter.vue';
import Footer from '@/components/Footer/Footer.vue';
import Products from '@/components/Products/Products.vue';
import Category from '@/components/Home/Category/Category.vue';
import SingleProduct from '@/components/SingleProduct/SingleProduct.vue';
import { ref } from 'vue'
export default {
  components: {
    Header,
    Banner,
    Newsletter,
    Footer,
    Category,
    Products,
    SingleProduct,
  },

  setup(props, { emit }) {

    const onScroll = ref(false);
    const scroll = (e) => {
      onScroll.value = e;
    }
    const headingText = "Những sản phẩm đang bán chạy";

    return {
      scroll,
      onScroll,
      headingText,
    }
  }
}
</script>

<style scoped></style>