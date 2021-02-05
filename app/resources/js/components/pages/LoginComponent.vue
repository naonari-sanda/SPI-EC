<template>
  <div class="back">
    <div class="wrapper">
      <div class="header">
        <h2>ログイン</h2>
      </div>
      <hr />
      <div v-if="Object.keys(errors).length > 0">
        <ul class="alert alert-danger text-center">
          <template v-for="(message, key) in errors">
            <li
              v-for="(value, i) in message"
              :key="key + i"
              style="list-style: none"
            >
              {{ value }}
            </li>
          </template>
        </ul>
      </div>
      <ValidationObserver
        @submit.prevent="login()"
        ref="observer"
        tag="form"
        v-slot="{ invalid }"
      >
        <div class="fill">
          <validation-provider
            name="メールアドレス"
            rules="required|email"
            v-slot="{ errors }"
          >
            <input
              id="email"
              type="email"
              class="form-control"
              name="email"
              v-model="email"
              placeholder="メールアドレス"
              autocomplete="email"
            />
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill">
          <validation-provider
            name="パスワード"
            rules="required"
            v-slot="{ errors }"
          >
            <input
              id="password"
              type="password"
              class="form-control"
              name="password"
              placeholder="パスワード"
              v-model="password"
              autocomplete="current-password"
            />

            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill mb-3">
          <input
            class="check"
            type="checkbox"
            name="remember"
            v-model="remember"
          />

          <label class="label" for="remember">
            ログインを継続させますか？
          </label>
        </div>

        <div class="button mb-3">
          <button :disabled="invalid" type="submit" class="btn btn-primary">
            ログイン
          </button>
        </div>
      </ValidationObserver>
      <a class="forget btn-link text-center" href="/password/reset">
        パスワードをお忘れですか？
      </a>
      <a class="forget btn-link text-center" @click="easyLogin">
        簡単ログイン
      </a>

      <div class="else d-flex">
        <div class="line"></div>
        <div class="text">または</div>
        <div class="line"></div>
      </div>
      <div class="button">
        <a href="/register" class="btn btn-success">ユーザー登録</a>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import { required, email } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "{_field_}は必須です",
});

extend("email", {
  ...email,
  message: "{_field_}は必須です",
});

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      email: "",
      password: "",
      remember: false,
      errors: [],
      success: false,
    };
  },
  methods: {
    async login() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        axios
          .post("/login", {
            email: this.email,
            password: this.password,
            remember: this.remember,
          })
          .then((response) => {
            window.location.href = "/";
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
            this.success = false;
          });
      }
    },

    async easyLogin() {
      axios
        .post("/login", {
          email: "test@icloud.com",
          password: "wqwqwqwq",
          remember: this.remember,
        })
        .then((response) => {
          window.location.href = "/";
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.success = false;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.back {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #fafafa;

  .wrapper {
    margin: 60px 0 100px;
    position: relative;
    top: -20%;
    max-width: 340px;
    width: 100%;
    border: 1px solid #dbdbdb;
    background-color: #fff;
    padding: 20px 30px;

    h2 {
      font-size: 18px;
      font-weight: bold;
    }

    hr {
      margin-bottom: 30px;
    }

    .fill {
      margin-bottom: 12px;
    }

    input {
      background-color: #fafafa;
    }

    .button {
      .btn {
        width: 100%;
      }

      .btn-success {
        width: 100%;
      }
    }

    .forget {
      display: block;
      margin: 0 auto;
    }

    .else {
      margin: 18px 0;
      justify-content: center;
      align-items: center;

      .line {
        background-color: #dbdbdb;
        height: 1px;
        width: 40%;
      }

      .text {
        font-size: 13px;
        margin: 0 10px;
        white-space: nowrap;
      }
    }
  }
  .alert {
    padding: 0.5rem 1.25rem;
  }
}

@media screen and (max-width: 767px) {
  /*　画面サイズが767px以下の場合読み込む　*/
  .back {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fafafa;

    .wrapper {
      margin: 0;
      max-width: 100%;
    }
  }
}
</style>