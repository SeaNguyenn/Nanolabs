<template>
  <a-layout class="min-h-screen flex flex-row  bg-[#F7F7F7]">
    <!-- sidebar -->
    <div class="relative duration-300 p-4 pt-6 border-r-[1px] border-solid border-[#D1D1D1] bg-white"
    v-bind:class="{ 'w-20  min-w-[80px]': !showSidebar, 'w-[200px] min-w-[200px]': showSidebar }" >
      <DashboardSideBar :show-siderbar="showSidebar" :open="open" @change-value="onChangeValue"/>
    </div>

    <!-- main content -->
    <div class="ml-auto duration-300" v-bind:class="{ 'w-[calc(100%-5rem)]': !showSidebar , 'w-[calc(100%-200px)]': showSidebar}" >
      <!-- header  -->
      <div class="bg-gradient-to-r from-[#2196F3] to-[#E91E63] px-4 py-5 border-b-[1px] border-solid border-[#D1D1D1]">
        <DashboardHeader/>
      </div>
      
      <!-- content  -->
      <div class="py-7 px-2">
        <router-view></router-view>
      </div>
    </div>
  </a-layout>
</template>

<script setup>
import DashboardHeader from '@/components/Dashboard/DashboardHeader.vue'
import DashboardSideBar from '@/components/Dashboard/DashboardSideBar.vue'
import { ref } from 'vue'

const showSidebar = ref(false)
const open = ref(false)

const onChangeValue = () => {
  showSidebar.value = !showSidebar.value
  open.value = !open.value
}
</script>