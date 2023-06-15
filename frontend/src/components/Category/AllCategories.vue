<template>
  <div class="my-[30px] md:my-[75px]">
    <Breadcrumb />
    <CategoryList/>
  </div>
</template>

<script>
import Breadcrumb from './Breadcrumb.vue';
import CategoryList from './CategoryList.vue';

export default {

  components: {
    Breadcrumb,
    CategoryList
},
}
</script>

<style scoped></style>