<template>
  <header class="w-full px-[20px] py-4 bg-white text-black shadow md:px-[40px]">
    <div class="flex items-center justify-between h-12 max-w-7xl my-0 mx-auto md:h-[60px]">
      <router-link :to="{name:headingLink}" class="logo flex items-center gap-2 hover:text-black">
        <Icon icon="cryptocurrency:nano" class="text-3xl" />
        <h2 class="font-bold text-3xl text-black cursor-pointer">Nanolabs</h2>
        <span class="text-black text-3xl">|</span>
        <h2 class="font-bold text-2xl text-black cursor-pointer">{{ headingName }}</h2>
      </router-link>
    </div>
  </header>
</template>

<script setup>
import { Icon } from '@iconify/vue'
import { ref, defineProps } from 'vue'

const props = defineProps({
    headingLink: String,
    headingName: String
  }
)

const value = ref('');
</script>

<style scoped></style>