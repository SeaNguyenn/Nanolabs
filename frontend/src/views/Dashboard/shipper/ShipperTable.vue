<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select @change="getDataShippers()" v-model="perPage"
          class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ml-3">Tổng có {{ shippers.total }}</span>
      </div>
      <div>
        <input v-model="search" @change="getDataShippers()"
          class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Tìm kiếm">
      </div>
    </div>

    <Table>
      <table-head>
        <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortShippers('id')">
          ID
        </TableHeaderCell>
        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection">
          Tên
        </TableHeaderCell>
        <TableHeaderCell field="phone" :sort-field="sortField" :sort-direction="sortDirection"
          @click="sortShippers('phone')">
          Số điện thoại
        </TableHeaderCell>
        <TableHeaderCell field="address" :sort-field="sortField" :sort-direction="sortDirection"
          @click="sortShippers('address')">
          Địa chỉ
        </TableHeaderCell>
        <TableHeaderCell field="created_at" :sort-field="sortField" :sort-direction="sortDirection"
          @click="sortShippers('created_at')">
          Ngày tạo
        </TableHeaderCell>
        <TableHeaderCell field="actions">
          Actions
        </TableHeaderCell>
      </table-head>
      <!-- <table-body v-if="loading || !shippers.length">
        <table-row>
          <table-cell>
              <spinner v-if="loading"/>
              <p v-else class="text-center py-8 text-gray-700">
                No data
              </p>
          </table-cell>
        </table-row>
      </table-body> 
      <table-body v-else>-->
      <table-body>
        <table-row v-for="(shipper, index) of shippers.data">
          <table-cell>{{ shipper.id }}</table-cell>
          <table-cell>{{ shipper.name }}</table-cell>
          <table-cell>{{ shipper.phone }}</table-cell>
          <table-cell>{{ shipper.address }}</table-cell>
          <table-cell>{{ shipper.created_at }}</table-cell>
          <table-cell>a</table-cell>
        </table-row>
      </table-body>
    </Table>

    <div v-if="!loading" class="flex justify-between items-center mt-5">
      <!-- <div v-if="shippers.data.length">
        Showing from {{ shippers.from }} to {{ shippers.to }}
      </div> -->
      <nav v-if="shippers.total > shippers.limit"
        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        <a v-for="(link, i) of shippers.links" :key="i" :disabled="!link.url" href="#" @click="getForPage($event, link)"
          aria-current="page"
          class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap" :class="[
            link.active
              ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
              : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
            i === 0 ? 'rounded-l-md' : '',
            i === shippers.links.length - 1 ? 'rounded-r-md' : '',
            !link.url ? ' bg-gray-100 text-gray-700' : ''
          ]" v-html="link.label">
        </a>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { useShipperStore } from '@/stores/shipper.js';
import { onMounted, ref, computed } from 'vue'
import TableHeaderCell from '@/components/TableHeaderCell.vue';
import { Table, TableHead, TableBody, TableHeadCell, TableRow, TableCell } from 'flowbite-vue'
import { Spinner } from 'flowbite-vue'
const shipperStore = useShipperStore()


const shippers = computed(() => shipperStore.shippers)
console.log(shippers.value);
const loading = computed(() => shipperStore.loading)
const perPage = ref(10);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');
const shipper = ref({});

const emit = defineEmits(['clickEdit'])

onMounted(() => {
  getDataShippers();
})

function getDataShippers() {
  shipperStore.fetchShippers({
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
  })
}

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  getDataShippers(link.url)
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

function editShipper(p) {
  emit('clickEdit', p)
}
</script>

<style lang="scss" scoped></style>