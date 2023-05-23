<template>
  <div class="w-fit flex flex-col items-center my-0 mx-auto text-center">
    <span class="mb-[15px] uppercase text-col-gray">Newsletter</span>
    <span class="mb-[20px] text-xl font-medium uppercase px-[30px] md:text-3xl">Đăng ký để nhận được các cập nhật và những
      lời đề nghị hấp dẫn</span>
    <div class="form flex gap-1 mb-2.5">
      <input type="text" placeholder="Địa chỉ email"
        class="w-48 h-10 rounded-none border-[1px] border-solid border-[#00000033] px-3 text-base outline-0 md:w-[300px]">
      <Button class="outline-0 border-0 h-10 w-24 flex items-center justify-center cursor-pointer text-base text-white bg-blue-500 md:w-28">Đăng ký</Button>
    </div>
    <div class="text mb-5 text-sm text-gray-400">Will be used in accordance with our Privacy Policy</div>
    <div class="social-icon flex gap-2.5">
      <Icon icon="logos:facebook" class="w-7 h-7 rounded-[50%] flex justify-center items-center"/>
      <Icon icon="ant-design:instagram-outlined" class="w-7 h-7 rounded-[50%] flex justify-center items-center text-blue-500 bg-white"/>
      <Icon icon="mdi:twitter" class="w-7 h-7 rounded-[50%] flex justify-center items-center bg-blue-500 text-white"/>
    </div>
  </div>
</template>

<script>
import Button from '@/components/Button.vue'
import { Icon } from '@iconify/vue';
export default {
  components: {
    Button,
    Icon,
  },

}
</script>

<style scoped></style>