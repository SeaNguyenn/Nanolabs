<template>
  <div class="max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
    <div class="flex flex-wrap">
      <CategoryCard/>
      <CategoryCard/>
      <CategoryCard/>
      <CategoryCard/>
      <CategoryCard/>
      <CategoryCard/>
      <CategoryCard/>
      <CategoryCard/>
    </div>
  </div>
</template>

<script>
import CategoryCard from './CategoryCard/CategoryCard.vue';

export default {
    components: { CategoryCard }
}
</script>

<style scoped></style>