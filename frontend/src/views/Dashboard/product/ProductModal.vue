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
                    {{ product.id ? `Cập nhật:` : 'Thêm mới' }}
                  </DialogTitle>
                  <button @click="closeModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </header>
                <a-form enctype="multipart/form-data" @submit="onSubmit">
                  <div class="flex flex-wrap gap-4 bg-white px-4 pt-5 pb-4">
                    <CustomInput class="mb-2" v-model="product.name" label="Tên sản phẩm" />
                    <CustomInput type="file" class="mb-2 p-0" label="Ảnh" @change="file => product.image = file" />
                    <CustomInput class="mb-2" v-model="product.supplier_id" label="Nhà cung cấp" />
                    <CustomInput class="mb-2" type="number" v-model="product.price" label="Giá" />
                    <CustomInput class="mb-2" type="number" v-model="product.sale_price" label="Giá Sale" />
                    <CustomInput class="mb-2" v-model="product.color" label="Màu" />
                    <CustomInput class="mb-2" v-model="product.material" label="Chất liệu" />
                    <CustomInput class="mb-2" type="number" v-model="product.warranty" label="Bảo hành" />
                    <CustomInput class="mb-2" type="textarea" v-model="product.description" label="Thông tin" />
                  </div>
                  <div class="px-4 py-3 flex justify-between items-center">
                    <button type="button"
                      class="inline-flex justify-center rounded-md border border-transparent bg-red-400 px-4 py-2 text-sm font-medium text-white hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                      @click="closeModal">
                      Từ chối
                    </button>
                    <button type="submit"
                      class="inline-flex justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-sm font-medium text-white hover:bg-green-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                      Chấp nhận
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
import { useProductStore } from '@/stores/product.js';
import CustomInput from '@/components/CustomInput.vue'
import { ref, computed, onUpdated } from 'vue'
import { Spinner } from 'flowbite-vue'

const product = ref({
  id: props.product.id,
  supplier_id: props.product.supplier_id,
  name: props.product.name,
  code: props.product.code,
  description: props.product.description,
  price: props.product.price,
  sale_price: props.product.sale_price,
  image: props.product.image,
  evaluate: props.product.evaluate,
  color: props.product.color,
  material: props.product.material,
  warranty: props.product.warranty,
  material: props.product.material,
})

const props = defineProps({
  modelValue: Boolean,
  product: {
    required: true,
    type: Object,
  }
})

const emit = defineEmits(['update:modelValue', 'close'])

const productStore = useProductStore()
const loading = computed(() => productStore.loading)

const show = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

onUpdated(() => {
  product.value = {
    id: props.product.id,
    supplier_id: props.product.supplier_id,
    name: props.product.name,
    code: props.product.code,
    description: props.product.description,
    price: props.product.price,
    sale_price: props.product.sale_price,
    image: props.product.image,
    evaluate: props.product.evaluate,
    color: props.product.color,
    material: props.product.material,
    warranty: props.product.warranty,
    material: props.product.material,
  }
})

function closeModal() {
  show.value = false
  emit('close')
}

const onSubmit = async () => {
  loading.value = true
  if (product.value.id) {
    try {
      await productStore.updateProduct(product.value.id, product.value).then(res => {
        closeModal()
        loading.value = false
        productStore.fetchProducts()
      });

    } catch (e) {
      console.log(e);
    }
  } else {
    try {
      await productStore.addProduct(product.value).then(res => {
        closeModal()
        loading.value = false
        productStore.fetchProducts()
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
