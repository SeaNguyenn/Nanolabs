<template>
  <TransitionRoot appear :show="show" as="template">
    <Dialog as="div" @close="show = false" class="relative z-10">
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
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all large-modal">
              <div class="modal-content overflow-y-auto h-full">
                <spinner v-if="loading"
                  class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center" />
                <header class="py-3 px-4 flex justify-between items-center">
                  <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                    {{ category.id ? `Cập nhật:` : 'Thêm mới' }}
                  </DialogTitle>
                  <button @click="closeModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </header>
                <a-form enctype="multipart/form-data" @submit="onSubmit" class="flex flex-col justify-between gap-[7rem]">
                  <div class="flex flex-wrap gap-4 bg-white px-4 pt-5 pb-4">
                    <CustomInput class="mb-2" v-model="category.name" label="Tên danh mục" />
                  </div>
                  <div class="px-4 py-3 flex justify-between items-center">
                    <button type="button"
                      class="inline-flex justify-center rounded-md border border-transparent bg-red-400 px-4 py-2 text-sm font-medium text-white hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                      @click="closeModal">
                      Đóng
                    </button>
                    <button type="submit"
                      class="inline-flex justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-green-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                      Lưu
                    </button>
                  </div>
                </a-form>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
<script setup>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import { useCategoryStore } from '@/stores/category.js';
import CustomInput from '@/components/CustomInput.vue'
import { ref, computed, onUpdated } from 'vue'
import { Spinner } from 'flowbite-vue'

const category = ref({
  id: props.category.id,
  name: props.category.name,
})

const props = defineProps({
  modelValue: Boolean,
  category: {
    required: true,
    type: Object,
  }
})

const emit = defineEmits(['update:modelValue', 'close'])

const categoryStore = useCategoryStore()
const loading = computed(() => categoryStore.loading)

const show = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

onUpdated(() => {
  category.value = {
    id: props.category.id,
    name: props.category.name,
  }
})

function closeModal() {
  show.value = false
  emit('close')
}

const onSubmit = async () => {
  loading.value = true
  if (category.value.id) {
    try {
      await categoryStore.updateCategory(category.value.id, category.value).then(res => {
        closeModal()
        loading.value = false
        categoryStore.fetchCategories()
      });

    } catch (e) {
      console.log(e);
    }
  } else {
    try {
      await categoryStore.addCategory(category.value).then(res => {
        closeModal()
        loading.value = false
        categoryStore.fetchCategories()
      });
    } catch (e) {
      console.log(e);
    }
  }
}
</script>
    
<style scoped>
.large-modal {
  width: 600px;
  max-width: 90%;
  height: 400px;
  max-height: 90%;
}
</style>
  