<template>
  <div class="bg-white border-[1px] mb-2.5 rounded-lg">
    <div class="seller-group px-5 pt-4 flex items-center">
      <a-checkbox v-model:checked="checked"></a-checkbox>
      <div class="flex items-center ml-2 gap-3">
        <Icon icon="bi:shop" class="text-base"/>
        <span class="text-base font-bold">Brand shop</span>
        <span>
          <Icon icon="octicon:chevron-right-24" />
        </span>
      </div>
    </div>

    <div class="mt-8 px-4 pb-1">
      <CartItem/>
      <CartItem/>
      <CartItem/>
      <CartItem/>
      <CartItem/>
      <CartItem/> 
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue';
import { defineComponent, ref } from 'vue';
import CartItem from './CartItem/CartItem.vue'
export default {
  components: {
    CartItem,
    Icon,
  },

  setup() {
    return {
      checked: ref(false),
    };
  },
}
</script>

<style scoped>

</style>