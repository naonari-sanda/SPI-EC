<template>
  <div class="container-fluid">
    <div class="">
      <div class="mx-auto" style="max-width: 1200px">
        <h1
          class="text-center font-weight-bold"
          style="color: #000; font-size: 1.2em; padding: 24px 0px"
        >
          商品ページ
        </h1>

        <div class="card-body">
          <div class="flex-row flex-wrap">
            <!-- @if(isset( $stock )) -->

            <div class="mycart_box">
              <p>
                {{ stock.name }}
                <br />
                {{ stock.fee }}円
              </p>
              <img :src="`/uploads/${stock.imgpath}`" alt="" />
              <br />
              <!-- {{ $stock->name}} <br> -->
              <!-- {{ number_format($stock->fee)}}円 <br> -->
              <!-- <img src="{{ asset('/uploads/' . $stock->imgpath) }}" alt="" class="incart"> -->
              <br />
              <p>{{ stock.detail }}</p>
              <p>{{ data }}</p>
              <!-- <p>{{ $stock->detail }}</p> -->

              <!-- 
                        <form action="{{ route('addcart') }}" method="post"> -->
              <!-- @csrf -->
              <div v-if="auth.length !== 0">
                <select v-model="qty" name="qty" id="qty" class="">
                  <!-- <option value="" disable>個数</option> -->
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                個
                <!-- <input type="hidden" name="stock_id" value="{{ $stock->id }}"> -->
                <button
                  @click="addCart"
                  class="btn btn-danger btn-lg text-center buy-btn form-control @error('name') is-invalid @enderror"
                >
                  カートに入れる
                </button>
              </div>
              <!-- @if ($errors->has('$stock_id')) -->
              <span class="invalid-feedback" role="alert">
                <!-- <strong>{{ $errors->first('$stock_id') }}</strong> -->
              </span>
            </div>
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
      stock: {},
      qty: "1",
      data: "",
    };
  },
  props: {
    stockId: {
      type: String | Number,
    },
    auth: {
      type: Object | Array,
    },
  },
  methods: {
    getStock() {
      axios.get("/api/detail/" + this.stockId).then((res) => {
        this.stock = res.data;
      });
    },
    addCart() {
      var data = {
        stock_id: this.stockId,
        qty: this.qty,
        user_id: this.auth.id,
      };
      axios
        .post("/api/mycart", {
          stock_id: this.stockId,
          qty: this.qty,
          user_id: this.auth.id,
        })
        .then((res) => {
          this.$router.push({ name: "cart", params: { userId: this.auth.id } });
        })
        .catch((error) => {
          console.log(error.response);
          alert("エラーが発生しました");
        });
    },
  },
  mounted() {
    this.getStock();
  },
};
</script>