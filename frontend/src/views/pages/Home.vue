<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-black text-white shadow md:px-[40px]" v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <Navbar @scrolled="scroll"/>
  </header>
  <div class="hero-banner py-10 relative bg-gradient-to-r from-[#8e2de2] to-[#4a00e0] md:h-[calc(100vh-80px)] ">
    <Banner />
  </div>
  <!-- <div class="h-[2000px]">home</div> -->

  <div class="newsletter-section w-full h-[400px] flex items-center bg-[#f9f9f9] bg-[url('@/assets/images/newsletter-background.jpg')] bg-center bg-no-repeat bg-cover">
    <Newsletter/>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import Banner from '@/components/Banner.vue';
import Newsletter from '../../components/Newsletter.vue';
import { ref } from 'vue'
export default {
  components: {
    Navbar,
    Banner,
    Newsletter,
},

  setup(props, {emit}) {

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