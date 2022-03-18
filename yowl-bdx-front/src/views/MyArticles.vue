<template>
  <HeaderNavbar />
  <CategoryNavbar />
  <h1 class="MyArticlesTitle">Add Article</h1>
  <form @submit="submit" novalidate="true" class="CreateArticle">
    <div>
      <div class="CreateArticleSubTitle" for="url">URL</div>
      <input class="InputCreateArticle" type="text" v-model="Newurl" />
    </div>
    <div>
      <div class="CreateArticleSubTitle" for="description">Description</div>
      <input class="InputCreateArticle" type="text" v-model="Newdescription" />
    </div>
    <select class="MyArticleSelect" v-model="selectedC">
      <option value="" disabled="disabled" selected="selected">
        Select a category
      </option>
      <option
        v-bind:value="category.id"
        :id="category.id"
        v-for="category in categories"
        :key="category.id"
      >
        {{ category.name }}
      </option>
    </select>
    <input class="InputProfil" type="submit" value="CREATE">
  </form>

  <h1 class="MyArticlesTitle">My Article details</h1>
  <div id="ArticleDetails">
    <div v-for="article in myArticles" :key="article.id">
      <router-link
        :to="{ name: 'ArticleDetails', params: { id: article.id } }"
        class="lien"
      ><ArticleDetails v-bind:article="article"
      /></router-link>
    </div>
  </div>
</template>

<script>
import CategoryNavbar from "../components/CategoryNavbar";
import HeaderNavbar from "../components/HeaderNavbar";
import ArticleDetails from "@/components/ArticleDetails";

import { mapActions } from "vuex";

export default {
  name: "Myarticles",
  components: { CategoryNavbar, HeaderNavbar, ArticleDetails },
  props: ["id", "image", "title", "url", "descritpion"],
  data() {
    return {
      articles: null,
      Newurl: "",
      Newdescription: "",
      selectedC: "",
      userid: this.$store.state.user.id,
    };
  },
  computed: {
    myArticles() {
      return this.$store.state.myArticles;
    },
    categories() {
      return this.$store.state.categories;
    },
  },
  methods: {
    ...mapActions(["addArticle"]),
    submit(e) {
      e.preventDefault();
      let article = {
        url: this.Newurl,
        category_id: this.selectedC,
        description: this.Newdescription,
      };
      console.log(this.selectedC);
      this.addArticle(article);
      this.Newurl = "";
      this.Newdescription = "";
      this.selectedC = "";
      this.$router.push("/");
    },
  },

  mounted() {
    this.$store.dispatch("getMyArticles");
  },
};
</script>

<style></style>
