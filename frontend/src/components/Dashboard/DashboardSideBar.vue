<template>
  <router-link :to="{ name: 'dashboard' }" class="flex justify-center items-center gap-3">
    <Icon icon="cryptocurrency:nano" class="text-2xl" />
    <h2 class="text-black origin-left font-medium text-2xl duration-300" v-bind:class="{ 'scale-0': !open }">Nanolabs</h2>
  </router-link>

  <a-menu v-model:selectedKeys="selectedKeys" mode="inline">
    
  </a-menu>

  <button class="h-12 fixed bottom-0 left-0 z-[1] flex items-center justify-center bg-dark-background duration-300" 
  v-bind:class="{ 'w-20  min-w-[80px]': !showSiderbar, 'w-[200px] min-w-[200px]': showSiderbar }"
  @click="$emit('changeValue')">
    <Icon icon="tabler:arrow-left" class="text-white text-2xl font-extrabold" v-if="showSiderbar"/>
    <Icon icon="tabler:arrow-right" class="text-white text-2xl font-extrabold duration-300" v-if="!showSiderbar"/>
  </button>
</template>

<script>
import { Icon } from '@iconify/vue';
import { ref } from 'vue'
export default {
  components: {
    Icon,
  },

  emits: ['changeValue'],

  props: {
    showSiderbar: { type: Boolean, default: true },
    open: { type: Boolean, default: true },
  },

  setup(props, {emit}) {
    const selectedKeys = ref(['1']);

    return {
      selectedKeys,
    }
  }
}
</script>

<style scoped></style>