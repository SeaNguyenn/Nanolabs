<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select @change="getDataCategories()" v-model="perPage"
          class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ml-3">Tổng có {{ categories.total }}</span>
      </div>
      <div>
        <input v-model="search" @change="getDataCategories()"
          class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Tìm kiếm">
      </div>
    </div>

    <Table>
      <table-head>
        <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortCategories('id')">
          ID
        </TableHeaderCell>
        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection">
          Tên
        </TableHeaderCell>
        <TableHeaderCell field="parent_id" :sort-field="sortField" :sort-direction="sortDirection"
          @click="sortCategories('parent_id')">
          Id cha
        </TableHeaderCell>
        <TableHeaderCell field="actions">

        </TableHeaderCell>
      </table-head>
      <table-body v-if="loading || !categories.data">
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
        <table-row v-for="(category, index) of categories.data">
          <table-cell>{{ index + 1 }}</table-cell>
          <table-cell>{{ category.name }}</table-cell>
          <table-cell>{{ category.parent_id }}</table-cell>
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
                    ]" @click="editCategory(category)">
                      <Icon icon="ion:pencil-outline" :active="active" class="mr-2 h-5 w-5 text-indigo-400" />
                      Sửa
                    </button>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                    <button :class="[
                      active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]" @click="deleteCategory(category)">
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
      <div v-if="categories.data">
        Hiển thị từ {{ categories.from }} đến {{ categories.to }}
      </div>
      <nav v-if="categories.total > categories.limit"
        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        <a v-for="(link, i) of categories.links" :key="i" :disabled="!link.url" href="#" @click="getForPage($event, link)"
          aria-current="page"
          class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap" :class="[
            link.active
              ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
              : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
            i === 0 ? 'rounded-l-md' : '',
            i === categories.links.length - 1 ? 'rounded-r-md' : '',
            !link.url ? ' bg-gray-100 text-gray-700' : ''
          ]" v-html="link.label">
        </a>
      </nav>
    </div>
  </div>
</template>
    
<script setup>
import { useCategoryStore } from '@/stores/category.js';
import { onMounted, ref, computed } from 'vue'
import TableHeaderCell from '@/components/TableHeaderCell.vue';
import { Table, TableHead, TableBody, TableRow, TableCell } from 'flowbite-vue'
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { Icon } from '@iconify/vue';
import { Spinner } from 'flowbite-vue'
const categoryStore = useCategoryStore()


const categories = computed(() => categoryStore.categories)
const loading = computed(() => categoryStore.loading)
const perPage = ref(10);
const search = ref('');
const sortField = ref('id');
const sortDirection = ref('desc');
const category = ref({});

const emit = defineEmits(['clickEdit'])

onMounted(async () => {
  await getDataCategories();
})

function getDataCategories() {
  categoryStore.fetchCategories({
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

  getDataCategories(link.url)
}

function sortCategories(field) {
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

  getDataCategories()
}

function deleteCategory(category) {
  if (!confirm(`Bạn có muốn xoá không?`)) {
    return
  }
  categoryStore.deleteCategory(category.id).then(res => {
    categoryStore.fetchCategories()
  })
}

function editCategory(p) {
  emit('clickEdit', p)
}
</script>
    
<style lang="scss" scoped></style>