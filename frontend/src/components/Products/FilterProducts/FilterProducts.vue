<template>
  <div class="my-[30px] md:my-[75px]">
    <div class="max-w-[calc(100%-20px)] my-0 mx-auto grid md:max-w-7xl">
      <div class="prorduct-view px-2 py-1">
        <div class="sort-filter mb-5">
          <div class="bg-[#00000008]">
            <div class="flex flex-wrap px-5 py-4 items-center justify-between">
              <div class="flex items-center gap-2.5 flex-wrap">
                <p>Sắp xếp theo</p>

                <Button class="bg-white !p-2">Phổ biến</Button>
                <Button class="bg-white !p-2">Mới nhất</Button>
                <Button class="bg-white !p-2">Bán chạy</Button>
                <a-dropdown>
                  <div class="ant-dropdown-link flex gap-24 items-center bg-white p-2" @click.prevent>Giá
                    <Icon icon="octicon:chevron-down-24" />
                  </div>
                  <template #overlay>
                    <a-menu>
                      <a-menu-item>
                        <a href="javascript:;">Giá: Từ thấp đến cao</a>
                      </a-menu-item>
                      <a-menu-item>
                        <a href="javascript:;">Giá: Từ cao đến thấp</a>
                      </a-menu-item>
                    </a-menu>
                  </template>
                </a-dropdown>
              </div>

              <div class="items-center hidden md:flex">
                <span>{{productList.from}} - {{ productList.to }} of {{ productList.total }}</span>

                <div class="flex gap-2.5 ml-3">
                  <Button class="hover:bg-white text-black border-[1px]">
                    <Icon icon="octicon:chevron-left-24" />
                  </Button>
                  <Button class="hover:bg-white text-black border-[1px]">
                    <Icon icon="octicon:chevron-right-24" />
                  </Button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="main-product-list">
          <Products :products="products" :off-heading="true" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Products from '../Products.vue'
import { defineProps } from 'vue'
import { Icon } from '@iconify/vue';
import Button from '@/components/Button.vue'
const props = defineProps({
  products: Object,
  productList: Object,
})
</script>

<style scoped></style>