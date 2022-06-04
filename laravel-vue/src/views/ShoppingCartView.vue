<template>
  <div class="shoppingcart">
    <HeaderView />

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
              <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
              <span>Shopping Cart</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-12">
                <div class="cart-table">
                  <table>
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th class="p-name text-center">Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody v-if="shoppingCart.length > 0">
                      <tr v-for="cart in shoppingCart" :key="cart.id">
                        <td class="cart-pic first-row">
                          <img :src="cart.photo" class="item-pic"/>
                        </td>
                        <td class="cart-title first-row text-center">
                          <h5>{{ cart.name }}</h5>
                        </td>
                        <td class="p-price first-row">${{ cart.price }}</td>
                        <td
                          class="delete-item"
                          @click="removeItem(shoppingCart.index)"
                        >
                          <a href="#"><i class="material-icons"> close </i></a>
                        </td>
                      </tr>
                    </tbody>

                    <tbody v-else>
                      <tr>
                        <td>
                          <h5>
                            <i class="material-icons"> shopping_cart </i>
                            Your shopping cart is empty
                          </h5>
                        </td>
                      </tr>
                    </tbody>

                  </table>
                </div>
              </div>
              <div class="col-lg-8">
                <h4 class="mb-4">Informasi Pembeli:</h4>
                <div class="user-checkout">
                  <form>
                    <div class="form-group">
                      <label for="namaLengkap">Nama lengkap</label>
                      <input
                        type="text"
                        class="form-control"
                        id="namaLengkap"
                        aria-describedby="namaHelp"
                        placeholder="Masukan Nama"
                        v-model="customerInfo.name"
                      />
                    </div>
                    <div class="form-group">
                      <label for="namaLengkap">Email Address</label>
                      <input
                        type="email"
                        class="form-control"
                        id="emailAddress"
                        aria-describedby="emailHelp"
                        placeholder="Masukan Email"
                        v-model="customerInfo.email"
                      />
                    </div>
                    <div class="form-group">
                      <label for="namaLengkap">No. HP</label>
                      <input
                        type="text"
                        class="form-control"
                        id="noHP"
                        aria-describedby="noHPHelp"
                        placeholder="Masukan No. HP"
                        v-model="customerInfo.phone"
                      />
                    </div>
                    <div class="form-group">
                      <label for="alamatLengkap">Alamat Lengkap</label>
                      <textarea
                        class="form-control"
                        id="alamatLengkap"
                        rows="3"
                        placeholder="Masukan Alamat Lengkap"
                        v-model="customerInfo.address"
                      ></textarea>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="proceed-checkout">
                  <ul>
                    <li class="subtotal">
                      ID Transaction <span>#SH12000</span>
                    </li>
                    <li class="subtotal mt-3">Subtotal <span>${{ totalPrice }}.00</span></li>
                    <li class="subtotal mt-3">Pajak (10%) <span>${{ totalTax }}.00</span></li>
                    <li class="subtotal mt-3">
                      Total Biaya <span>${{ totalAmount }}.00</span>
                    </li>
                    <li class="subtotal mt-3">
                      Bank Transfer <span>Mandiri</span>
                    </li>
                    <li class="subtotal mt-3">
                      No. Rekening <span>2208 1996 1403</span>
                    </li>
                    <li class="subtotal mt-3">
                      Nama Penerima <span>Shayna</span>
                    </li>
                  </ul>
                  <a href="#" class="proceed-btn" @click="checkOut()"
                    >I ALREADY PAID</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section End -->
  </div>
</template>

<script>
import HeaderView from "@/components/HeaderView.vue";
import axios from "axios";

export default {
  name: "ShopingCartView",
  components: {
    HeaderView,
  },
  data() {
    return {
      shoppingCart: [],
      customerInfo: {
        name: "",
        email: "",
        phone: "",
        address: "",
      },
    };
  },
  methods: {
    removeItem(index) {
      this.shoppingCart.splice(index, 1);
      const parsed = JSON.stringify(this.shoppingCart);
      localStorage.setItem("shoppingCart", parsed);
      location.reload();
    },
    checkOut() {
      let productIds = this.shoppingCart.map(function(product){
        return product.id;
      });

      let checkoutData = {
        'name': this.customerInfo.name,
        'email': this.customerInfo.email,
        'number': this.customerInfo.phone,
        'address': this.customerInfo.address,
        'transaction_total': this.totalAmount,
        'transaction_status': 'PENDING',
        'transaction_details': productIds
      };

      axios
        .post(
          "http://shayna-backend.belajarkoding.com/api/checkout",
          checkoutData
        )
        .then(() => this.$router.push("success"))
        //eslint-disable-next-line no-console
        .catch(err => console.log(err));
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
    },
    totalTax() {
      return this.totalPrice / 10;
    },
    totalAmount() {
      return this.totalPrice + this.totalTax;
    },
  }
};
</script>

<style scoped>
.item-pic {
  width: 128.3px;
  height: 85.53px;
}
</style>