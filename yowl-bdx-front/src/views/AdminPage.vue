<template>
  <HeaderNavbar />
  <div>
    <div class="contener_dashboard">
      <div class="AdminNavBarGridCSS">
        <Admin_Navbar />
      </div>
      <div class="Admin_Dashboard">
        <h3>Comments by Days</h3>
        <column-chart :data="countCommentsByDays"></column-chart>

        <h3>Comments by Users</h3>
        <pie-chart :data="countCommentsByUser"></pie-chart>

        <h3>Articles by Days</h3>
        <column-chart :data="countArticlesByDays"></column-chart>

        <h3>Articles by Categories</h3>
        <pie-chart :data="countArticlesByCategory"></pie-chart>

        <h3>Users by Days</h3>
        <column-chart :data="countUsersByDays"></column-chart>
      </div>
    </div>
  </div>
</template>

<script>
import Admin_Navbar from "../components/Admin_Navbar";
import HeaderNavbar from "../components/HeaderNavbar";

// import {mapActions} from "vuex";

export default {
  name: "AdminPage.vue",
  components: { HeaderNavbar, Admin_Navbar },

  computed: {
    countCommentsByUser() {
      return this.$store.state.countCommentsByUser;
    },
    countCommentsByDays() {
      return this.$store.state.countCommentsByDays;
    },
    countArticlesByCategory() {
      return this.$store.state.countArticlesByCategory;
    },
    countUsersByDays() {
      return this.$store.state.countUsersByDays;
    },
    countArticlesByDays() {
      return this.$store.state.countArticlesByDays;
    },
  },
  mounted() {
    this.$store.dispatch("getCountCommentsByUser");
    this.$store.dispatch("getCountCommentsByDays");
    this.$store.dispatch("getCountArticlesByCategory");
    this.$store.dispatch("getCountUsersByDays");
    this.$store.dispatch("getCountArticlesByDays");
  },
};
</script>

<style scoped>
.contener_dashboard {
  display: grid;
  min-height: 100vh;
  height: available;
  grid-template-columns: 150px 1fr;
}

.Admin_Dashboard {
  display: flex;
  flex-direction: column;
  height: auto;
  width: 90%;
  justify-self: center;
}

h3 {
  border-top: solid black 1px;
  margin-top: 30px;
  padding-top: 10px;
}

</style>
