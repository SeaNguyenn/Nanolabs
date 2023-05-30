<template>
  <div>
    <router-link :to="{ name: 'all_categories' }" class="flex items-center gap-2 text-lg hover:text-black font-bold">
      <Icon icon="tabler:category" />
      <p>Tất cả các danh mục</p>
    </router-link>

    <div class="flex flex-col gap-2 my-5 px-2">
      <router-link :to="{ name: '' }" class="text-base hover:text-black">Điện thoại</router-link>
      <router-link :to="{ name: '' }" class="text-base hover:text-black">Phụ kiện</router-link>
      <router-link :to="{ name: '' }" class="text-base hover:text-black">Máy tính bảng</router-link>
      <router-link :to="{ name: '' }" class="text-base hover:text-black">Tai nghe</router-link>
      <router-link :to="{ name: '' }" class="text-base hover:text-black">Pin dự phòng</router-link>
      <router-link :to="{ name: '' }" class="text-base hover:text-black">Các phụ kiện khác</router-link>
      <router-link :to="{ name: '' }" class="text-base hover:text-black">Các thiết bị khác</router-link>
    </div>

    <div class="flex items-center gap-2 text-lg hover:text-black font-bold">
      <Icon icon="cil:filter" />
      <p>Bộ lọc tìm kiếm</p>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div class="">Theo danh mục</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">C</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">D</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">E</a-checkbox>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div>Theo nơi bán</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">C</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">D</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">E</a-checkbox>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div>Theo thương hiệu</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">C</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">D</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">E</a-checkbox>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div>Khoảng giá</div>

      <div class="flex items-center justify-center">
        <a-input v-model:value="from" placeholder="₫ TỪ" />
        <span class="mx-2"><Icon icon="ep:minus" /></span>
        <a-input v-model:value="to" placeholder="₫ ĐẾN" />
      </div>

      <Button class="px-2 py-1 mt-3 bg-red-600 text-white text-base md:p-2">Áp dụng</Button>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div>Đánh giá</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">C</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">D</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">E</a-checkbox>
    </div>

  </div>
</template>

<script>
import { Icon } from '@iconify/vue';
import Button from '@/components/Button.vue'
export default {
  components: {
    Icon,
    Button,
  },
};
</script>

<style scoped></style>