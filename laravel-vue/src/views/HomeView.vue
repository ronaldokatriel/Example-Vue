<template>
  <div class="home">

    <HeaderView />

    <CarouselView />

    <ProductSlider />

    <InstagramGallery />

    <PartnerLogo />

    <FooterView />

  </div>
</template>

<script>

import HeaderView from "@/components/HeaderView.vue";
import CarouselView from "@/components/CarouselView.vue";
import ProductSlider from "@/components/ProductSlider.vue";
import InstagramGallery from "@/components/InstagramGallery.vue";
import PartnerLogo from "@/components/PartnerLogo.vue";
import FooterView from "@/components/FooterView.vue";

export default {
  name: "HomeView",
  components: {
    HeaderView,
    CarouselView,
    ProductSlider,
    InstagramGallery,
    PartnerLogo,
    FooterView
  },
};
</script>
