<template>
  <a-layout class="min-h-screen">
    <a-layout-sider class="bg-white" v-model:collapsed="collapsed" collapsible>
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
import { ref } from 'vue'
export default {
  components: {
    DashboardHome,
    DashboardSideBar,
  },

  setup(props) {
    const collapsed = ref(false);

    return {
      collapsed,
    }
  }
}
</script>

<style lang="scss" scoped></style>