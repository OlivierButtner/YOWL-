<template>
  <div class="Admin_Navbar">
    <router-link
      class="routerlinkAdminNavbarImgCSS"
      :to="{ name: 'AdminPage' }"
    >
      <img src="../assets/AdminPage.png" alt="AdminPage" id="AdminPageImg" />
    </router-link>
    <router-link class="routerlinkAdminNavbarCSS" :to="{ name: 'AdminUsers' }">
      <p>Users</p>
    </router-link>
    <router-link
      class="routerlinkAdminNavbarCSS"
      :to="{ name: 'AdminArticles' }"
    >
      <p>Articles</p>
    </router-link>
    <router-link
      class="routerlinkAdminNavbarCSS"
      :to="{ name: 'AdminComments' }"
    >
      <p>Comments</p>
    </router-link>
    <router-link
      class="routerlinkAdminNavbarCSS"
      :to="{ name: 'AdminCategories' }"
    >
      <p>Categories</p>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "Admin_Navbar",
};
</script>

<style scoped>
#AdminPageImg {
  margin-top: 30px;
  margin-bottom: 30px;
  width: 50px;
  height: 50px;
}

.routerlinkAdminNavbarImgCSS {
  border-top: 2px solid whitesmoke;
  border-bottom: 2px solid whitesmoke;
}

.routerlinkAdminNavbarCSS {
  display: flex;
  padding-top: 30px;
  padding-bottom: 30px;
  width: auto;
  height: 50px;
  justify-content: center;
  align-items: center;
  border-bottom: 2px solid whitesmoke;
  border-radius: 3px;
  text-decoration: none;
  color: whitesmoke;
  font-family: "Roboto Light", sans-serif;
  font-weight: bold;
}
</style>
