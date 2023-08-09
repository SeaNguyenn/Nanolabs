<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select @change="getDataOrders()" v-model="perPage"
                class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ml-3">Tổng có {{ orders.total }}</span>
      </div>
      <div>
        <input v-model="search" @change="getDataOrders()"
               class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
               placeholder="Tìm kiếm">
      </div>
    </div>

    <Table>
      <table-head>
        <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortOrders('id')">
          ID
        </TableHeaderCell>
        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection">
          Tên
        </TableHeaderCell>
        <TableHeaderCell field="code" :sort-field="sortField" :sort-direction="sortDirection">
          Mã
        </TableHeaderCell>
        <TableHeaderCell field="supplier_id" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortOrders('supplier_id')">
          Nhà cung cấp
        </TableHeaderCell>
        <TableHeaderCell field="price" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortOrders('price')">
          Giá
        </TableHeaderCell>
        <TableHeaderCell field="sale_price" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortOrders('sale_price')">
          Giá sale
        </TableHeaderCell>
        <TableHeaderCell field="image" :sort-field="sortField" :sort-direction="sortDirection">
          Ảnh
        </TableHeaderCell>
        <TableHeaderCell field="warranty" :sort-field="sortField" :sort-direction="sortDirection">
          Bảo hành
        </TableHeaderCell>
        <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection">
          Miêu tả
        </TableHeaderCell>
        <TableHeaderCell field="created_at" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortOrders('created_at')">
          Ngày tạo
        </TableHeaderCell>
        <TableHeaderCell field="actions">

        </TableHeaderCell>
      </table-head>
      <table-body v-if="loading || !orders.data">
        <table-row>
          <table-cell>
            <spinner v-if="loading" />
            <p v-else class="text-center py-8 text-gray-700">
              Không có dữ liệu
            </p>
          </table-cell>
        </table-row>
      </table-body>
      <table-body v-else>
        <!-- <table-body> -->
        <table-row v-for="(order, index) of orders.data">
          <table-cell>{{ index + 1 }}</table-cell>
          <table-cell>{{ order.name }}</table-cell>
          <table-cell>{{ order.code }}</table-cell>
          <table-cell>{{ order.supplier_id }}</table-cell>
          <table-cell>{{ Number(order.price).toLocaleString("vi-VN") }}<sup>₫</sup></table-cell>
          <table-cell>{{ order.sale_price ? Number(order.sale_price).toLocaleString("vi-VN") : 0 }}<sup>₫</sup></table-cell>
          <table-cell>
            <img :src="order.image" alt="" class="h-7 w-10">
          </table-cell>
          <table-cell>{{ order.warranty }} Tháng</table-cell>
          <table-cell>{{ order.description }}</table-cell>
          <table-cell>{{ order.created_at }}</table-cell>
          <table-cell>
            <Menu as="div" class="relative inline-block text-left">
              <div>
                <MenuButton
                    class="inline-flex items-center justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                  <Icon icon="tabler:dots" class="h-5 w-5 text-indigo-500" />
                </MenuButton>
              </div>

              <transition enter-active-class="transition duration-100 ease-out"
                          enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                          leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                          leave-to-class="transform scale-95 opacity-0">
                <MenuItems
                    class="absolute z-10 right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                      <button :class="[
                      active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]" @click="editOrder(order)">
                        <Icon icon="ion:pencil-outline" :active="active" class="mr-2 h-5 w-5 text-indigo-400" />
                        Sửa
                      </button>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <button :class="[
                      active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]" @click="deleteOrder(order)">
                        <Icon icon="ph:trash-light" class="mr-2 h-5 w-5 text-indigo-400" :active="active" />
                        Xoá
                      </button>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
          </table-cell>
        </table-row>
      </table-body>
    </Table>

    <div v-if="!loading" class="flex justify-between items-center mt-5">
      <div v-if="orders.data">
        Hiển thị từ {{ orders.from }} đến {{ orders.to }}
      </div>
      <nav v-if="orders.total > orders.limit"
           class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        <a v-for="(link, i) of orders.links" :key="i" :disabled="!link.url" href="#" @click="getForPage($event, link)"
           aria-current="page"
           class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap" :class="[
            link.active
              ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
              : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
            i === 0 ? 'rounded-l-md' : '',
            i === orders.links.length - 1 ? 'rounded-r-md' : '',
            !link.url ? ' bg-gray-100 text-gray-700' : ''
          ]" v-html="link.label">
        </a>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { useOrderStore } from '@/stores/order.js';
import { onMounted, ref, computed } from 'vue'
import TableHeaderCell from '@/components/TableHeaderCell.vue';
import { Table, TableHead, TableBody, TableRow, TableCell } from 'flowbite-vue'
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { Icon } from '@iconify/vue';
import { Spinner } from 'flowbite-vue'
const orderStore = useOrderStore()


const orders = computed(() => orderStore.orders)
const loading = computed(() => orderStore.loading)
const perPage = ref(10);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');
const order = ref({});

const emit = defineEmits(['clickEdit'])

onMounted(async () => {
  await getDataOrders();
})

function getDataOrders() {
  orderStore.fetchOrders({
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

  getDataOrders(link.url)
}

function sortOrders(field) {
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

  getDataOrders()
}

function deleteOrder(order) {
  if (!confirm(`Bạn có muốn xoá không?`)) {
    return
  }
  orderStore.deleteOrder(order.id).then(res => {
    orderStore.fetchOrders()
  })
}

function editOrder(p) {
  emit('clickEdit', p)
}
</script>

<style lang="scss" scoped></style>