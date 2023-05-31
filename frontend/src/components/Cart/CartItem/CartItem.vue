<template>
  <div>
    <div class="product mb-8">
      <div class="row flex item-center">
        <div class="col-1 w-[398px] px-[15px]">
          <div class="image flex">
            <a-checkbox v-model:checked="checked" class="relative top-8"></a-checkbox>
            <div>
              <img
                src="https://salt.tikicdn.com/cache/w78/media/catalog/producttmp/b9/b0/cf/c7e8e18f606f3db4bef450cfacb53532.jpg.webp"
                alt="">
            </div>

            <div class="w-[calc(100%-100px)] pl-2">
              <a href="">ProductName</a>
              <p>Giao Siêu Tốc</p>
            </div>
          </div>
        </div>
        <div class="col-2 w-[200px] flex items-center">
          <p class="m-0 p-0 font-bold"><span>480.000 ₫</span></p>
        </div>
        <div class="col-3 w-[150px] flex items-center justify-start">
          <button class="border-[1px] py-2 px-1.5 border-[rgba(0,0,0,.09)]" @click="minusQuantity">
            <Icon icon="humbleicons:minus" />
          </button>
          <a-input v-model:value="quantityNum" placeholder="1"
            class="w-[35px] border-[1px] border-[rgba(0,0,0,.09)] text-center" />
          <button class="border-[1px] py-2 px-1.5 border-[rgba(0,0,0,.09)]" @click="plusQuantity">
            <Icon icon="octicon:plus-24" />
          </button>
        </div>
        <div class="col-4 w-[150px] flex items-center">
          <p class="m-0 p-0 font-bold text-red-600"><span>480.000 ₫</span></p>
        </div>
        <div class="col-5 w-[30px] flex items-center">
          <Icon icon="system-uicons:trash" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue';

export default {
  components: {
    Icon
  },
}
</script>

<style scoped></style>