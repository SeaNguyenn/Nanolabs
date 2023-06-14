<template>
  <a-layout class="min-h-screen flex flex-row  bg-[#F7F7F7]">
    <!-- sidebar -->
    <div class="relative duration-300 p-4 pt-6 border-r-[1px] border-solid border-[#D1D1D1] bg-white"
    v-bind:class="{ 'w-20  min-w-[80px]': !showSiderbar, 'w-[200px] min-w-[200px]': showSiderbar }" >
      <DashboardSideBar :show-siderbar="showSiderbar" :open="open" @change-value="onChangeValue"/>
    </div>

    <!-- main content -->
    <div class="ml-auto duration-300" v-bind:class="{ 'w-[calc(100%-5rem)]': !showSiderbar , 'w-[calc(100%-200px)]': showSiderbar}" >
      <!-- header  -->
      <div class="bg-white px-4 py-5 border-b-[1px] border-solid border-[#D1D1D1]">
        <DashboardHome/>
      </div>
      
      <!-- content  -->
      <div class="py-7 px-2">
        <router-view></router-view>
      </div>
    </div>
  </a-layout>
</template>

<script>
import DashboardHome from '@/components/Dashboard/DashboardHome.vue'
import DashboardSideBar from '@/components/Dashboard/DashboardSideBar.vue'
import { defineComponent, ref } from 'vue'
export default defineComponent({
  components: {
    DashboardHome,
    DashboardSideBar,
  },

  setup(props, {emit}) {
    const showSiderbar = ref(true)
    const open = ref(true)

    const onChangeValue = () => {
      showSiderbar.value = !showSiderbar.value;
      open.value = !open.value;
    }

    return {
      showSiderbar,
      open,
      onChangeValue,
    }
  }
})
</script>

<style lang="scss" scoped></style>