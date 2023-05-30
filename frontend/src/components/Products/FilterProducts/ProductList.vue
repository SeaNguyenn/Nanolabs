<template>
  <div>
    <Products :offHeading="true"/>
    <Products :offHeading="true"/>
  </div>
</template>

<script>
import Products from '../Products.vue';

export default {
    components: { Products, }
}
</script>

<style scoped></style>