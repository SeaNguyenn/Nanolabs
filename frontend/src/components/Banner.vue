<template>
  <div class="content h-full flex flex-col justify-end my-0 mx-auto md:max-w-7xl md:flex-row">
    <div
      class="text-content text-white text-center flex flex-col items-center md:absolute md:left-[50px] md:top-1/2 md:-translate-y-1/2 2xl:left-0 2xl:text-start 2xl:items-start">
      <h5 class="text-white text-xl uppercase text-bold mb-[20px]">Summer 2023</h5>
      <h1 class="text-[60px] max-w-[950px] uppercase text-white text-bold leading-none mb-[20px] md:text-[90px]">virtual
        reality glasses</h1>
      <h4 class="max-w-[300px] text-white text-base mb-[20px] md:max-w-[500px] md:text-lg md:p-0">we know how large objects will
        act, but
        things on a small scale</h4>
      <div class="ctas flex items-center gap-5">
        <Button
          class="uppercase text-xs font-medium border-2 border-solid border-white py-[10px] px-[20px] cursor-pointer">Mua
          ngay bây giờ</Button>
        <Button
          class="bg-white text-black uppercase text-xs font-medium border-2 border-solid border-white py-[10px] px-[20px] cursor-pointer">Mua
          ngay bây giờ</Button>
      </div>
    </div>
    <img src="../assets/images/vr-glasses.png"
      class="relative z-[9] w-[400px] mb-[20px] md:w-[600px] md:mr-[60px] md:mt-[50px] md:mb-0 2xl:w-[700px] 2xl:mr-0 2xl:mt-0"
      alt="">
  </div>
</template>

<script>
import Button from '@/components/Button.vue'
export default {
  components: {
    Button,
  },

  return: {

  }
}
</script>

<style scoped></style>