<template>
  <div class="w-[calc(50%-5px)] mb-5 md:w-[calc(25%-15px)]">
    <div class="w-full h-[180px] bg-[#0000000d] mb-2.5 p-6 flex items-center md:h-[350px]">
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