<template>
  <div class="product">
    <HeaderView />

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
              <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
              <span>Detail</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="product-pic-zoom">
                  <img class="product-big-img" :src="gambar_default" alt="" />
                </div>
                <div
                  class="product-thumbs"
                  v-if="productDetails.galleries.length > 0"
                >
                  <carousel
                    class="product-thumbs-track ps-slider"
                    :dots="false"
                    :nav="false"
                  >
                    <div
                      v-for="ss in productDetails.galleries"
                      :key="ss.id"
                      class="pt"
                      @click="changeImage(ss.photo)"
                      :class="ss.photo == gambar_default ? 'active' : ''"
                    >
                      <img :src="ss.photo" alt="" />
                    </div>
                  </carousel>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="product-details">
                  <div class="pd-title">
                    <span>{{ productDetails.type }}</span>
                    <h3>{{ productDetails.name }}</h3>
                  </div>
                  <div class="pd-desc">
                    <p v-html="productDetails.description"></p>
                    <h4>${{ productDetails.price }}</h4>
                  </div>
                  <div class="quantity">
                    <a
                      href="#"
                      class="primary-btn pd-cart"
                      @click="
                        saveShoppingCart(
                          productDetails.id,
                          productDetails.name,
                          productDetails.price,
                          productDetails.galleries[0].photo
                        )
                      "
                      >Add To Cart</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Shop Section End -->

    <RelatedProduct />

    <FooterView />
  </div>
</template>

<script>
import carousel from "vue-owl-carousel";
import axios from "axios";

import HeaderView from "@/components/HeaderView.vue";
import RelatedProduct from "@/components/RelatedProduct.vue";
import FooterView from "@/components/FooterView.vue";

export default {
  name: "ProductView",
  components: {
    HeaderView,
    RelatedProduct,
    FooterView,
    carousel,
  },
  data: function () {
    return {
      gambar_default: "",
      productDetails: [],
      shoppingCart: [],
    };
  },
  methods: {
    changeImage(urlImage) {
      this.gambar_default = urlImage;
      // eslint-disable-next-line no-console
      console.log(this.productDetails.galleries.length);
    },
    setDataPicture(data) {
      // replace object productDetails with data from API
      this.productDetails = data;
      // replace value default picture with data from API (galleries)
      this.gambar_default = data.galleries[0].photo;
    },
    saveShoppingCart(idProduct, nameProduct, priceProduct, photoProduct) {
      var productStored = {
        id: idProduct,
        name: nameProduct,
        price: priceProduct,
        photo: photoProduct,
      };

      this.shoppingCart.push(productStored);
      const parsed = JSON.stringify(this.shoppingCart);
      localStorage.setItem("shoppingCart", parsed);
      location.reload();
      
    },
  },
  mounted() {
    if (localStorage.getItem("shoppingCart")) {
      try {
        this.shoppingCart = JSON.parse(localStorage.getItem("shoppingCart"));
      } catch (e) {
        localStorage.removeItem("shoppingCart");
      }
    }
    axios
        .get("http://127.0.0.1:8000/api/products", {
      // .get("http://shayna-backend.belajarkoding.com/api/products", {
        params: {
          id: this.$route.params.id,
        },
      })
      .then((res) => this.setDataPicture(res.data.data))
      .catch((err) => console.log(err));
  },
};
</script>


<style scoped>
.product-thumbs .pt {
  margin-right: 14px;
}
</style>