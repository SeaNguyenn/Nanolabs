<template>
  <div class="my-[30px] md:my-[75px]">
    <div
      class="max-w-[calc(100%-20px)]  my-0 mx-auto flex justify-between flex-wrap md:flex-nowrap md:max-w-7xl md:flex-col  md:gap-5">
      <div class="text-2xl font-bold">Thanh toán</div>
      <div class="flex items-center px-[30px] pt-[24px] bg-white ">
        <div class="w-full h-8 text-base text-[#bbb] flex items-center">
          <div class="flex-[5] text-left">Sản phẩm</div>
          <div class="flex-[1] text-center">Đơn giá</div>
          <div class="flex-[1] text-center">Số lượng</div>
          <div class="flex-[2] text-right">Thành tiền</div>
        </div>
      </div>
      <div class="bg-white">
        <div class="py-10 mt-3 mx-[30px] flex text-ellipsis whitespace-nowrap overflow-hidden text-[#222]"
          v-for="(product, index) in cart" :key="product.id">
          <div class="flex justify-start flex-[5] items-center text-ellipsis whitespace-nowrap overflow-hidden ">
            <img :src="product.image" alt="" class="w-10 h-10">
            <span class="mx-4 flex flex-col justify-center overflow-hidden">{{ product.name }}</span>
          </div>
          <div class="flex-[1] text-ellipsis flex justify-center items-center">{{ product.sale_price > 0 ?
            Number(product.sale_price).toLocaleString("vi-VN") : Number(product.price).toLocaleString("vi-VN") }}<sup>₫</sup></div>
          <div class="flex-[1] text-ellipsis flex justify-center items-center">{{ product.quantity }}</div>
          <div class="flex-[2] text-ellipsis flex justify-end items-center">{{ Number(product.sale_price) > 0 ?
            Number(product.quantity * product.sale_price).toLocaleString("vi-VN") :  Number(product.quantity * product.price).toLocaleString("vi-VN")
          }}<sup>₫</sup></div>
        </div>
      </div>
      <div class="flex items-center justify-end px-[30px] py-[24px] gap-10 bg-white text-xl">
        <span>
          Tổng thanh toán:
        </span>
        <div>{{ Number(totalAmount).toLocaleString("vi-VN") }}<sup>₫</sup></div>
      </div>
      <div class="flex items-center justify-end px-[30px] py-[24px] bg-white text-xl">
        <Button class="bg-red-600 text-white py-[0.8rem] text-base px-7 w-[300px] rounded" name="redirect" @click="payment">Thanh toán</Button>
      </div>
    </div>
  </div>
</template>

<script setup>
import Button from '@/components/Button.vue'
import { usePaymentStore } from '@/stores/payment.js';
import { useOrderStore } from '@/stores/order.js';
import { useCheckoutStore } from '@/stores/checkout.js';
import { computed } from 'vue'

const paymentStore = usePaymentStore();
const orderStore = useOrderStore();
const checkoutStore = useCheckoutStore();
const paymentData = paymentStore.paymentData;
const cart = computed(() => paymentData.cart)
const totalAmount = computed(() => paymentData.total_amount)

const payment = async () => {
  let product_ids = cart.value.map(item => item.id);

  let data = {
    'product_ids' : product_ids,
    'total_amount' : totalAmount.value,
  }

  await orderStore.addOrder(data).then(response => {
      checkoutStore.startCheckout({
        'order_id' :  response.data.order_id,
        'amount' :  totalAmount.value,
      }).then(response => {
        window.location.href = response.data.data;
      });
    })

}
</script>
