<template>
  <div class="flex justify-center content-center mt-10">
    <div class="w-full max-w-md space-y-8">
      <div class="rounded-md border p-5 bg-white shadow-sm">
        <div class="mt-6 text-center text-4xl font-bold tracking-tight">Đăng ký</div>
        <a-form class="mt-9 space-y-6" id="form" :model="formState" @submit="onSubmit">
          <div class="bg-red-100 py-3 px-2.5 flex items-center border border-red-400"
            v-bind:class="error == true ? 'flex' : 'hidden'">
            <Icon icon="material-symbols:error-rounded" class="text-xl text-orange-600" />
            <p class="ml-2">Đăng ký không thành công !</p>
          </div>
          <div class="-space-y-px rounded-md">
            <div class="form-group">
              <label for="account_id">Tên đăng nhập :</label>
              <input type="text" name="account_id" v-model="formState.account_id"
                class="relative mt-2 block w-full rounded-md border-0 py-3 px-2.5 ring-1 ring-inset ring-gray-300 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-200 sm:text-sm sm:leading-6"
                placeholder="Tên đăng nhập" />
            </div>

            <div class="form-group pt-4">
              <label for="account_id">Email :</label>
              <input type="email" name="email" v-model="formState.email"
                class="relative mt-2 block w-full rounded-md border-0 py-3 px-2.5 ring-1 ring-inset ring-gray-300 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-200 sm:text-sm sm:leading-6"
                placeholder="Email" />
            </div>

            <div class="form-group pt-4">
              <label for="account_id">Mật khẩu:</label>
              <input type="password" name="password" v-model="formState.password"
                class="relative mt-2 block w-full rounded-md border-0 py-3 px-2.5 ring-1 ring-inset ring-gray-300 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-200 sm:text-sm sm:leading-6"
                placeholder="Mật khẩu" />
            </div>

            <div class="form-group pt-4">
              <label for="account_id">Nhập lại mật khẩu:</label>
              <input type="password" name="password_confirmation" v-model="formState.password_confirmation"
                class="relative mt-2 block w-full rounded-md border-0 py-3 px-2.5 ring-1 ring-inset ring-gray-300 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-200 sm:text-sm sm:leading-6"
                placeholder="Nhập lại mật khẩu" />
            </div>

            <div class="pt-4">
              <button type="submit"
                class="group relative flex w-full justify-center rounded-md py-3.5 px-3 text-sm text-white font-semibold bg-blue-500 hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-blue-500">
                Đăng ký
              </button>
            </div>

            <div class="py-4 px-3 grid grid-cols-3 items-center text-gray-400">
              <hr class="border-gray-400" />
              <p class="text-center">OR</p>
              <hr class="border-gray-400" />
            </div>

            <div class="pb-5">
              <button type="submit"
                class="group relative flex w-full justify-center rounded-md py-3.5 px-3 text-sm text-white font-semibold bg-blue-700 hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-blue-700">
                <Icon icon="ant-design:facebook-filled" class="text-2xl mr-2 rounded-md" />
                <span class="pt-0.5">Đăng ký bằng Facebook</span>
              </button>
            </div>

            <div class="w-full flex items-center justify-center">
              <p class="text-sm font-normal text-gray-500">Đã có tài khoản?</p>
              <router-link :to="{ name: 'login' }"
                class="font-semibold underline underline-offset-2 cursor-pointer px-1">Đăng nhập ở đây!</router-link>
            </div>
          </div>
        </a-form>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue'
import { ref, reactive } from 'vue'
import { authStore } from '@/stores/auth.js';
import { useRouter } from 'vue-router'
export default {
  components: {
    Icon
  },

  setup(props) {
    var error = ref(false);

    const auth = authStore();
    const router = useRouter()

    const formState = reactive({
      account_id: '',
      email: '',
      password: '',
      password_confirmation: '',
    })

    const onSubmit = async () => {
      try {
        await Promise.all([auth.register(formState.account_id, formState.email, formState.password, formState.password_confirmation)]);
        router.push({ name: 'homepage' })
        error.value = false;
      } catch (e) {
        error.value = true;
        console.log(e);
      }
    }

    return {
      error,
      formState,
      onSubmit,
    }
  }
}
</script>

<style scoped></style>
