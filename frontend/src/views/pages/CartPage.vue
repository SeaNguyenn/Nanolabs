<template>
  <CartHeader/>

  <section>
    cart
  </section>

  <Footer/>
</template>

<script>
import Footer from '@/components/Footer/Footer.vue';
import CartHeader from '../../components/Cart/CartHeader.vue';

export default {
  components: {
    Footer,
    CartHeader,
},
}
</script>

<style scoped></style>