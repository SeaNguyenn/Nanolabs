<template>
  <div class="my-[30px] md:my-[75px]">
    <div class="container my-[1.875rem] mx-auto">
      <Breadcrumb />
    </div>

    <div class="container overflow-hidden shadow border-[0.125rem] mb-[1.875rem]">
      
    </div>
  </div>
</template>

<script>
import Breadcrumb from './Breadcrumb.vue';

export default {

  components: {
    Breadcrumb

  },
}
</script>

<style scoped></style>