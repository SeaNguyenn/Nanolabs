<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-black text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <Header @scrolled="scroll" />
  </header>

  <section>
    <FilterProducts/>
  </section>

  <Footer />
</template>

<script>
import Header from '@/components/Header/Header.vue';
import Footer from '@/components/Footer/Footer.vue';
import FilterProducts from '@/components/Products/FilterProducts/FilterProducts.vue';
import { ref } from 'vue'
export default {
  components: {
    Header,
    Footer,
    FilterProducts,
  },

  setup(props) {
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