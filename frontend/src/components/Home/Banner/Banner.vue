<template>
  <div class="hero-banner py-10 relative bg-gradient-to-r from-[#2196F3] to-[#E91E63] md:h-[calc(100vh-80px)] ">
    <div
      class="content h-full flex items-center flex-col max-w-[calc(100%-20px)] relative justify-center my-0 mx-auto md:max-w-7xl md:flex-row md:justify-end">
      <div
        class="text-content text-white text-center flex flex-col items-center md:absolute md:left-[50px] md:top-1/2 md:-translate-y-1/2 2xl:left-0">
        <h5 class="text-white text-xl uppercase text-bold mb-[20px]">Chiếc iPhone tiên tiến nhất từ trước đến nay.</h5>
        <h1 class="text-[60px] max-w-[800px] uppercase text-white text-bold leading-none mb-[20px] md:text-[70px]">Điện
          thoại Iphone 14 Pro Max</h1>
        <h4 class="max-w-[300px] text-white text-base mb-[20px] md:max-w-[500px] md:text-lg md:p-0">Trải nghiệm màn hình
          OLED tuyệt đẹp, chip A15 mạnh mẽ, và tốc độ 5G tuyệt vời.</h4>
        <h4 class="max-w-[300px] text-white text-base mb-[20px] md:max-w-[500px] md:text-lg md:p-0">Đặt hàng trước ngay và
          nhận miễn phí AirPods Pro.</h4>
        <div class="ctas flex items-center gap-5">
          <Button
            class="uppercase text-xs font-medium border-2 border-solid border-white py-[10px] px-[20px] cursor-pointer">Chi
            tiết</Button>
          <Button color="light" 
            class=" uppercase text-xs font-medium border-2 border-solid border-white py-[10px] px-[20px] cursor-pointer">Mua
            ngay bây giờ</Button>
        </div>
      </div>
      <img src="@/assets/images/tessst.jpg"
        class="relative top-0 left-0 z-[9] w-[400px] h-[400px] mb-[20px]  md:mr-[60px] md:mt-[50px] md:mb-0 2xl:mr-0 2xl:mt-0"
        alt="">
    </div>
  </div>
</template>

<script setup>
import { Button } from 'flowbite-vue'
</script>

<style scoped></style>