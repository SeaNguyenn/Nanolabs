<template>
  <div class="fixed inset-0 z-10 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="$emit('close')"></div>

    <div class="relative z-20 bg-white p-4 max-w-md mx-auto rounded-md shadow-lg flex flex-col items-center justify-center" @click.stop>
      <p class="text-xl">Thêm vào giỏ hàng thành công!</p>
      <Icon icon="icon-park-outline:success" class="text-red-600 w-10 h-10"/>
    </div>
  </div>
</template>

<script setup>
import { onMounted, defineEmits } from 'vue';
import { Icon } from '@iconify/vue';

const emit = defineEmits(['close'])

onMounted(() => {
  setTimeout(() => {
    emit('close');
  }, 3000);
});

</script>