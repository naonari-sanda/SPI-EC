<template>
  <div class="back">
    <div class="wrapper">
      <div class="header">
        <h2>ユーザー登録</h2>
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
        ref="observer"
        tag="form"
        @submit.prevent="register()"
        v-slot="{ invalid }"
      >
        <div class="fill">
          <validation-provider
            name="アカウント名"
            rules="required|max:20"
            v-slot="{ errors }"
          >
            <input
              id="name"
              type="text"
              class="form-control"
              name="name"
              v-model="name"
              placeholder="アカウント名"
              autocomplete="name"
            />
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

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
              autocomplete=" email"
            />
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill">
          <validation-provider
            name="パスワード"
            rules="required|min:8|confirmed:password_confirmation"
            v-slot="{ errors }"
          >
            <input
              id="password"
              type="password"
              class="form-control"
              name="password"
              v-model="password"
              placeholder="パスワード"
              autocomplete="new-password"
            />
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fil mb-4">
          <validation-provider
            name="パスワード確認"
            rules="required|min:8"
            vid="password_confirmation"
            v-slot="{ errors }"
          >
            <input
              id="password-confirm"
              type="password"
              class="form-control"
              name="password_confirmation"
              v-model="password_confirmation"
              placeholder="確認パスワード"
              autocomplete="new-password"
            />
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="button mb-3">
          <button :disabled="invalid" type="submit" class="btn btn-primary">
            ユーザー登録
          </button>
        </div>
      </ValidationObserver>
      <div class="else d-flex">
        <div class="line"></div>
        <div class="text">または</div>
        <div class="line"></div>
      </div>

      <div class="button">
        <a href="/login" type="submit" class="btn btn-success"> ログイン </a>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import { required, max, min, email, confirmed } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "{_field_}は必須です",
});

extend("email", {
  ...email,
  message: "{_field_}はメールアドレス形式で入力してください",
});

extend("min", {
  ...min,
  message: "{_field_}は最低でも{length}文字入力してくだい",
});

extend("max", {
  ...max,
  message: "{_field_}は最大でも{length}文字までです",
});

extend("confirmed", {
  ...confirmed,
  message: "再確認パスワードと入力が一致していません",
});

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      errors: "",
    };
  },
  methods: {
    async register() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        axios
          .post("/register", {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          })
          .then((response) => {
            location.href = "/";
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
            this.success = false;
          });
      }
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