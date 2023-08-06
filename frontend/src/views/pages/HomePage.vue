<template>
  <header class="main-header w-full z-[99] px-[20px] py-4 bg-[#2196F3] text-white shadow md:px-[40px]"
    v-bind:class="onScroll ? 'sticky top-0 translate-y-[-80px] animate-sticky-header' : ''">
    <HeaderComp @scrolled="scroll" @inputSearch="handleInput"/>
  </header>

  <section>
    <router-view></router-view>
  </section>

  <FooterComp />
</template>

<script setup>
import Header from '@/components/Header/Header.vue';
import Footer from '@/components/Footer/Footer.vue';
import { ref, defineComponent } from 'vue'
import { useRouter } from 'vue-router';

const HeaderComp = defineComponent(Header)
const FooterComp = defineComponent(Footer)

const onScroll = ref(false);
const router = useRouter();

const scroll = (e) => {
  onScroll.value = e;
}

const handleInput = (e) => {
  router.replace({
    name: 'products',
    query: {
      search: e,
    },
  }).then(() => {
    window.location.reload();
  });
}
</script>