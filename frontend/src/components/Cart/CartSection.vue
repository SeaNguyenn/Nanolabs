<template>
  <div class="my-[30px] md:my-[75px]">
    <div
      class="max-w-[calc(100%-20px)] my-0 mx-auto flex justify-between flex-wrap md:flex-nowrap md:max-w-7xl  md:gap-5">
      <CartList :cart="cartData" 
        @delete="onDeleteCart" 
        :cartSelected="cartSelected"
        @selected="onCartSelect"/>
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
              <div class="font-bold">{{ totalDefaultAmount }}<sup>₫</sup></div>
            </div>
            <div class="flex justify-between items-center pb-2">
              <div>Giảm giá</div>
              <div class="font-bold">{{ totalSaleAmount }}<sup>₫</sup></div>
            </div>
          </div>
          <div class="flex justify-between items-center pt-2">
            <div>Tổng tiền</div>
            <div class="font-bold">{{ totalAmount }}<sup>₫</sup></div>
          </div>

        </div>
        <div>
          <Button class="bg-red-600 text-white py-[0.8rem] text-base px-7 w-full rounded" @click="payment">Mua hàng</Button>
        </div>
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

const auth = authStore();
const user = auth.authUser;
const cartStore = useCartStore();
const perPage = ref(10);
const search = ref('');
const sortField = ref('cart_items.id');
const sortDirection = ref('desc');
const cartSelected = ref([]);

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

const onCartSelect = (index) => {
  if (!cartData.value) return;
  if (index >= cartData.value.length) return;
  const test = ref([])
  if(!test.value.includes(index)){
    console.log("1");
    test.value.push(index);
  }else{
    console.log("2");
    test.value.splice(index,1)
  }

  console.log(test.value);
  // if(!cartSelected.value.includes(cartData.value[index])){
  //   cartSelected.value.push(cartData.value[index])
  // }else {
  //   cartSelected.value.splice(index, 1);
  // }
};

const onDeleteCart = (index) => {
  if (!cartData.value) return;
  if (index >= cartData.value.length) return;
  const item = cartData.value[index];
  console.log(item);
  if (item.id === cartSelected.value.cart_items_id) {
      cartSelected.value = null;
    }
  // cartData.value.splice(index, 1);

  // cartStore.deleteCart().then(res => {
  //   cartStore.fetchCart();
  // });
};

const payment = () => {
  console.log(cartSelected.value);
}

const totalDefaultAmount = computed(() => {
  let total = 0;
  if (cartData.value) {
    cartData.value.forEach(item => {
      total += Number(item.price);
    });
  }
  return total.toLocaleString("en-US");
});

const totalSaleAmount = computed(() => {
  let total = 0;
  if (cartData.value) {
    cartData.value.forEach(item => {
      const price = Number(item.sale_price) > 0 ?  Number(item.price) - Number(item.sale_price) : 0;
      total += price;
    });
  }
  return total.toLocaleString("en-US");
});

const totalAmount = computed(() => {
  let total = 0;
  if (cartData.value) {
    cartData.value.forEach(item => {
      const price = Number(item.sale_price) ? Number(item.sale_price) : Number(item.price);
      total += price;
    });
  }
  return total.toLocaleString("en-US");
});



</script>

<style scoped></style>