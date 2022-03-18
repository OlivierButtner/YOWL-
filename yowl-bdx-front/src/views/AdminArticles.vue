<template>
  <HeaderNavbar />
  <div>
    <div class="contener_articles">
      <div>
        <Admin_Navbar />
      </div>
      <div class="Admin_Articles">
        <h1 class="AdminTitle">Articles List</h1>
        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>User id</th>
              <th>Url</th>
              <th>Description</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <tr :id="article.id" v-for="article in articles" :key="article.id">
              <td>
                {{ article.id }}
              </td>
              <td>
                {{ article.user_id }}
              </td>
              <td>
                <router-link
                  class="routerlinkArticlesCSS"
                  :to="{ name: 'ArticleDetails', params: { id: article.id } }"
                >
                  {{ article.url }}
                </router-link>
              </td>
              <td>
                <router-link
                  class="routerlinkArticlesCSS"
                  :to="{ name: 'ArticleDetails', params: { id: article.id } }"
                >
                  {{ article.description }}
                </router-link>
              </td>
              <td>
                <router-link
                  :to="{
                    name: 'AdminArticlesDetails',
                    params: {
                      id: article.id,
                      url: article.url,
                      description: article.description,
                    },
                  }"
                >
                  <button class="routerlinkArticlesUpdateCSS">Update</button>
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
        <div>
          <Pagination />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Admin_Navbar from "../components/Admin_Navbar";
import Pagination from "../components/Pagination";
import HeaderNavbar from "../components/HeaderNavbar";

import { mapActions } from "vuex";

export default {
  name: "AdminArticles.vue",
  components: { HeaderNavbar, Pagination, Admin_Navbar },
  props: ["id", "url", "description"],
  data() {
    return {};
  },
  computed: {
    articles() {
      return this.$store.state.articles;
    },
  },
  mounted() {
    //this.$store.dispatch("getAllArticles");
  },
  methods: {
    ...mapActions(["removeArticle", "updateArticle"]),
  },
};
</script>

<style scoped>
.routerlinkArticlesCSS {
  text-decoration: none;
  color: black;
}

.routerlinkArticlesUpdateCSS {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.contener_articles {
  display: grid;
  min-height: 100vh;
  grid-template-columns: 150px 1fr;
}

table {
  border: 1px solid black;
  border-collapse: collapse;
  width: 100%;
}

th {
  border: 1px solid black;
  padding: 10px;
  background-color: #5ca7ff;
}

td {
  border: 1px solid black;
  padding: 10px;
}

.Admin_Articles {
  display: flex;
  flex-direction: column;
  height: fit-content;
  justify-self: center;
  width: 80%;
}
</style>
