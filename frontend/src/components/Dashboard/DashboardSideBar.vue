<template>
  <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">
    <a-menu-item key="1">
      <span>
        <Icon icon="ic:round-dashboard" />
      </span>
      <span>Dashboard</span>
    </a-menu-item>
    <a-menu-item key="2">
      <Icon icon="icon-park-outline:analysis" />
      <span>Analytics</span>
    </a-menu-item>
    <a-menu-item key="3">
      <Icon icon="solar:box-outline" />
      <span>Products</span>
    </a-menu-item>
    <a-menu-item key="4">
      <Icon icon="cil:wallet" />
      <span>Payment</span>
    </a-menu-item>
    <a-menu-item key="5">
      <Icon icon="clarity:truck-line" />
      <span>Orders</span>
    </a-menu-item>
    <a-menu-item key="6">
      <Icon icon="uil:chat-bubble-user" />
      <span>Enquiry</span>
    </a-menu-item>
    <a-menu-item key="7">
      <Icon icon="ph:projector-screen-chart-light" />
      <span>Marketing</span>
    </a-menu-item>
    <a-menu-item key="8">
      <Icon icon="ep:setting" />
      <span>Setting</span>
    </a-menu-item>
  </a-menu>
</template>

<script>
import { Icon } from '@iconify/vue';
import { ref } from 'vue'
export default {
  components: {
		Icon,
    
	},

  setup(props) {
    const selectedKeys = ref(['1']);

    return {
      selectedKeys,
    }
  }
}
</script>

<style scoped></style>