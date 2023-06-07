<template>
  <a-layout class="min-h-screen">
    <a-layout-sider class="bg-white">
      <DashboardSideBar />
    </a-layout-sider>

    <a-layout>
      <DashboardHome />
    </a-layout>
  </a-layout>
</template>

<script>
import DashboardHome from '@/components/Dashboard/DashboardHome.vue'
import DashboardSideBar from '@/components/Dashboard/DashboardSideBar.vue'
export default {
  components: {
    DashboardHome,
    DashboardSideBar,
  },
}
</script>

<style lang="scss" scoped></style>