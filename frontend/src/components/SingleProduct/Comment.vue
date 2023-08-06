<template>
  <div class="my-[30px] md:mb-[50px]">
    <div
      class="mb-[20px] text-lg font-medium uppercase md:mb-9 md:text-2xl after:content-[''] after:block after:mt-1 after:w-[70px] after:h-1 after:bg-fuchsia-500 md:mt-8">
      Bình luận</div>
    <div class="content text-lg md:text-xl text-black bg-[#0000000d] p-2 md:p-5">
      {{ comment }}
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
const props = defineProps({
  comment: String,
});
</script>

