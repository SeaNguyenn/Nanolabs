<template>
  <div class="header-content flex items-center justify-between h-12 max-w-7xl my-0 mx-auto md:h-[60px]">

    <div class="logo flex items-center gap-2">
      <Icon icon="cryptocurrency:nano" class="text-3xl" />
      <h2 class="w-[118px] h-[36px] font-bold text-3xl text-white cursor-pointer">Nanolabs</h2>
    </div>

    <ul class="hidden md:flex md:items-center ">
      <li class="px-2 lg:px-4" v-for="route in routes">
        <router-link :to="route.path" class="text-lg font-bold flex items-center lg:text-xl"
          v-bind:class="route.submenu == true ? 'hidden' : ''">
          <span>{{ route.name }}</span>
        </router-link>

        <a-dropdown v-if="route.submenu == true">
          <div class="text-lg font-bold flex items-center ant-dropdown-link cursor-pointer lg:text-xl" @click.prevent>
            <span>{{ route.name }}</span>
            <Icon icon="gridicons:dropdown" class="text-2xl" />
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
      <div class="flex items-center justify-between gap-3">
        <Icon icon="carbon:search" class="text-[29px] cursor-pointer" @click="showModal" />
        <a-modal v-model:visible="visible" title="Tìm kiếm" @ok="handleOk" okType="default">
          <a-input v-model:value="search" placeholder="Tìm kiếm" />
        </a-modal>

        <div class="flex relative items-center cursor-pointer">
          <Icon icon="solar:cart-linear" class="text-[29px]" />
          <span
            class="text-xs min-w-[15px] bg-violet-300 text-black text-center absolute top-[-5px] right-[-5px] p-[2.5px] rounded-lg"
            v-bind:class="countCart == 0 ? 'hidden' : ''">{{ countCart }}</span>
        </div>

        <div class="relative flex items-center cursor-pointer">
          <Icon icon="icon-park-outline:like" class="text-[29px]" />
          <span
            class="text-xs min-w-[15px] bg-violet-300 text-black text-center absolute top-[-5px] right-[-5px] p-[2.5px] rounded-lg"
            v-bind:class="countWishList == 0 ? 'hidden' : ''">{{ countWishList }}</span>
        </div>

        <div class="relative flex items-center cursor-pointer lg:hidden">
          <a-dropdown>
            <div class="text-lg font-bold flex items-center ant-dropdown-link cursor-pointer" @click.prevent>
              <Icon icon="bx:user" class="text-[29px]" />
            </div>
            <template #overlay>
              <a-menu>
                <a-menu-item>
                  <router-link :to="{ name: 'login' }" class="text-lg">Đăng nhập</router-link>
                </a-menu-item>
                <a-menu-item>
                  <router-link :to="{ name: 'register' }" class="text-lg">Đăng ký</router-link>
                </a-menu-item>
              </a-menu>
            </template>
          </a-dropdown>
        </div>
      </div>

      <div class="hidden gap-2 ml-3 lg:flex lg:items-center">
        <router-link :to="{ name: 'login' }" class="text-lg">Đăng nhập</router-link>
        <p class="text-lg">|</p>
        <router-link :to="{ name: 'register' }" class="text-lg">Đăng ký</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue'
import { reactive, watchEffect, ref } from 'vue'
export default {
  components: {
    Icon,
  },

  setup(props, { emit }) {

    watchEffect(() => {
      window.addEventListener('scroll', () => {
        const offset = window.scrollY;
        if (offset > 200) {
          scrolled.value = true;
        } else {
          scrolled.value = false;
        }
        emit('scrolled', scrolled.value)
      })
    });

    let routes = [
      { name: 'Trang chủ', path: '#' },
      { name: 'Sản phẩm', path: '#', submenu: true },
      { name: 'Liên hệ', path: '#' },
      { name: 'Blog', path: '#' },
    ]

    const scrolled = ref(false);

    const countCart = ref(1);
    const countWishList = ref(0);
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
      countWishList,
      countCart,
      handleOk,
    };
  }
}
</script>

<style scoped></style>