<template>
  <div class="container-fluid">
    <div class="mx-auto" style="max-width: 1200px">
      <h1
        style="
          color: #555555;
          text-align: center;
          font-size: 1.2em;
          padding: 24px 0px;
          font-weight: bold;
        "
      >
        商品一覧
      </h1>
      <div class="">
        <div class="d-flex flex-row flex-wrap">
          <div
            v-for="stock in stocks"
            :key="stock.id"
            class="col-xs-6 col-sm-4 col-md-4"
          >
            <div class="mycart_box">
              {{ stock.name }}<br />
              {{ stock.fee }}円
              <img :src="`/uploads/${stock.imgpath}`" alt="" class="incart" />
              <br />
              {{ stock.detail }} <br />

              <router-link
                :to="{ name: 'detail', params: { stockId: stock.id } }"
                >詳細はこちら</router-link
              >
            </div>
          </div>
        </div>
        <div class="text-center" style="width: 200px; margin: 20px auto"></div>
      </div>
    </div>
    <notifications />
  </div>
</template>

<script>
const referrer = document.referrer;
if (referrer.indexOf("/login") !== -1) {
  this.displayNotification("ログインしました", "info");
  this.resetReferrer();
} else if (referrer.indexOf("/register") !== -1) {
  this.displayNotification("会員登録しました", "success");
  this.resetReferrer();
}
export default {
  data() {
    return {
      stocks: {},
    };
  },
  methods: {
    getStocks() {
      axios.get("/api").then((res) => {
        this.stocks = res.data;
      });
    },
    resetReferrer() {
      Object.defineProperty(document, "referrer", {
        value: location.href,
      });
    },
    displayNotification(text, type) {
      this.$notify({
        title: "お知らせ",
        text: text,
        type: type,
      });
    },
  },
  mounted() {
    this.getStocks();
  },
};
</script>