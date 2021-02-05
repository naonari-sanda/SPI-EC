<template>
  <div>
    <header-component :auth="auth" />
    <main>
      <router-view :errors="errors" />
    </main>
    <footer-component />
  </div>
</template>

<script>
import HeaderComponent from "../common/HeaderComponent";
import FooterComponent from "../common/FooterComponent";

export default {
  components: {
    HeaderComponent,
    FooterComponent,
  },
  props: {
    errors: {
      type: Object | Array,
    },
    auth: {
      type: Object | Array,
    },
  },
};
</script>