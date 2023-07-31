<template>
  <div class="my-[30px] md:my-[75px]">
    <div
      class="max-w-[calc(100%-20px)] my-0 mx-auto flex justify-between flex-wrap md:flex-nowrap md:max-w-7xl  md:gap-5">
      <CartList :cart="cartData" @delete-cart="onDeleteCart"/>
      <div class="flex-[1_1_calc(100%-910px)]">
        <div class="border-[1px] px-2 py-1 mb-2.5 bg-white rounded-lg">
          <div class="flex justify-between items-center text-base pb-2">
            <span class="text-base font-semibold ">Giao tới</span>
            <a href="" class="text-base font-semibold text-blue-600">Thay đổi</a>
          </div>

          <div class="font-bold flex items-center text-sm pb-1 bg-white rounded-lg">
            <span>{{user.name}}</span>
            <span class="px-1">|</span>
            <span>{{user.phone}}</span>
          </div>

          <div>
            <p>{{user.address}}</p>
          </div>
        </div>
        <div class="border-[1px] px-2 py-3 mb-2.5 bg-white rounded-lg">
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
        <router-link :to="{name: 'payments'}">
          <Button class="bg-red-600 text-white py-[0.8rem] text-base px-7 w-full rounded">Mua hàng</Button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import Button from '@/components/Button.vue'
import { authStore } from '@/stores/auth.js';
import { useCartStore } from '@/stores/cart.js';
import CartList from './CartList.vue'
import { ref, computed, onBeforeMount,watchEffect } from 'vue'
import { useRouter } from 'vue-router'

const auth = authStore();
const user = auth.authUser;
const cartStore = useCartStore();
const router = useRouter()
const perPage = ref(10);
const search = ref('');
const sortField = ref('cart_items.id');
const sortDirection = ref('desc');

cartStore.fetchCart({
  search: search.value,
  per_page: perPage.value,
  sort_field: sortField.value,
  sort_direction: sortDirection.value,
})

const cartList = computed(() => cartStore.cart);
const cartData = ref(null)

watchEffect(() => {
  if (cartList.value) {
    cartData.value = cartList.value.data;
  }
});

const getCart = async () => {
  await cartStore.fetchCart({
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
  })
}

onBeforeMount(async () => {
  await getCart()
  cartData.value = cartList.value.data
});

function onDeleteCart (e){
  if (!confirm(`Bạn có muốn xoá không?`)) {
    return
  }
  cartStore.deleteCart(e.cart_items_id).then(res => {
    cartStore.fetchCart();
  });
}


</script>

<style scoped></style>