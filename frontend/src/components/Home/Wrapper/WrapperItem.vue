<template>
  <div class="p-[30px] bg-white">
    <div class="m-auto w-[50px] h-[50px] mb-5 flex items-center justify-center bg-col-bg rounded-full md:w-[70px] md:h-[70px]">
      <Icon icon="circum:delivery-truck" class="text-xl md:text-3xl font-bold" />
    </div>
    <h3 class="font-bold text-base md:text-xl">Vận chuyển cả nước</h3>
    <p class="text-sm mt-5 text-gray-500">Nhịp độ tập kích dồn dập của Nga trong thời gian qua dường như làm kiệt quệ mạng lưới phòng không Ukraine. Nga sử dụng các UAV tự sát giá rẻ, tấn công ồ ạt theo số lượng lớn buộc Ukraine phải phóng ra tên lửa đánh chặn đắt gấp ít nhất 20 lần ra để phá hủy.</p>
  </div>
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