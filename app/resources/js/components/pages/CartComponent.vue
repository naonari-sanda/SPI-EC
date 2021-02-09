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
            <div v-if="cart in carts" class="mycart_box">
              {{ cart.stock.name }} <br />
              個数：{{ cart.qty }}個 <br />
              {{ cart.fee }}円 <br />
              <img
                :src="`/uploads/${cart.stock.imgpath}`"
                alt=""
                class="incart"
              />
              <br />
              <a href="">商品の編集</a>

              <input type="hidden" name="delete" value="delete" />
              <input type="hidden" name="user_id" :value="auth.id" />
              <input type="hidden" name="stock_id" :value="cart.stock.id" />
              <input
                type="submit"
                class="btn btn-primary btn-sm text-center delete-btn"
                value=" カートから削除する"
              />
            </div>

            <div class="text-center p-2">
              個数：個 <br />
              <p style="font-size: 1.2em; font-weight: bold">合計：</p>
            </div>
            <button
              type="submit"
              class="btn btn-danger btn-lg text-center buy-btn"
            >
              購入する
            </button>

            <p class="text-center">カートは空っぽです</p>

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
    };
  },
  props: {
    auth: {
      type: Object | Array,
    },
  },
  methods: {
    getCarts() {
      axios.get("/api/mycart").then((res) => {
        this.data = res.data;
      });
    },
  },
  mounted() {
    this.getCarts();
  },
};
</script>