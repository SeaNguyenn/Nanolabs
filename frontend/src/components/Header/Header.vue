<template>
  <div class="header-content flex items-center justify-between h-12 max-w-7xl my-0 mx-auto md:h-[60px]">

    <router-link :to="{ name: 'homepage' }" class="logo flex items-center gap-2 hover:text-white">
      <Icon icon="cryptocurrency:nano" class="text-3xl" />
      <h2 class="w-[118px] h-[36px] font-bold text-3xl text-white cursor-pointer">Nanolabs</h2>
    </router-link>

    <Input placeholder="Tìm kiếm" class="min-w-[20rem] md:min-w-[45rem] text-dark-background" v-model="search"
      @keyup.enter="emitInput">
    <template #prefix>
      <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
    </template>
    </Input>

    <div class="flex items-center justify-between p-2">
      <div class="flex items-center justify-between gap-3">
        <router-link  v-if="userId == 'Admin' || userId == 'Boss'" :to="{name: 'dashboard'}">
          <Button color="light" gradient="purple-pink" class="uppercase text-sm">Quản lý</Button>
        </router-link>
        <a-popover v-if="userId != 'Admin' && userId != 'Boss'" placement="bottom" class="flex relative items-center cursor-pointer">
          <Icon icon="mi:shopping-cart" class="text-[29px]" />
          <span
            class="text-xs min-w-[15px] min-h-[15px] bg-white text-black text-center absolute top-[-5px] right-[-5px] p-[2.5px] rounded-lg"
            v-bind:class="countCart == 0 ? 'hidden' : ''">{{ countCart }}</span>
          <template #content>
            <div v-if="countCart != 0">
              <p class="mb-5 text-sm text-gray-400">Sản phẩm mới thêm</p>
              <div class="flex flex-col gap-4">
                <div v-for="(cartItem, index) of userCart" class="flex w-[300px] gap-2">
                  <div class="w-[80px] h-[40px] border-2">
                    <img :src="cartItem.image" alt="" class="w-full h-full">
                  </div>

                  <div class="flex flex-col text-sm text-ellipsis whitespace-nowrap overflow-hidden">
                    <p class="px-1 mx-3 mr-auto">{{ cartItem.name }}</p>
                    <p class="text-xs px-1 mx-3 mr-auto">{{ cartItem.code }}</p>
                  </div>

                  <div class="price text-xs text-red-600 flex flex-col">
                    <span class="line-through decoration-red-400">{{
                      Number(cartItem.price).toLocaleString("en-US") }}<sup>₫</sup></span>
                    <span>{{ Number(cartItem.sale_price).toLocaleString("en-US") }}<sup>₫</sup></span>
                  </div>
                </div>
              </div>

              <div class="flex gap-5 items-center justify-end mt-4">
                <router-link :to="{name: 'cart'}" class="px-2 py-1 bg-red-600 text-white text-sm">Xem giỏ hàng</router-link>
              </div>
            </div>

            <div class="w-[300px] h-[300px] flex justify-center items-center" v-else>
              <a-empty image="/src/assets/images/empty.png" :image-style="{
                height: '60px',
              }">
                <template #description>
                  <span>
                    Chưa có sản phẩm
                  </span>
                </template>
              </a-empty>
            </div>
          </template>
        </a-popover>

        <div class="relative flex items-center cursor-pointer lg:hidden">
          <a-dropdown :trigger="['click']">
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
        <a-dropdown :trigger="['click']">
          <div class="text-lg font-bold flex gap-1 items-center ant-dropdown-link cursor-pointer" @click.prevent>
            <Avatar status="online" size="xs" rounded
              :img="avatar" />
            {{ userName }}
          </div>
          <template #overlay>
            <a-menu>
              <a-menu-item>
                <button @click="logout" class="text-md">Đăng xuất</button>
              </a-menu-item>
            </a-menu>
          </template>
        </a-dropdown>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Icon } from '@iconify/vue'
import { Input, Button, Avatar } from 'flowbite-vue'
import { computed, watchEffect, onMounted, ref, onBeforeMount } from 'vue'
import { authStore } from '@/stores/auth.js';
import { useRouter } from 'vue-router'
import { useCartStore } from '@/stores/cart.js';

const userId = ref()
const scrolled = ref(false);
const search = ref('');

const emit = defineEmits(['scrolled', 'inputSearch'])

const countCart = ref(0);
const cartStore = useCartStore();
const auth = authStore();
const router = useRouter();
const userName = ref('');
const entered = ref(false);
const avatar = ref();
const userCart = ref([]);
const perPage = ref(5);

cartStore.fetchCart({
  per_page: perPage.value,
})

const cartList = computed(() => cartStore.cart);
const getCartData = async () => {
  await cartStore.fetchCart({
    per_page: perPage.value,
  })
}

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

onMounted(() => {
  if (auth.authUser != null) {
    userName.value = auth.authUser.name;
    avatar.value = auth.authUser.avatar;
    userId.value = auth.authUser.role_id;
  }
})

onBeforeMount(async () => {
  await getCartData()
  countCart.value = cartList.value.data.length
  userCart.value = cartList.value.data
});

const logout = async () => {
  await auth.logout();
  window.location.reload();
  router.push({ name: 'login' })
};

const emitInput = () => {
  if (!entered.value) {
    emit('inputSearch', search.value)
    entered.value = true;
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