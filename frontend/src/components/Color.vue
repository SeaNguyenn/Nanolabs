<template>
  <div class="flex flex-wrap justify-start">
    <div v-for="color in colors" :key="color" class="w-4 h-4 rounded-full m-4 border-2" :class="`bg-${color}-500`"></div>
  </div>
</template>
  
<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
  color: {
    type: String,
    default: "blue",
  },
});

const colors = ref(["red", "green", "blue", "yellow", "pink", "purple"]);

onMounted(() => {
  if (colors.value.includes(props.color)) {
    colors.value = [props.color];
  }
});
</script>
  