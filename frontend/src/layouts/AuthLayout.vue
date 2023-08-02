<template>
  <div class="h-screen min-h-full py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">
      <div class="logo flex items-center">
        <Icon icon="cryptocurrency:nano" class="text-3xl mr-2" />
        <h2 class="w-[118px] h-[36px] font-bold text-3xl cursor-pointer">Nanolabs</h2>
      </div>
    </div>
    <router-view></router-view>
  </div>
</template>

<script setup>
import { Icon } from '@iconify/vue'
</script>