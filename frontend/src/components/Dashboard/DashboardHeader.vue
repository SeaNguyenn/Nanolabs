<template>
  <div class="relative shrink-0 flex justify-end items-center">
    <div class="flex justify-between items-center space-x-4 px-4">
      <a-popover placement="bottomRight" trigger="click" class="flex items-center mr-3">
        <button class="inline-block relative text-2xl">
          <Icon icon="lucide:bell-ring" class="text-white"/>
          <span
            class="animate-ping absolute top-1 right-0.5 block h-2 w-2 rounded-full ring-2 ring-red-400 bg-red-600"></span>
        </button>
        <template #content>
          <div>a</div>
          <div>a</div>
          <div>a</div>
          <div>a</div>
        </template>
      </a-popover>

    <a-popover placement="bottomRight" trigger="click" class="flex items-center">
        <button class="inline-flex items-center justify-center">
          <img class="h-9 w-9 rounded-full" :src="user.image" alt="" />
        </button>
        <template #content >
          <div class="flex flex-col">
            <router-link :to="{name: 'homepage'}">
              <a-button type="text" class="px-2 py-2 text-sm cursor-pointer">
                Quay lại trang chính
              </a-button>
            </router-link>
            <a-button type="text" class="px-2 py-2 text-sm cursor-pointer logout-btn" @click="logout">
              Logout
            </a-button>
          </div>
        </template>
      </a-popover>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { Icon } from '@iconify/vue';
import { authStore } from '@/stores/auth.js';
import { useRouter } from 'vue-router'

const props = defineProps({
  showSiderbar: Boolean,
})
const getUserData = sessionStorage.getItem('user')
const userData = JSON.parse(getUserData);
const user = userData.user

const auth = authStore();
const router = useRouter();

const logout = async () => {
  await auth.logout();
  router.push({ name: 'login' })
};

</script>

<style scoped>.logout-btn:hover {
  color: #fff;
  background-color: #5BABE5;
}</style>