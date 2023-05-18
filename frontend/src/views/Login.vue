<template>
  <div class="flex justify-between items-center">
    <div class="logo">
      <h2 class="w-[118px] h-[36px] font-bold text-3xl cursor-pointer">Nanolabs</h2>
    </div>
    <div>
      <button class="flex justify-center px-3 text-lg font-normal">Đăng ký</button>
    </div>
  </div>
  <div class="flex justify-center content-center mt-10">
    <div class="w-full max-w-md space-y-8">
      <div class="rounded-md">
        <div class="mt-6 text-center text-4xl font-bold tracking-tight">Đăng nhập</div>
        <form class="mt-9 space-y-6" @submit="onSubmit">
          <div class="-space-y-px rounded-md">
            <div class="form-group">
              <label for="account_id">Tên đăng nhập :</label>
              <input
                type="text"
                name="account_id"
                v-model="account_id"
                class="relative mt-2 block w-full rounded-md border-0 py-3 px-2.5 ring-1 ring-inset ring-gray-300 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-200 sm:text-sm sm:leading-6"
                placeholder="Tên đăng nhập"
              />
            </div>

            <div class="form-group pt-4">
              <label for="account_id">Mật khẩu:</label>
              <input
                type="password"
                name="password"
                v-model="password"
                class="relative mt-2 block w-full rounded-md border-0 py-3 px-2.5 ring-1 ring-inset ring-gray-300 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-200 sm:text-sm sm:leading-6"
                placeholder="Mật khẩu"
              />
            </div>

            <div class="flex items-center justify-end pt-4">
              <div class="flex items-center">
                <span class="font-light text-base px-2 cursor-pointer">Quên mật khẩu ?</span>
              </div>
            </div>

            <div class="pt-4">
              <button
                type="submit"
                class="group relative flex w-full justify-center rounded-md py-3.5 px-3 text-sm text-white font-semibold bg-blue-500 hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-blue-500"
              >
                Đăng nhập
              </button>
            </div>

            <div class="py-4 px-3 grid grid-cols-3 items-center text-gray-400">
              <hr class="border-gray-400" />
              <p class="text-center">OR</p>
              <hr class="border-gray-400" />
            </div>

            <div class="pb-5">
              <button
                type="submit"
                class="group relative flex w-full justify-center rounded-md py-3.5 px-3 text-sm text-white font-semibold bg-blue-700 hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-blue-700"
              >
                <Icon icon="ant-design:facebook-filled" class="text-2xl mr-2 rounded-md" />
                <span class="pt-0.5">Đăng nhập bằng Facebook</span>
              </button>
            </div>

            <div class="w-full flex items-center justify-center">
              <p class="text-sm font-normal text-gray-500">Chưa có tài khoản?</p>
              <span class="font-semibold underline underline-offset-2 cursor-pointer px-1"
                >Đăng ký ở đây!</span
              >
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue'
export default {
  components: {
    Icon
  }
}
</script>

<style scoped></style>
