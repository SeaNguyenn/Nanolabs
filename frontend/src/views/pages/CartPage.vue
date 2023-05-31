<template>
  <Headerv2 :headingLink="headingLink" :headingName="headingName"/>

  <section>
    <CartSection />
  </section>

  <Footer />
</template>

<script>
import Footer from '@/components/Footer/Footer.vue';
import CartSection from '../../components/Cart/CartSection.vue';
import Headerv2 from '../../components/Header/Headerv2.vue';

export default {
  components: {
    Footer,
    CartSection,
    Headerv2
  },

  setup(props) {
    const headingLink = "cart";
    const headingName = "Giỏ Hàng";

    return {
      headingLink,
      headingName,
    }
  }
}
</script>

<style scoped></style>