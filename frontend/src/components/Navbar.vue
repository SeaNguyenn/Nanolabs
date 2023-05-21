<template>
	<div class="bg-white py-5 px-32 shadow flex justify-between items-center">
    <div class="logo flex items-center">
      <Icon icon="cryptocurrency:nano" class="text-3xl mr-2" />
      <h2 class="w-[118px] h-[36px] font-bold text-3xl cursor-pointer">Nanolabs</h2>
    </div>

    <ul class="flex items-center">
      <li class="px-4" v-for="route in routes">
        <router-link :to="route.path" class="text-xl">{{route.name}}</router-link>
      </li>
    </ul>


	</div>


	<!-- <div class="container bg-white w-full px-32 py-5">
		<nav class="flex items-center">
			<div class="logo flex items-center">
				<Icon icon="cryptocurrency:nano" class="text-3xl mr-2" />
				<h2 class="w-[118px] h-[36px] font-bold text-3xl cursor-pointer">Nanolabs</h2>
			</div>
			<ul class="flex-1 text-center">
				<li class="list-none inline-block px-3"><router-link :to="{ name: '' }" class="second-text-color ">Home</router-link></li>
				<li class="list-none inline-block px-3"><router-link :to="{ name: '' }" class="second-text-color ">Home</router-link></li>
				<li class="list-none inline-block px-3"><router-link :to="{ name: '' }" class="second-text-color ">Home</router-link></li>
				<li class="list-none inline-block px-3"><router-link :to="{ name: '' }" class="second-text-color ">Home</router-link></li>
			</ul>
			<div class="flex items-center justify-between primary-color">
				<div class="flex items-center">
					<Icon icon="basil:user-outline" class="text-2xl mr-2"/>
					<router-link :to="{}" class="text-base mr-2">Đăng nhập</router-link>
					<p class="">/</p>
					<router-link :to="{}" class="text-base ml-2">Đăng ký</router-link>
				</div>
				<div class="flex items-center justify-between ml-2">
					<Icon icon="carbon:search" class="text-2xl mr-2 cursor-pointer"/>
					<div class="flex items-center cursor-pointer">
						<Icon icon="ion:cart-outline" class="text-2xl mr-1"/>
						<span class="text-base">1</span>
					</div>
					<div class="flex items-center cursor-pointer">
						<Icon icon="icon-park-outline:like" class="text-2xl mx-1"/>
						<span class="text-base">1</span>
					</div>
				</div>
			</div>
		</nav>
	</div> -->
</template>

<script>
import { Icon } from '@iconify/vue'
export default {
	components: {
		Icon,
	},

  setup() {
    let routes = [
      {name: 'Trang chủ', path: '#'},
      {name: 'Sản phẩm', path: '#'},
      {name: 'Liên hệ', path: '#'},
      {name: 'home', path: '#'},
    ]

    return {
      routes,
    };
  }
}
</script>

<style scoped></style>