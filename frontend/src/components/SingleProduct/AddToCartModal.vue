<template>
  <div class="fixed inset-0 z-10 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="$emit('close')"></div>

    <div class="relative z-20 bg-white p-4 max-w-md mx-auto rounded-md shadow-lg" @click.stop>
      <p class="text-xl">Thêm vào giỏ hàng thành công!</p>
      <button
        @click="$emit('close')"
        class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700"
      >
        Đóng
      </button>
    </div>
  </div>
</template>

<script setup>
import { onMounted, defineEmits } from 'vue';

const emit = defineEmits(['close'])

onMounted(() => {
  setTimeout(() => {
    emit('close');
  }, 3000);
});

</script>