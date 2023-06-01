<template>
  <div class="w-full text-center bg-col-bg px-10 mb-10 rounded-sm">
    <div class="flex flex-col md:flex-row gap-2.5 md:gap-5">
      <WrapperItem/>
      <WrapperItem/>
      <WrapperItem/>
      <WrapperItem/>
    </div>
  </div>
</template>

<script>
import WrapperItem from './WrapperItem.vue';

export default {
    components: { WrapperItem }
}
</script>

<style scoped></style>