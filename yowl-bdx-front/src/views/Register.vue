<template>
  <div class="content">
    <div class="gaucheD"></div>
    <form @submit="formRegister" novalidate="true" class="formulaire">
      <router-link class="logo" to="/">YOWL</router-link>
      <h1>Sign Up</h1>
      <p>
        <label for="username">Username</label>
        <input type="text" v-model="username" />
      </p>
      <p>
        <label for="email">Email</label>
        <input type="email" v-model="email" />
      </p>
      <p>
        <label for="password">Password</label>
        <input type="password" v-model="password" />
      </p>
      <p>
        <label for="passwordC">Password Confirmation</label>
        <input type="password" v-model="passwordC" />
      </p>
      <p class="titre">
        <input type="checkbox" v-model="pick" /><em
          >By registering, I confirm that I am at least 13 years old.</em
        >
      </p>
      <input type="submit" value="Sign Up" />
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
  name: "Register",
  data() {
    return {
      errors: [],
      username: "",
      email: "",
      password: "",
      passwordC: "",
      pick: "",
    };
  },
  methods: {
    ...mapActions(["register"]),
    formRegister(e) {
      e.preventDefault();
      this.errors = [];

      if (!this.username) {
        this.errors.push("username required.");
      }
      if (!this.email) {
        this.errors.push("Email required.");
      } else if (!this.validEmail(this.email)) {
        this.errors.push("Valid email required.");
      }
      if (!this.password) {
        this.errors.push("password required.");
      } else if (this.password != this.passwordC) {
        this.errors.push("Passwords no Similars");
      }

      if (!this.pick) {
        this.errors.push("Age control required");
      }

      if (!this.errors.length) {
        let user = {
          username: this.username,
          email: this.email,
          password: this.password,
          //password_confirmation :this.password
        };
        this.register(user)
          .then(() => {
            alert("Register Success");
            this.$router.push("/");
          })
          .catch((err) =>
            alert(err + "Email or password already used !! Try again")
          );
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

<style scoped>
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
