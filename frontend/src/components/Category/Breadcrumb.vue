<template>
  <div class="max-w-[calc(100%-20px)] my-0 mx-auto md:max-w-7xl">
    <div class="flex items-center gap-4 py-5">
      <div class="flex items-center gap-2.5">
        <router-link :to="{ name:'home'}" class="hover:text-black text-base">Dạo</router-link>
        <p class="text-base"><Icon icon="octicon:chevron-right-24" /></p>
      </div> 
      <div>
        <span class="text-base">Tất cả các danh mục</span>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue';
export default {
  components: {
      Icon,
    },
}
</script>

<style scoped></style>