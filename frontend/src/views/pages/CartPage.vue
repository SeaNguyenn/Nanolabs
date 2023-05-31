<template>
  <CartHeader/>

  <section>
    <CartSection/>
  </section>

  <Footer/>
</template>

<script>
import Footer from '@/components/Footer/Footer.vue';
import CartHeader from '../../components/Cart/CartHeader.vue';
import CartSection from '../../components/Cart/CartSection.vue';

export default {
  components: {
    Footer,
    CartHeader,
    CartSection
},
}
</script>

<style scoped></style>