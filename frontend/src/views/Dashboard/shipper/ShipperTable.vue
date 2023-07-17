<template>

</template>

<script setup>
import { useShipperStore } from '@/stores/shipper.js';
import { onMounted, ref, computed } from 'vue'

const shipperStore =  useShipperStore()

onMounted(() => {
  getDataShippers();
})

const shippers = computed(() => shipperStore.shippers.data)
const perPage = ref(10);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc')

function getDataShippers() {
  shipperStore.fetchShippers({
      search: search.value,
      per_page: perPage.value,
      sort_field: sortField.value,
      sort_direction: sortDirection.value,
    }
  )
}

function sortShippers(field) {
  if (field === sortField.value) {
    if (sortDirection.value === 'desc') {
      sortDirection.value = 'asc'
    } else {
      sortDirection.value = 'desc'
    }
  } else {
    sortField.value = field;
    sortDirection.value = 'asc'
  }

  getDataShippers()
}


</script>

<style lang="scss" scoped></style>