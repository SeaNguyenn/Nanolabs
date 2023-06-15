<template>
  <router-link :to="{ name: 'dashboard' }" class="flex justify-center items-center mb-10">
    <img class="shadow-sm rounded-full border-[1px] border-solid block float-left mr-2 h-10 w-10" v-bind:class="{ '!mr-0': !open}"
      src="@/assets/images/logo.png" />
    <span class="text-black origin-left font-extrabold text-2xl duration-300 text-center"
      v-bind:class="{ 'hidden': !open }">Nanolabs</span>
  </router-link>

  <ul class="mt-5 flex flex-col items-start justify-center" v-bind:class="{'items-center' : !open}">
    <li v-for="(menu,index) in menus" key="index" class="mb-5 w-full">
      <router-link :to="{name: menu.href}" class="flex items-center gap-2 pl-2 py-1 text-lg text-col-gray-light rounded cursor-pointer hover:bg-col-hover hover:text-white" v-bind:class="{'justify-center !pl-0 !text-2xl' : !open}">
        <Icon :icon="menu.icon"/>
        <span v-bind:class="{ 'hidden' : !open}">{{ menu.name }}</span>
      </router-link>
    </li>
  </ul>

  <button class="h-12 fixed bottom-0 left-0 z-[1] flex items-center justify-center bg-dark-background duration-300"
    v-bind:class="{ 'w-20  min-w-[80px]': !showSiderbar, 'w-[200px] min-w-[200px]': showSiderbar }"
    @click="$emit('changeValue')">
    <Icon icon="tabler:arrow-left" class="text-white text-2xl font-extrabold" v-if="showSiderbar" />
    <Icon icon="tabler:arrow-right" class="text-white text-2xl font-extrabold duration-300" v-if="!showSiderbar" />
  </button>
</template>

<script>
import { Icon } from '@iconify/vue';
import { ref, reactive } from 'vue'
export default {
  components: {
    Icon,
  },

  emits: ['changeValue'],

  props: {
    showSiderbar: { type: Boolean, default: true },
    open: { type: Boolean, default: true },
  },

  setup(props, { emit }) {
    const menus = reactive([
      {
        name: 'Trang chủ',
        href: 'dashboard',
        icon: 'ic:sharp-dashboard',
      },
      {
        name: 'Phân tích',
        href: 'adminAnalytics',
        icon: 'gala:chart',
      },
      {
        name: 'Sản phẩm',
        href: 'adminProducts',
        icon: 'fluent:box-20-regular',
      },
      {
        name: 'Thanh toán',
        href: 'adminPayments',
        icon: 'ion:wallet-outline',
      },
      {
        name: 'Đặt hàng',
        href: 'adminOrders',
        icon: 'iconoir:truck',
      },
      {
        name: 'Cài đặt',
        href: 'adminSettings',
        icon: 'ant-design:setting-outlined',
      },
    ])

    const selectedKeys = ref(['1']);

    return {
      selectedKeys,
      menus,
    }
  }
}
</script>

<style scoped></style>