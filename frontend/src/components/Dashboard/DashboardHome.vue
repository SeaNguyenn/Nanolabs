<template>
  <div class="relative shrink-0 flex justify-between">
    <div>a</div>
    <div class="flex justify-between items-center space-x-4 px-4">
      <a-popover placement="bottomRight" trigger="click" class="flex items-center">
        <button class="inline-flex items-center justify-center">
          <img class="h-9 w-9 rounded-full" src="" alt="" />
        </button>
        <template #content>
          <a-button type="text" class="px-2 py-2 text-sm cursor-pointer logout-btn">
            Logout
          </a-button>
        </template>
      </a-popover>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import { Icon } from '@iconify/vue';
export default {
  components: {
    Icon,
  },

  props: {
    showSiderbar: { type: Boolean, default: true },
  },
  setup(props, { emit }) {
    return {}
  }
}
</script>

<style scoped>
.logout-btn:hover {
  color: #fff;
  background-color: #5BABE5;
}
</style>