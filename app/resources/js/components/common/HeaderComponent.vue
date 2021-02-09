<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
    <div class="container">
      <router-link :to="{ name: 'home' }">
        <a class="navbar-brand"> SPA Shop </a></router-link
      >

      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto"></ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          <div class="d-flex" v-if="auth.length === 0">
            <li class="nav-item">
              <router-link :to="{ name: 'login' }">
                <a class="nav-link">ログイン</a>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{ name: 'register' }">
                <a class="nav-link">会員登録</a>
              </router-link>
            </li>
          </div>
          <li v-if="auth.length !== 0" class="nav-item dropdown">
            <a
              id="navbarDropdown"
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ auth.name }}<span class="caret"></span>
            </a>

            <div
              class="dropdown-menu dropdown-menu-right"
              aria-labelledby="navbarDropdown"
            >
              <a class="dropdown-item"> ログアウト </a>
              <router-link :to="{ name: 'cart', params: { userId: auth.id } }">
                <a class="dropdown-item"> カートを見る </a>
              </router-link>
              <router-link :to="{ name: 'acount' }"
                ><a class="dropdown-item"> アカウント情報 </a></router-link
              >
            </div>
          </li>
          <router-link
            v-if="auth.length !== 0"
            :to="{ name: 'cart', params: { userId: auth.id } }"
          >
            <img src="uploads/cart.png" class="cart" />
          </router-link>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  props: {
    auth: {
      type: Object | Array,
    },
  },
};
</script>