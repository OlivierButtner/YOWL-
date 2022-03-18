<template>
  <div class="content">
    <div class="gaucheL"></div>
    <form @submit.prevent="formLogin" novalidate="true" class="formulaire">
      <router-link class="logo" to="/">YOWL</router-link>
      <div class="titre">
        <p>Welcome back</p>
        <h1>Login to your account</h1>
      </div>

      <div>
        <div class="loginInput" for="email">Email</div>
        <input type="email" v-model="email" />
      </div>
      <div>
        <div class="loginInput" for="password">Password</div>
        <input type="password" v-model="password" />
      </div>

  
      <input type="submit" value="Login now" />
      <router-link class="register" to="/Register"
        >Create a User Account</router-link
      >
      <div v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>
    </form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "Login",
  data() {
    return {
      errors: [],
      email: "",
      password: "",
      pick: "",
    };
  },
  methods: {
    ...mapActions(["login"]),
    formLogin(e) {
      e.preventDefault();
      console.log("ici");
      this.errors = [];

      if (!this.email) {
        this.errors.push("Email required.");
      } else if (!this.validEmail(this.email)) {
        this.errors.push("Valid email required.");
      }
      if (!this.password) {
        this.errors.push("password required.");
      }

      if (!this.errors.length) {
        let user = {
          email: this.email,
          password: this.password,
        };

        this.login(user)
          .then(() => {
            alert("Login Success");
            this.$router.push("/");
          })
          .catch((err) => alert(err + "Email or password wrong!! Try again"));

        return true;
      }
    },
    validEmail: function (email) {
      var re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
  },
};
</script>

<style>
.logo {
  font-size: 48px;
  color: #2b78d2;
  text-decoration: none;
  font-weight: bold;
  margin-bottom: 50px;
  border: solid #2b78d2 1px;
  border-radius: 30px;
}
</style>
