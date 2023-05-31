<template>
  <div class="my-[30px] md:my-[75px]">
    <div
      class="max-w-[calc(100%-20px)] my-0 mx-auto flex justify-between flex-wrap md:flex-nowrap md:max-w-7xl  md:gap-5">
      <div class="flex-[1_1_910px]">
        <div class="cart-item-header grid px-5 py-2 mb-5 grid-cols-[398px,200px,150px,150px,30px] border-[1px]">
          <a-checkbox v-model:checked="checked">Tất cả</a-checkbox>

          <span>Đơn giá</span>
          <span>Số lượng</span>
          <span>Thành tiền</span>

          <span class="remove-btn">
            <Icon icon="system-uicons:trash" />
          </span>
        </div>

        <div class="h-auto overflow-hidden">
          <CartList />
          <CartList />
        </div>

      </div>
      <div class="flex-[1_1_calc(100%-910px)]">
        <div class="border-[1px] px-2 py-3 mb-2.5">
          <div class="flex justify-between items-center text-base pb-2">
            <span>Giao tới</span>
            <a href="" class="text-blue-600">Thay đổi</a>
          </div>

          <div class="font-bold flex items-center text-sm pb-1">
            <span>Nguyễn Văn A</span>
            <span class="px-1">|</span>
            <span>099999999</span>
          </div>

          <div>
            <p>Số 5, Ngõ 989, Thành phố Hà nội</p>
          </div>
        </div>
        <div class="border-[1px] px-2 py-3 mb-2.5">
          <div class="border-b-[1px]">
            <div class="flex justify-between items-center pb-2">
              <div>Tạm tính</div>
              <div class="font-bold">0đ</div>
            </div>
            <div class="flex justify-between items-center pb-2">
              <div>Giảm giá</div>
              <div class="font-bold">0đ</div>
            </div>
          </div>
          <div class="flex justify-between items-center pt-2">
            <div>Tổng tiền</div>
            <div class="font-bold">0đ</div>
          </div>

        </div>
        <a href="/checkout">
          <Button class="bg-red-600 text-white py-[0.8rem] text-base px-7 w-full rounded">Mua hàng</Button>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue';
import { defineComponent, ref } from 'vue';
import CartList from './CartList.vue';
import Button from '@/components/Button.vue'
export default {
  components: {
    Icon,
    CartList,
    Button
  },

  setup() {
    return {
      checked: ref(false),
    };
  },
}
</script>

<style scoped></style>