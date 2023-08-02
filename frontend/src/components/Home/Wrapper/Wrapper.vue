<template>
  <div class="w-full text-center bg-col-bg px-10 mb-10 rounded-sm">
    <div class="flex flex-col justify-center md:flex-row gap-2.5 md:gap-5">
      <WrapperItem v-for="item in items" :key="item.title" :item="item"/>
    </div>
  </div>
</template>

<script setup>
import WrapperItem from './WrapperItem.vue';

const items = [
  {
    icon: 'mdi:cart-arrow-up',
    title: 'Mua sắm online an toàn và nhanh chóng',
    wrapper: 'Hãy đến với chúng tôi, nơi bạn có thể tìm thấy hàng ngàn sản phẩm đa dạng, chính hãng và được giao nhanh chóng. Chúng tôi luôn có những ưu đãi hấp dẫn và hỗ trợ khách hàng tận tình. Hãy khám phá ngay hôm nay!'
  },
  {
    icon: 'tabler:flag-dollar',
    title: 'Tham gia bán hàng online cùng chúng tôi',
    wrapper: 'Bạn muốn bán được nhiều hàng hơn, tiếp cận được nhiều khách hàng hơn và kiếm được nhiều lợi nhuận hơn? Hãy tham gia cùng chúng tôi, nơi bạn có thể dễ dàng đăng ký, quản lý và phát triển cửa hàng của mình. Chúng tôi cung cấp cho bạn các công cụ hỗ trợ, khuyến mãi và đào tạo để bạn có thể bán hàng thành công!'
  },
  {
    icon: 'circum:delivery-truck',
    title: 'Vận chuyển nhanh cho những sản phẩm mà bạn đã mua sắm',
    wrapper: 'Bạn muốn nhận được những sản phẩm mà bạn đã mua sắm một cách nhanh chóng và an toàn? Hãy tin tưởng vào chúng tôi, nơi bạn có thể được vận chuyển những sản phẩm trong thời gian ngắn nhất và với chi phí thấp nhất. Chúng tôi có những đối tác vận chuyển uy tín, nhanh chóng và chuyên nghiệp. Hãy đặt hàng ngay hôm nay và nhận được những sản phẩm mà bạn yêu thích!'
  },
  {
    icon: 'bi:phone',
    title: 'Sở hữu những sản phẩm công nghệ mới nhất',
    wrapper: 'Bạn là một người yêu công nghệ và muốn sở hữu những sản phẩm công nghệ tiên tiến nhất và tiết kiệm nhất? Hãy truy cập vào chúng tôi, nơi bạn có thể tìm thấy những sản phẩm công nghệ đa dạng, chất lượng và giá trị. Chúng tôi có những sản phẩm từ các hãng công nghệ hàng đầu, các nhà phân phối chuyên nghiệp và các nhà cung cấp tin cậy. Hãy đặt hàng ngay hôm nay và thưởng thức cuộc sống công nghệ!'
  }
];

</script>

<style scoped></style>