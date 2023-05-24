<template>
  <div class="w-fit flex flex-col items-center my-0 mx-auto text-center">
    <span class="mb-[15px] uppercase text-black text-lg">Newsletter</span>
    <span class="mb-[20px] text-xl font-medium uppercase px-[30px] md:text-3xl">Đăng ký để nhận được các cập nhật và những
      lời đề nghị hấp dẫn</span>
    <div class="form flex gap-1 mb-2.5">
      <input type="text" placeholder="Địa chỉ email"
        class="w-48 h-10 rounded-sm border-[1px] border-solid border-[#00000033] px-3 text-base outline-0 md:w-[300px]">
      <Button class="outline-0 border-0 h-10 w-24 flex items-center justify-center cursor-pointer text-base text-white bg-blue-500 md:w-28">Đăng ký</Button>
    </div>
    <div class="text mb-5 text-sm text-black">Will be used in accordance with our Privacy Policy</div>
  </div>
</template>

<script>
import Button from '@/components/Button.vue'
export default {
  components: {
    Button,
  },

}
</script>

<style scoped></style>