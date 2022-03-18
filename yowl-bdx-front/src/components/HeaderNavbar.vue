<template>
  <header>
    <router-link class="YOWLRedirect" to="/">YOWL</router-link>
    <div class="slogan">YOWL is a network of communities where people can dive into their interests, hobbies and passions!</div>
    <div v-if="this.$store.state.isAdmin === true">
      <router-link class="AdminRedirect" to="/AdminPage">Admin</router-link>
    </div>
    <div class="LoginRegisterBlock">
      <div v-if="!this.$store.state.token">
        <div>
        <router-link id="login" to="/Login">LOGIN</router-link>
        </div>
        <div>
        <router-link id="Register" to="/Register">Register</router-link>
        </div>
      </div>
      <div class="NavBarUser" v-if="this.$store.state.token">
        <ul>
          <li>
            <router-link to="/MyProfile" class="NavUser">
              My Profile</router-link
            >
          </li>
          <li>
            <router-link to="/MyArticles" class="NavUser">
              My Articles</router-link
            >
          </li>
          <li>
            <router-link to="/MyComments" class="NavUser">
              My Comments</router-link
            >
          </li>
          <li>
            <router-link to="/" @click="deco" class="NavUserLOGOUT"
              >LOGOUT</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "HeaderNavbar.vue",
  methods: {
    ...mapActions(["logout"]),
    deco() {
      if (this.$store.state.token) {
        this.logout().then(alert("Logout succes"));
        this.$router.push('/')
        }

    }
  }
}

</script>

<style>

.YOWLRedirect {
  display: flex;
  margin-right: auto;
  font-size: 48px;
  color: white;
  text-decoration: none;
}
.AdminRedirect {
  display: flex;
  text-align: right;
  font-size: 48px;
  color: white;
  text-decoration: none;
  margin-left: 300px;
}

.Login-Register {
  display: flex;
  margin-left: auto;

}
</style>
