<template>
  <button @click="showModal" type="button"
    class="mt-5 text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Thêm
  </button>
  <Modal size="xl" v-if="isShowModal" @close="closeModal">
    <template #header>
      <div class="flex items-center text-lg">
        Thêm sản phẩm
      </div>
    </template>
    <template #body>
      <a-form :model="formState">
        <div class="flex gap-3">
          <Input size="sm" label="Tên" class="w-32" v-model="formState.name" />
          <Input size="sm" label="Mã sp" class="w-32" v-model="formState.code" />
        </div>
        <div class="flex gap-3 py-2">
          <!-- <FileInput v-model="file" size="sm" label="Ảnh" class="w-32"/> -->
          <Input size="sm" label="Giá" class="w-32" v-model="formState.price" />
          <Input size="sm" label="Màu sắc" class="w-32" v-model="formState.color" />
        </div>
        <div class="flex gap-3 py-2">
          <Input size="sm" label="Chất liệu" class="w-32" v-model="formState.material" />
          <Input size="sm" label="Số lượng" class="w-32" v-model="formState.quantity" />
          <Input size="sm" label="Số ngày bảo hành" class="w-32" v-model="formState.warranty" />
        </div>
      </a-form>

    </template>
    <template #footer>
      <div class="flex justify-between">
        <button @click="closeModal" type="button"
          class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
          Từ chối
        </button>
        <button @click="onSubmit" type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Chấp nhận
        </button>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import { Modal, Input } from 'flowbite-vue';
import { ref, reactive } from 'vue';
// import FileInput from 'flowbite-vue'

const formState = reactive({
  name: '',
  code: '',
  price: '',
  color: '',
  material: '',
  quantity: '',
  warranty: '',
})

const isShowModal = ref(false)

function closeModal() {
  isShowModal.value = false
}
function showModal() {
  isShowModal.value = true
}

const onSubmit = () => {
  console.log("aaaa");
  console.log(formState.name, formState.code);
  isShowModal.value = false
}

</script>

<style scoped></style>