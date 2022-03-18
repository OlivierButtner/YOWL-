<template>
  <HeaderNavbar />
  <div>
    <div class="contener_articlesDetails">
      <div class="AdminNavBarGridCSS">
        <Admin_Navbar />
      </div>
      <div class="Admin_ArticlesDetails">
        <h1 class="AdminTitle">Article details</h1>
        <div class="AdminArticleDetailsForm">
          <form @submit="onSubmitUA" class="updateArticleForm">
            <label class="AdminlabelCSS">Url</label>
            <input
              class="AdminArticleDetailsCSS"
              name="urlUA"
              v-model="urlUA"
              type="url"
              :placeholder="url"
              minlength="2"
              required
            />
            <label class="AdminlabelCSS">Description</label>
            <input
              class="AdminArticleDetailsCSS"
              name="descriptionUA"
              v-model="descriptionUA"
              type="text"
              :placeholder="description"
              required
            />
            <div class="UserButton">
              <button type="submit" class="updateArticleButton">Update</button>
              <button
                type="button"
                class="deleteArticleButton"
                @click="handleDeleteArticle"
              >
                Delete
              </button>
              <router-link
                class="routerlinkArticlesrCSS"
                :to="{ name: 'AdminArticles' }"
              >
                <button type="button" class="returnArticle">Return</button>
              </router-link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Admin_Navbar from "../components/Admin_Navbar";
import HeaderNavbar from "../components/HeaderNavbar";
import { mapActions } from "vuex";

export default {
  name: "AdminArticlesDetails",
  props: ["id", "url", "description"],
  components: { HeaderNavbar, Admin_Navbar },
  data() {
    return {
      urlUA: this.url,
      descriptionUA: this.description,
    };
  },
  computed: {
    articles() {
      return this.$store.state.articles;
    },
  },
  mounted() {
    this.$store.dispatch("getAllArticles");
  },
  methods: {
    ...mapActions(["removeArticle", "updateArticle"]),
    handleDeleteArticle() {
      this.removeArticle(this.id);
      this.$router.push({ name: "AdminArticles" });
    },
    onSubmitUA(e) {
      e.preventDefault();
      const article = {
        url: this.urlUA,
        description: this.descriptionUA,
        id: this.id,
      };
      this.updateArticle(article);
      this.$router.push({ name: "AdminArticles" });
    },
  },
};
</script>

<style scoped>
.contener_articlesDetails {
  display: grid;
  min-height: 100vh;
  grid-template-columns: 150px 1fr;
}

.Admin_ArticlesDetails {
  display: flex;
  flex-direction: column;
  height: auto;
}

.updateArticleForm {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 20px;
  margin-right: 20px;
  margin-left: 20px;
  width: 50%;
}

.AdminArticleDetailsForm {
  display: flex;
  justify-content: center;
}

.AdminArticleDetailsCSS {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 30px;
  margin-top: 2px;
}

.UserButton {
  display: flex;
  width: 100%;
  justify-content: space-between;
}

.updateArticleButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.deleteArticleButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.returnArticle {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}
</style>
