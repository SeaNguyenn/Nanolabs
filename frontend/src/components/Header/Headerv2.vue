<template>
  <header class="w-full px-[20px] py-4 bg-white text-black shadow md:px-[40px]">
    <div class="flex items-center justify-between h-12 max-w-7xl my-0 mx-auto md:h-[60px]">
      <router-link :to="{name:headingLink}" class="logo flex items-center gap-2 hover:text-black">
        <Icon icon="cryptocurrency:nano" class="text-3xl" />
        <h2 class="font-bold text-3xl text-black cursor-pointer">Nanolabs</h2>
        <span class="text-black text-3xl">|</span>
        <h2 class="font-bold text-2xl text-black cursor-pointer">{{ headingName }}</h2>
      </router-link>

      <div class="flex items-center">
        <a-input v-model:value="value" placeholder="Tìm kiếm" class="w-[400px] rounded-none border-red-600 py-2 border-2"/>
        <Button class="bg-red-600 text-white py-[0.8rem] px-7 rounded-none" @click=""><Icon icon="system-uicons:search" class="text-base" /></Button>
      </div>
    </div>
  </header>
</template>

<script>
import { Icon } from '@iconify/vue'
import { ref } from 'vue'
import Button from '@/components/Button.vue'
export default {
  props:{
    headingLink: String,
    headingName: String,
  },

  components: {
    Icon,
    Button,
  },

  setup() {
    const value = ref('');

    return {
      value,
    };
  },
}
</script>

<style scoped></style>