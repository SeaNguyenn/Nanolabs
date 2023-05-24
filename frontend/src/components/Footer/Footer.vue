<template>
  <footer class="w-full bg-[#252B42] text-white">
    <div class="py-[50px] px-[20px] max-w-7xl my-0 mx-auto flex flex-wrap gap-5 md:justify-between md:px-0">
      <div class="max-w-[300px]">
        <div class="mb-5 text-xl">Chăm sóc khách hàng</div>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Trung tâm trợ giúp</router-link>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Hướng dẫn mua hàng</router-link>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Thanh toán</router-link>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Vận chuyển</router-link>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Trả hàng</router-link>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Chăm sóc khách hàng</router-link>
      </div>
      <div class="max-w-[300px]">
        <div class="mb-5 text-xl">Về Nanolabs</div>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Giới thiệu</router-link>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Điều khoản</router-link>
        <router-link :to="{}" class="text-sm text-gray-400 block pb-1">Flash Sales</router-link>
      </div>
      <div class="max-w-[300px]">
        <div class="mb-5 text-xl">Thanh toán</div>
        <div class="flex items-center justify-center gap-3">
          <Icon class="text-xl bg-white p-0.5" icon="logos:visa" />
          <Icon class="text-xl bg-white p-0.5" icon="logos:paypal" />
          <Icon class="text-xl bg-white p-0.5" icon="logos:mastercard" />
        </div>
      </div>
      <div class="max-w-[300px]">
        <div class="mb-5 text-xl">Theo dõi chúng tôi trên</div>
        <div class="flex items-start justify-center gap-3">
          <Icon class="text-3xl bg-white rounded-full" icon="logos:facebook" />
          <Icon class="text-3xl bg-white p-0.5 rounded-lg" icon="logos:instagram" />
          <Icon class="text-3xl bg-white p-1 rounded-full" icon="logos:twitter" />
        </div>
      </div>
    </div>
    <div class="border-t-[1px] border-solid border-[col-gray]">
      <div
        class="p-5 flex items-center flex-col text-center gap-2.5 md:p-0 md:h-16 md:max-w-7xl md:my-0 md:mx-auto md:flex-row md:justify-center md:gap-7">
        <router-link :to="{}" class="text-sm text-gray-400">Chính sách bảo mật</router-link>
        <router-link :to="{}" class="text-sm text-gray-400">Quy chế hoạt động</router-link>
        <router-link :to="{}" class="text-sm text-gray-400">Chính sách vân chuyển</router-link>
        <router-link :to="{}" class="text-sm text-gray-400">Chăm sóc khách hàng</router-link>
      </div>
    </div>
  </footer>
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