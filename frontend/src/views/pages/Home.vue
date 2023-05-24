<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-black text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <Navbar @scrolled="scroll" />
  </header>

  <section>
    <Banner />

    <div class="main-content max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
      <div class="layout">
        <Category/>
        <Products/>
      </div>
    </div>

  </section>

  <Newsletter />
  <Footer />
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import Banner from '@/components/Banner.vue';
import Newsletter from '@/components/Newsletter.vue';
import Footer from '@/components/Footer.vue';
import Products from '@/components/Products.vue';
import { ref } from 'vue'
import Category from '../../components/Category.vue';
export default {
  components: {
    Navbar,
    Banner,
    Newsletter,
    Footer,
    Category,
    Products,
  },

  setup(props, { emit }) {

    const onScroll = ref(false);
    const scroll = (e) => {
      onScroll.value = e;
    }

    return {
      scroll,
      onScroll,
    }
  }
}
</script>

<style scoped></style>