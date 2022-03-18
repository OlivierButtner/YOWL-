<template>
  <HeaderNavbar/>
  <h1 class="MyArticlesTitle">My profile</h1>
  <div  class="EditProfil">
    <form @submit="onSubmitUU" class="updateUserForm">
      <div>
        <label for="username">Username</label>
        <input
          class="InputProfil"
          type="text"
          name="usernameUU"
          v-model="usernameUU"
          minlength="2"
          required
        />
      </div>
      <div>
        <label for="email">Email</label>
        <input
          class="InputProfil"
          type="email"
          name="emailUU"
          v-model="emailUU"
          minlength="2"
          required
        />
      </div>
      <button type="submit" class="ButtonOfUpdateProfil">UPDATE</button>
    </form>
  </div>
</template>

<script>
import HeaderNavbar from "../components/HeaderNavbar";
import { mapActions } from "vuex";

export default {
  name: "MyProfile.vue",
  components: {
    HeaderNavbar,
  },
  data() {
    return {
      usernameUU: this.$store.state.user.username,
      emailUU: this.$store.state.user.email,
    };
  },
  computed: {
    user() {
      return this.$store.state.user;
    },
  },
  mounted() {
    this.$store.dispatch("getAllUsers");
  },
  methods: {
    ...mapActions(["updateUser"]),
    onSubmitUU(e) {
      e.preventDefault();
      const user = {
        username: this.usernameUU,
        email: this.emailUU,
        id: this.$store.state.user.id,
        is_admin: this.$store.state.user.is_admin,
      };
      this.updateUser(user);
      this.$router.push({ name: "MyProfile" });
    },
  },
};
</script>

<style></style>
