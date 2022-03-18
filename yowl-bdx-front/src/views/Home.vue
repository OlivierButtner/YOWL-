<template>
  <HeaderNavbar />
  <CategoryNavbar />
  <nav id="category"></nav>
  <p id="slogan">Most Popular Articles!</p>
  <section>
    <div id="ArticleDetails">
      <div v-for="article in articles" :key="article.id">
        <router-link
          :to="{ name: 'ArticleDetails', params: { id: article.id } }"
          class="lien"
          ><ArticleDetails v-bind:article="article"
        /></router-link>
      </div>
    </div>
  </section>
  <footer></footer>
</template>

<script>
import ArticleDetails from "../components/ArticleDetails";
import CategoryNavbar from "@/components/CategoryNavbar";
import HeaderNavbar from "@/components/HeaderNavbar";

export default {
  name: "Home",
  components: { ArticleDetails, CategoryNavbar, HeaderNavbar },
  props: ["id", "image", "title", "url", "descritpion"],

  computed: {
    articles() {
      return this.$store.state.articles;
    },
    categories() {
      return this.$store.state.categories;
    },
    users() {
      return this.$store.state.users;
    },
  },
  mounted() {
    this.$store.dispatch("getAllArticles");
    this.$store.dispatch("getAllUsers");
  },
};
</script>

<style>
#slogan {
  font-size:30px;
  color: #241E1E;
  text-align: center;
  font-weight: bold;
  padding:10px;
  margin-top: 20px;
}
#ArticleDetails {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 50px;
  padding: 15px;
  margin-right: 20px;
  margin-left: 20px;
}
</style>
