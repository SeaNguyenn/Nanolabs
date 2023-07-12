<template>
  <div class="header-content flex items-center justify-between h-12 max-w-7xl my-0 mx-auto md:h-[60px]">

    <router-link :to="{name:'home'}" class="logo flex items-center gap-2 hover:text-white">
      <Icon icon="cryptocurrency:nano" class="text-3xl" />
      <h2 class="w-[118px] h-[36px] font-bold text-3xl text-white cursor-pointer">Nanolabs</h2>
    </router-link>

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
                <router-link :to="{ name: 'products' }" class="text-lg px-3">Danh sách sản phẩm</router-link>
              </a-menu-item>
              <a-menu-item>
                <router-link :to="{ name: 'all_categories' }" class="text-lg px-3">Phân loại sản phẩm</router-link>
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

        <a-popover placement="bottom" class="flex relative items-center cursor-pointer">
          <Icon icon="mi:shopping-cart" class="text-[29px]" />
          <span
            class="text-xs min-w-[15x] bg-violet-300 text-black text-center absolute top-[-5px] right-[-5px] p-[2.5px] rounded-lg"
            v-bind:class="countCart == 0 ? 'hidden' : ''">{{ countCart }}</span>
          <template #content>
            <div v-if="countCart != 0">
              <p class="mb-5 text-sm text-gray-400">Sản phẩm mới thêm</p>
            <div class="flex w-[300px]">
              <div class="w-[40px] h-[40px] border-2">
                <img src="@/assets/images/earbuds-prod-1.webp" alt="" class="w-full h-full">
              </div>

              <p class="text-sm text-ellipsis whitespace-nowrap overflow-hidden px-1 mx-3 mr-auto">abc</p>

              <div class="price text-red-600 ">8000</div>
            </div>
            <div class="flex gap-5 items-center justify-end mt-4">
              <p class="hidden">a Thêm hàng vào giỏ</p>
              <Button class="px-2 py-1 bg-red-600 text-white text-sm">Xem giỏ hàng</Button>
            </div>
            </div>
            
            <div class="w-[300px] h-[300px] flex justify-center items-center" v-else>
              <a-empty 
                image="/src/assets/images/empty.png"
                :image-style="{
                  height: '60px',
                }"
              >
                <template #description>
                  <span>
                    Chưa có sản phẩm
                  </span>
                </template>
              </a-empty>
            </div>
          </template>
        </a-popover>

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

      <div class="hidden gap-2 ml-3 lg:flex lg:items-center" v-if="userName == ''">
        <router-link :to="{ name: 'login' }" class="text-lg">Đăng nhập</router-link>
        <p class="text-lg">|</p>
        <router-link :to="{ name: 'register' }" class="text-lg">Đăng ký</router-link>
      </div>

      <div class="hidden gap-2 ml-3 text-xl lg:flex lg:items-center" v-if="userName != ''">
        <a-dropdown>
          <div class="text-lg font-bold flex items-center ant-dropdown-link cursor-pointer" @click.prevent>
            {{ userName }}
          </div>
          <template #overlay>
            <a-menu>
              <a-menu-item>
                <button @click="logout" class="text-lg">Đăng xuất</button>
              </a-menu-item>
            </a-menu>
          </template>
        </a-dropdown>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue'
import Button from '@/components/Button.vue'
import { reactive, watchEffect,onMounted, ref } from 'vue'
import { authStore } from '@/stores/auth.js';

export default {
  props: {
    countCart: Number,
  },

  components: {
    Icon,
    Button,
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
      { name: 'Trang chủ', path: 'home' },
      { name: 'Sản phẩm', path: 'products', submenu: true },
      { name: 'Liên hệ', path: '#' },
      { name: 'Danh mục sản phẩm', path: '#' },
    ]

    const auth = authStore();
    const userName = ref('');

    onMounted(() => {
      if (auth.authUser != null) {
        userName.value = auth.authUser.name;
      }
    })

    const logout = async () => {
      await auth.logout();
      window.location.reload();
    };

    const scrolled = ref(false);
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
      handleOk,
      userName,
      logout,
    };
  }
}
</script>

<style scoped>
.ant-empty {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>