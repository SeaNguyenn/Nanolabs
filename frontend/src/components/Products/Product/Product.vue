<template>
  <div class="w-[calc(25%-5px)] mb-5 md:w-[calc(12%-15px)] bg-white p-2 rounded-b-lg relative">
    <div class="absolute top-0 left-0 z-[1]">
      <div class="bg-yellow-300 h-12 rounded-b-lg flex items-center justify-center flex-col p-2">
        <span class="text-red-500">50%</span>
        <span class="text-white">GIẢM</span>
      </div>
    </div>
    <div class="w-full h-[100px] bg-white mb-2.5 p-6 flex items-center md:h-[350px]">
      <img src="@/assets/images/earbuds-prod-1.webp" class="hover:scale-125" alt="">
    </div>
    <div class="prod-detail">
      <span class="prod-name text-base block text-ellipsis whitespace-nowrap overflow-hidden md:text-lg md:mb-2.5">Product
        name</span>
      <span class="cate-name text-sm block mb-1 md:text-base md:mb-1.5">Category name</span>
      <div class="prod-price flex flex-wrap gap-2.5 md:gap-5">
        <span class="price text-lg md:text-xl"><sup>₫</sup>9.000</span>
        <span class="discount-price text-lg md:text-xl"><sup>₫</sup>7.000</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>
<style scoped>
img {
  transition: all ease 0.3s;
  display: block;
  width: 100%;
}
</style>