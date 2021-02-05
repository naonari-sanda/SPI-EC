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
              {{ stock.name }}
              <br />
              {{ stock.fee }}円
              <img :src="`/uploads/${stock.imgpath}`" alt="" />
              <br />
              <!-- {{ $stock->name}} <br> -->
              <!-- {{ number_format($stock->fee)}}円 <br> -->
              <!-- <img src="{{ asset('/uploads/' . $stock->imgpath) }}" alt="" class="incart"> -->
              <br />
              <p>{{ stock.detail }}</p>
              <!-- <p>{{ $stock->detail }}</p> -->

              <!-- 
                        <form action="{{ route('addcart') }}" method="post"> -->
              <!-- @csrf -->
              <select name="qty" id="qty" class="">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
              <!-- <input type="hidden" name="stock_id" value="{{ $stock->id }}"> -->
              <input
                type="submit"
                value="カートに入れる"
                class="btn btn-danger btn-lg text-center buy-btn form-control @error('name') is-invalid @enderror"
              />
              <!-- @if ($errors->has('$stock_id')) -->
              <span class="invalid-feedback" role="alert">
                <!-- <strong>{{ $errors->first('$stock_id') }}</strong> -->
              </span>
              <!-- @endif -->
              <!-- </form><br> -->
            </div>
            <!-- @endif -->

            <!-- <a href="{{ route('main') }}">商品一覧へ</a> -->
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
    };
  },
  props: {
    stockId: {
      type: String | Number,
    },
  },
  methods: {
    getStock() {
      axios.get("/api/detail/" + this.stockId).then((res) => {
        this.stock = res.data;
      });
    },
  },
  mounted() {
    this.getStock();
  },
};
</script>