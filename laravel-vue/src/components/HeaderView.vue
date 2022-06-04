<template>
  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="header-top">
      <div class="container">
        <div class="ht-left">
          <div class="mail-service">
            <i class="fa fa-envelope"></i> hello.shayna@gmail.com
          </div>
          <div class="phone-service">
            <i class="fa fa-phone"></i> +628 22081996
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="inner-header">
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <div class="logo">
              <a href="./index.html">
                <img src="img/logo_website_shayna.png" alt="" />
              </a>
            </div>
          </div>
          <div class="col-lg-7 col-md-7"></div>
          <div class="col-lg-3 text-right col-md-3">
            <ul class="nav-right">
              <li class="cart-icon">
                Keranjang Belanja &nbsp;
                <a href="#">
                  <i class="icon_bag_alt"></i>
                  <span>{{ shoppingCart.length }}</span>
                </a>
                <div class="cart-hover">
                  <div class="select-items">
                    <table>

                      <tbody v-if="shoppingCart.length > 0">

                        <tr v-for="cart in shoppingCart" :key="cart.id">
                          <td class="si-pic">
                            <img :src="cart.photo" alt="" class="photo-item"/>
                          </td>
                          <td class="si-text">
                            <div class="product-selected">
                              <p>${{ cart.price }} x 1</p>
                              <h6>{{ cart.name }}</h6>
                            </div>
                          </td>
                          <td class="si-close" @click="removeItem(shoppingCart.index)">
                            <i class="ti-close"></i>
                          </td>
                        </tr>

                      </tbody>

                      <tbody v-else>
                        <tr>
                          <td>
                            <h5 class="text-center">Empty Cart</h5>
                          </td>
                        </tr>
                      </tbody>

                    </table>
                  </div>
                  <div class="select-total">
                    <span>total:</span>
                    <h5>${{ totalPrice }}.00</h5>
                  </div>
                  <div class="select-button">
                    <router-link to="/shoppingCart" class="primary-btn view-card">VIEW CARD</router-link>
                    <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->
</template>

<script>
export default {
  name: "HeaderView",
  data() {
    return {
      shoppingCart: [],
    };
  },
  methods: {
    removeItem(index) {
      this.shoppingCart.splice(index, 1);
      const parsed = JSON.stringify(this.shoppingCart);
      localStorage.setItem("shoppingCart", parsed);
      location.reload();
    }
  },
  mounted() {
    if (localStorage.getItem("shoppingCart")) {
      try {
        this.shoppingCart = JSON.parse(localStorage.getItem("shoppingCart"));
      } catch (e) {
        localStorage.removeItem("shoppingCart");
      }
    }
  },
  computed: {
    totalPrice() {
      let total = 0;
      this.shoppingCart.forEach(cart => {
        total += cart.price;
      });
      return total;

      // Cara lain buat ngitung total
      // return this.shoppingCart.reduce(function(items, data) => {
      //   return items + data.price;
      // }, 0);
    }
  }
};
</script>

<style scoped>
.photo-item {
  width: 120px;
  height: 80px;
}
</style>