<template>
  <button type="button" @click="openModal"
    class="rounded-md bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
    Tạo mới
  </button>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-10">
      <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
        leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95">
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <header class="py-3 px-4 flex justify-between items-center">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                  Thêm mới
                </DialogTitle>
                <button @click="closeModal()"
                  class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </header>
              <a-form :model="form" enctype="multipart/form-data" @submit="onSubmit">
                <div class="flex flex-wrap gap-4 bg-white px-4 pt-5 pb-4">
                  <Input v-model="form.name" size="sm" placeholder="" type="text" label="Tên"
                    class="w-40" />
                  <Input v-model="form.email" size="sm" placeholder="" type="email" label="Email"
                    class="w-40" />
                  <Input v-model="form.phone" size="sm" placeholder="" type="text" label="Số đt"
                    class="w-40" />
                  <Input v-model="form.address" size="sm" placeholder="" type="text" label="Địa chỉ"
                    class="w-40" />
                  <div class="flex flex-col">
                    <label for="file_input">Ảnh</label>
                    <input type="file" name="avatar" @change="handleFileChange" id="file_input" class="border rounded-lg cursor-pointer"/>
                  </div>
                </div>

                <div class="px-4 py-3 flex justify-between items-center">
                  <button type="button"
                    class="inline-flex justify-center rounded-md border border-transparent bg-red-400 px-4 py-2 text-sm font-medium text-white hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    @click="closeModal">
                    Từ chối
                  </button>
                  <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-green-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    >
                    Chấp nhận
                  </button>
                </div>
              </a-form>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
  <ShipperTable />
</template>

<script setup>
import { ref, reactive } from 'vue'
import { Input } from 'flowbite-vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import { useShipperStore } from '@/stores/shipper.js';
import ShipperTable from './ShipperTable.vue'
const form = reactive({
  name: '',
  email: '',
  phone: '',
  address: '',
  avatar: '',
})
// const shipperStore = useShipperStore();
const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}
function openModal() {
  isOpen.value = true
}

const avatar = ref();
const handleFileChange = (e) => {
  const file = e.target.files[0]
  if (file) {
    avatar.value = file;
    form.avatar = avatar.value;
  }
}

const onSubmit = () => {
  try {
    shipperStore.addShipper(form);
    isOpen.value = false;
  } catch (e) {
    console.log(e);
    isOpen.value = true;
  }
}

</script>
