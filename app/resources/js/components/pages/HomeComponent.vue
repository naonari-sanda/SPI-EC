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
          <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="mycart_box">
              商品名<br />
              値段円
              <img src="" alt="" class="incart" />
              <br />
              詳細が入ります <br />

              <router-link :to="{ name: 'detail' }">詳細はこちら</router-link>
            </div>
          </div>
        </div>
        <div class="text-center" style="width: 200px; margin: 20px auto"></div>
      </div>
    </div>
  </div>
</template>