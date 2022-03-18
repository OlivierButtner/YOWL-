<template>
  <HeaderNavbar />
  <div>
    <div class="contener_comments">
      <div class="AdminNavBarGridCSS">
        <Admin_Navbar />
      </div>
      <div class="Admin_Comments">
        <h1 class="AdminTitle">Comments List</h1>
        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>Art_id</th>
              <th>User_id</th>
              <th>Content</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <tr :id="comment.id" v-for="comment in comments" :key="comment.id">
              <td>
                {{ comment.id }}
              </td>
              <td>
                {{ comment.article_id }}
              </td>
              <td>
                {{ comment.user_id }}
              </td>
              <td>
                <router-link
                  class="routerlinkCommentsCSS"
                  :to="{
                    name: 'ArticleDetails',
                    params: { id: comment.article_id },
                  }"
                >
                  {{ comment.content }}
                </router-link>
              </td>
              <td>
                <router-link
                  :to="{
                    name: 'AdminCommentsDetails',
                    params: { id: comment.id, content: comment.content },
                  }"
                >
                  <button class="routerlinkCommentsUpdateCSS">Update</button>
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
  name: "AdminComments.vue",
  components: { HeaderNavbar, Pagination, Admin_Navbar },
  props: ["id", "content"],
  data() {
    return {};
  },
  computed: {
    comments() {
      return this.$store.state.comments;
    },
  },
  mounted() {
    this.$store.dispatch("getAllComments");
  },
  methods: {
    ...mapActions(["removeComment", "updateComment"]),
  },
};
</script>

<style scoped>
.routerlinkCommentsCSS {
  text-decoration: none;
  color: black;
}

.routerlinkCommentsUpdateCSS {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.contener_comments {
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

.Admin_Comments {
  display: flex;
  flex-direction: column;
  height: fit-content;
  justify-self: center;
  width: 80%;
}
</style>
