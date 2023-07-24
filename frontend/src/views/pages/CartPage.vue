<template>
  <Headerv2 :headingLink="headingLink" :headingName="headingName"/>

  <section>
    <CartSection />
  </section>

  <Footer />
</template>

<script setup>
import Footer from '@/components/Footer/Footer.vue';
import CartSection from '../../components/Cart/CartSection.vue';
import Headerv2 from '../../components/Header/Headerv2.vue';

const headingLink = "home";
const headingName = "Giỏ Hàng";
</script>