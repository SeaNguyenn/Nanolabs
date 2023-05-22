<template>
  <div class="text-white bg-[url('@/assets/images/bg.png')] bg-center bg-cover">
    <div class="max-w-[800px] flex flex-col text-center mx-auto h-screen w-full justify-center items-center">
      <h1 class="font-bold p-2 text-7xl text-white">Gamepad X360</h1>
      <p>We know how large objects will act, but things on a small scale just do not act that way.</p>
      <div class="w-[100px]">
        <Button>Mua ngay</Button>
      </div>
    </div>
  </div>
</template>

<script>
import Button from '@/components/Button.vue'
export default {
  components: {
    Button,
  },

  return: {

  }
}
</script>

<style scoped></style>