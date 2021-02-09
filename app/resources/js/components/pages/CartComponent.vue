<template>
  <div class="container-fluid">
    <div class="">
      <div class="mx-auto" style="max-width: 1200px">
        <h1
          class="text-center font-weight-bold"
          style="color: #555555; font-size: 1.2em; padding: 24px 0px"
        >
          {{ auth.name }}さんのカートの中身
        </h1>

        <div class="card-body">
          <!-- <p class="text-center">{{ $message ?? "" }}</p> -->
          <br />
          <div class="flex-row flex-wrap">
            <!-- @if($my_carts->isNotEmpty()) @foreach($my_carts as $my_cart) -->
            <div v-if="data.my_carts != ''">
              <div
                v-for="(cart, index) in data.my_carts"
                :key="index"
                class="mycart_box"
              >
                {{ cart.stock.name }}
                <br />
                個数：{{ cart.qty }}個
                <br />
                {{ cart.stock.fee }}円
                <br />
                <img
                  :src="`/uploads/${cart.stock.imgpath}`"
                  alt=""
                  class="incart"
                />
                <br />

                <router-link
                  :to="{ name: 'detail', params: { stockId: cart.stock_id } }"
                >
                  <a class="d-block mb-3" href="">商品の詳細画面</a>
                </router-link>

                <button
                  @click="deleteCart(cart.stock.id)"
                  class="btn btn-primary btn-sm text-center delete-btn"
                >
                  カートから削除する"
                </button>
              </div>

              <div
                class="text-center p-2"
                style="font-size: 1em; font-weight: bold"
              >
                個数：{{ data.count }}個 <br />
                <p style="font-size: 1.2em; font-weight: bold">
                  合計：{{ data.sum }} 円
                </p>
              </div>
              <button
                type="submit"
                class="btn btn-danger btn-lg text-center buy-btn"
              >
                購入する
              </button>
            </div>
            <div v-else>
              <p class="text-center">カートは空っぽです</p>
            </div>

            <a href="/">商品一覧へ</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {},
      id: 1,
    };
  },
  props: {
    auth: {
      type: Object | Array,
    },
    userId: {
      type: String | Number,
    },
  },
  methods: {
    getCarts() {
      axios.get("/api/mycart/" + this.userId).then((res) => {
        this.data = res.data;
      });
    },
    deleteCart(id) {
      var data = {
        user_id: this.auth.id,
        stock_id: id,
      };
      axios
        .post("/api/deletecart/", data)
        .then((res) => {
          this.getCarts();
        })
        .catch((error) => {
          alert("失敗");
          console.log(error.res);
        });
    },
  },
  mounted() {
    this.getCarts();
  },
};
</script>