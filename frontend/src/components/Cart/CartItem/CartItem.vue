<template>
  <div>
    <div class="product mb-8">
      <div class="row flex item-center">
        <div class="col-1 w-[398px] px-[15px]">
          <div class="image flex h-20">
            <a-checkbox v-model:checked="checked" class="relative top-8"></a-checkbox>
            <div>
              <img class="w-full h-full"
                :src="cartItem.image"
                alt="">
            </div>

            <div class="w-[calc(100%-100px)] pl-2">
              <a href="">{{ cartItem.name }}</a>
            </div>
          </div>
        </div>
        <div class="col-2 w-[200px] flex items-center">
          <p class="m-0 p-0 font-bold">{{ Number(cartItem.price).toLocaleString("en-US") }}<sup>₫</sup></p>
        </div>
        <div class="col-3 w-[150px] flex items-center justify-start">
          <a-input v-model:value="quantityNum" :placeholder="cartItem.quantity"
            class="w-10 border-[1px] border-[rgba(0,0,0,.09)] text-center" />
        </div>
        <div class="col-4 w-[150px] flex items-center">
          <p class="m-0 p-0 font-bold text-red-600">{{ priceTotal.toLocaleString("en-US") }}<sup>₫</sup></p>
        </div>
        <div class="col-5 w-[30px] flex items-center">
          <button class="group flex w-full items-center rounded-md px-2 py-2 text-sm" @click="emit('deleteCartItem',cartItem)">
            <Icon icon="system-uicons:trash" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref,defineProps,defineEmits } from 'vue'
import { Icon } from '@iconify/vue';

const quantityNum = ref();
const checked = ref(false);

const props = defineProps({
  cartItem: Object,
})

const emit = defineEmits(['deleteCartItem'])

const priceTotal = Number(props.cartItem.price) * Number(props.cartItem.quantity)
</script>

<style scoped></style>