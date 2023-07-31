<template>
  <div>
    <router-link :to="{ name: '' }" class="flex items-center gap-2 text-lg hover:text-black font-bold">
      <Icon icon="tabler:category" />
      <p>Tất cả các danh mục</p>
    </router-link>

    <div class="flex flex-col gap-2 my-5 px-2">
      
    </div>

    <div class="flex items-center gap-2 text-lg hover:text-black font-bold">
      <Icon icon="cil:filter" />
      <p>Bộ lọc tìm kiếm</p>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div class="">Theo danh mục</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div>Theo nơi bán</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div>Theo thương hiệu</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
    </div>

    <div class="flex flex-col text-base py-3 px-2 gap-1.5 border-b border-[#0000000d]">
      <div>Đánh giá</div>
      <a-checkbox v-model:checked="checked">A</a-checkbox>
      <a-checkbox v-model:checked="checked" class="!m-0">B</a-checkbox>
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