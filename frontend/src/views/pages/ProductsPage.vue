<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-black text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <HeaderComp @scrolled="scroll" />
  </header>

  <section>
    <FilterProductsComp/>
  </section>

  <FooterComp />
</template>

<script setup>
import Header from '@/components/Header/Header.vue';
import Footer from '@/components/Footer/Footer.vue';
import FilterProducts from '@/components/Products/FilterProducts/FilterProducts.vue';
import { ref, defineComponent } from 'vue'

const HeaderComp = defineComponent(Header)
const FooterComp = defineComponent(Footer)
const FilterProductsComp = defineComponent(FilterProducts)

const onScroll = ref(false);

const scroll = (e) => {
  onScroll.value = e;
}

</script>

<style scoped></style>