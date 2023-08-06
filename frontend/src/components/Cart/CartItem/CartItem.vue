<template>
  <div>
    <div class="product mb-8">
      <div class="row flex item-center">
        <div class="col-1 w-[398px] px-[15px]">
          <div class="image flex h-20">
            <a-checkbox v-model:checked="checked" class="relative top-8"
              @click="$emit('selected', cartItem)"></a-checkbox>
            <div>
              <img class="w-full h-full" :src="cartItem.image" alt="">
            </div>

            <div class="w-[calc(100%-100px)] pl-2">
              <a href="">{{ cartItem.name }}</a>
            </div>
          </div>
        </div>
        <div class="col-2 w-[200px] flex items-start flex-col">
          <p class="m-0 p-0 font-bold" v-bind:class="Number(cartItem.sale_price) > 0 ? 'line-through' : ''">{{
            Number(cartItem.price).toLocaleString("en-US") }}<sup>₫</sup></p>
          <p class="m-0 p-0 font-bold " v-if="Number(cartItem.sale_price) > 0">{{
            Number(cartItem.sale_price).toLocaleString("en-US") }}<sup>₫</sup></p>
        </div>
        <div class="col-3 w-[150px]">
          {{ cartItem.quantity }}
        </div>
        <div class="col-4 w-[150px] flex items-start flex-col">
          <p class="m-0 p-0 font-bold text-red-600">{{ priceTotal.toLocaleString("en-US") }}<sup>₫</sup></p>
        </div>
        <div class="col-5 w-[30px] flex items-center">
          <button class="group flex w-full items-center rounded-md px-2 py-2 text-sm" @click="(e) => onDelete(e, cart)">
            <Icon icon="system-uicons:trash" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, watch, computed, createVNode } from 'vue'
import { Icon } from '@iconify/vue';
import { Modal } from "ant-design-vue";
import { QuestionCircleOutlined } from '@ant-design/icons-vue';

const props = defineProps({
  cartItem: Object,
  isSelected: { Boolean, default: false },
})

const cart = computed(() => props.cartItem || {})
const checked = ref(false);

const emit = defineEmits(['onDelete', 'selected'])

const priceTotal = Number(props.cartItem.sale_price) > 0 ? Number(props.cartItem.sale_price) * Number(props.cartItem.quantity) : Number(props.cartItem.price) * Number(props.cartItem.quantity);

const onDelete = (e, cart) => {
  Modal.confirm({
    title: () => 'Bạn có muốn xoá không',
    icon: () => createVNode(QuestionCircleOutlined),
    cancelText: () => 'Không',
    okText: () => 'Đúng',
    onOk() {
      emit("onDelete", cart);
    },
  });
};

</script>

<style scoped></style>