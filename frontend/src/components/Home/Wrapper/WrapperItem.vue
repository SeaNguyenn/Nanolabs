<template>
  <div class="p-[30px] bg-white w-[400px]">
    <div class="m-auto w-[50px] h-[50px] mb-5 flex items-center justify-center bg-col-bg rounded-full md:w-[70px] md:h-[70px]">
      <Icon :icon="icon" class="text-xl md:text-3xl font-bold" />
    </div>
    <h3 class="font-bold text-base md:text-xl">{{ title }}</h3>
    <p class="text-sm mt-5 text-gray-500">{{ wrapper }}</p>
  </div>
</template>


<script setup>
import { Icon } from '@iconify/vue';
import { defineProps, toRefs } from 'vue'
const props = defineProps({
  item: Object,
})

const { icon, title, wrapper } = toRefs(props.item);
</script>

<style scoped></style>