<template>
  <div class="bg-white py-5 px-32 flex justify-between items-center">
    <div class="logo flex items-center">
      <Icon icon="cryptocurrency:nano" class="text-3xl mr-2" />
      <h2 class="w-[118px] h-[36px] font-bold text-3xl cursor-pointer">Nanolabs</h2>
    </div>

    <ul class="flex items-center">
      <li class="px-4" v-for="route in routes">
        <router-link :to="route.path" class="text-xl flex items-center" v-bind:class="route.submenu == true ? 'hidden' : ''">
          <span>{{ route.name }}</span>
        </router-link>

        <a-dropdown v-if="route.submenu == true">
          <div class="text-xl flex items-center ant-dropdown-link cursor-pointer" @click.prevent>
            <span>{{ route.name }}</span>
            <Icon icon="gridicons:dropdown" class="text-2xl"/>
          </div>
          <template #overlay>
            <a-menu>
              <a-menu-item>
                <router-link :to="{ name: '' }" class="text-lg">item</router-link>
              </a-menu-item>
              <a-menu-item>
                <router-link :to="{ name: '' }" class="text-lg">item</router-link>
              </a-menu-item>
              <a-menu-item>
                <router-link :to="{ name: '' }" class="text-lg">item</router-link>
              </a-menu-item>
            </a-menu>
          </template>
        </a-dropdown>
      </li>
    </ul>

    <div class="flex items-center justify-between primary-color">
      <div class="flex items-center justify-between">
        <Icon icon="carbon:search" class="text-2xl mr-2 cursor-pointer" @click="showModal"/>
        <a-modal v-model:visible="visible" title="Tìm kiếm" @ok="handleOk" okType="default">
          <a-input v-model:value="search" placeholder="Tìm kiếm" />
        </a-modal>

        <div class="flex items-center cursor-pointer">
          <Icon icon="ion:cart-outline" class="text-2xl mr-1" />
          <span class="text-base">1</span>
        </div>
        <div class="flex items-center cursor-pointer">
          <Icon icon="icon-park-outline:like" class="text-2xl mx-1" />
          <span class="text-base">1</span>
        </div>
      </div>
      <div class="flex items-center ml-2">
        <router-link :to="{}" class="text-base mr-2">Đăng nhập</router-link>
        <p class="">/</p>
        <router-link :to="{}" class="text-base ml-2">Đăng ký</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue'
import { ref } from 'vue'
export default {
  components: {
    Icon,
  },

  setup() {
    let routes = [
      { name: 'Trang chủ', path: '#' },
      { name: 'Sản phẩm', path: '#', submenu: true },
      { name: 'Liên hệ', path: '#' },
      { name: 'Blog', path: '#' },
    ]

    const visible = ref(false);

    const showModal = () => {
      visible.value = true;
    };

    const handleOk = () => {
      visible.value = false;
    };

    return {
      routes,
      visible,
      showModal,
      handleOk,
    };
  }
}
</script>

<style scoped></style>