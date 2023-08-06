<template>
  <div class="flex-[1_1_910px]">
    <div
      class="cart-item-header grid px-5 py-2 mb-5 bg-white rounded-lg grid-cols-[398px,200px,150px,150px,30px] border-[1px]">
      <a-checkbox v-model:checked="isAllChecked" @change="onCheckAllChange">Tất cả</a-checkbox>

      <span>Đơn giá</span>
      <span>Số lượng</span>
      <span>Thành tiền</span>

      <span class="remove-btn">
        <Icon icon="system-uicons:trash" />
      </span>
    </div>

    <div class="h-auto overflow-hidden">
      <div class="bg-white border-[1px] mb-2.5 rounded-lg">
        <div class="mt-8 pb-1" v-for="(cartItem, index) in cart" :key="index" v-if="cart.length > 0">
          <CartItem :cartItem="cartItem" 
          :is-selected="cartSelected && cartSelected.cart_items_id === cartItem.cart_items_id"
          @selected="() => $emit('selected', index)"
          @onDelete="() => $emit('delete', index)"
          />
        </div>
        <div class="mt-8 px-4 pb-1 flex items-center justify-center" v-else>
          <a-empty image="/src/assets/images/empty.png" :image-style="{
            'display': 'flex',
            'align-items': 'center',
            'justify-content': 'center',
          }">
            <template #description>
              <span>
                Chưa có sản phẩm
              </span>
            </template>
          </a-empty>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { Icon } from '@iconify/vue'
import { ref, defineProps, watch } from 'vue'
import CartItem from './CartItem/CartItem.vue'

const props = defineProps({
  cart: Object,
  cartSelected: Object,
})
const emit = defineEmits(['delete', 'selected'])

const cart = ref([]);

watch(() => props.cart, (value) => {
  cart.value = value
})

const isAllChecked = ref(false);

function onCheckAllChange(e) {

};

</script>

<style scoped></style>