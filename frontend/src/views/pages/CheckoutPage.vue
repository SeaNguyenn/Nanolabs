<template>
  <div class="my-[30px] md:my-[75px]">
    <div
      class="max-w-[calc(100%-20px)]  my-0 mx-auto flex justify-center items-center flex-wrap md:flex-nowrap md:max-w-7xl md:flex-col  md:gap-5">
        <Icon icon="ep:success-filled" class="text-[5rem] text-green-500" />
        <span class="text-[3rem] text-green-500">Thanh toán thành công</span>
        <span class="text-3xl">Đơn hàng của quý khách đã được thanh toán thành công</span>
        <Button color="dark" @click="goHomePage">Thoát</Button>
    </div>
  </div>
</template>

<script setup>
import { Icon } from '@iconify/vue';
import { Button } from 'flowbite-vue'
import { useRouter } from 'vue-router';
const router = useRouter();

const goHomePage = () => {
  router.push({ name: 'homepage'});
}
</script>
