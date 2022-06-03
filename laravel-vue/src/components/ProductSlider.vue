<template>
  <!-- Women Banner Section Begin -->
  <section class="women-banner spad">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12 mt-5" v-if="products.length > 0">
          <carousel
            class="product-slider"
            :items="3"
            :nav="false"
            :autoplay="true"
            :dots="false"
          >
            <div class="product-item" v-for="itemProduct in products" v-bind:key="itemProduct.id">
              <div class="pi-pic">
                <img v-bind:src="itemProduct.galleries[0].photo" alt="" />
                <ul>
                  <li class="w-icon active">
                    <a href="#" @click="saveShoppingCart(itemProduct.id, itemProduct.name, itemProduct.price, itemProduct.galleries[0].photo)"><i class="icon_bag_alt"></i></a>
                  </li>
                  <li class="quick-view">
                    <router-link v-bind:to="'/product/'+itemProduct.id">+ Quick View</router-link>
                  </li>
                </ul>
              </div>
              <div class="pi-text">
                <div class="catagory-name">{{ itemProduct.type }}</div>
                <router-link v-bind:to="'/product/'+itemProduct.id">
                  <h5>{{ itemProduct.name }}</h5>
                </router-link>
                <div class="product-price">
                  ${{ itemProduct.price }}
                  <span @click="changeImage()">$35.00</span>
                </div>
              </div>
            </div>
            
          </carousel>
        </div>

        <div class="col-lg-12 mt-5" v-else>
          <h3 class="text-center">No Products Found</h3>
        </div>

      </div>
    </div>
  </section>
  <!-- Women Banner Section End -->
</template>

<script>
import carousel from "vue-owl-carousel";
import axios from "axios";

export default {
  name: "ProductSlider",
  components: {
    carousel,
  },
  data() {
    return {
      products: [],
      shoppingCart: []
    };
  },
  methods: {
    changeImage() {
      // eslint-disable-next-line no-console
      // console.log(this.products);
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
      
    },
  },
  mounted() {
    axios
      .get("http://shayna-backend.belajarkoding.com/api/products")
      .then((res) => (this.products = res.data.data.data))
      .catch((err) => console.log(err));
  },
};
</script>

<style scoped>
.product-item {
  margin-right: 25px;
}
</style>