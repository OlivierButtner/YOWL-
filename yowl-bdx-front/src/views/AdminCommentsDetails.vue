<template>
  <HeaderNavbar />
  <div>
    <div class="contener_commentsDetails">
      <div class="AdminNavBarGridCSS">
        <Admin_Navbar />
      </div>
      <div class="Admin_CommentsDetails">
        <h1 class="AdminTitle">Comment details</h1>
        <div class="AdminCommentDetailsForm">
          <form @submit="onSubmitUC" class="updateCommentForm">
            <label class="AdminlabelCSS">Content</label>
            <input
              class="AdminCommentDetailsCSS"
              name="contentUC"
              v-model="contentUC"
              type="text"
              :placeholder.prop="content"
              minlength="2"
              required
            />
            <div class="UserButton">
              <button type="submit" class="updateCommentButton">Update</button>
              <button
                type="button"
                class="deleteCommentButton"
                @click="handleDeleteComment"
              >
                Delete
              </button>
              <router-link
                class="routerlinkCommentsCSS"
                :to="{ name: 'AdminComments' }"
              >
                <button type="button" class="returnComment">Return</button>
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
  name: "AdminCommentsDetails",
  props: ["id", "content"],
  components: { HeaderNavbar, Admin_Navbar },
  data() {
    return {
      contentUC: this.content,
    };
  },
  computed: {
    comments() {
      return this.$store.state.comments;
    },
  },
  mounted() {
    // this.$store.dispatch("getAllComments");
  },
  methods: {
    ...mapActions(["removeComment", "updateComment"]),
    handleDeleteComment() {
      this.removeComment(this.id);
      this.$router.push({ name: "AdminComments" });
    },
    onSubmitUC(e) {
      e.preventDefault();
      const comment = { content: this.contentUC, id: this.id };
      this.updateComment(comment);
      this.$router.push({ name: "AdminComments" });
    },
  },
};
</script>

<style scoped>
.contener_commentsDetails {
  display: grid;
  min-height: 100vh;
  grid-template-columns: 150px 1fr;
}

.Admin_CommentsDetails {
  display: flex;
  flex-direction: column;
  height: auto;
}

.updateCommentForm {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 20px;
  margin-right: 20px;
  margin-left: 20px;
  width: 50%;
}

.AdminCommentDetailsForm {
  display: flex;
  justify-content: center;
}

.AdminCommentDetailsCSS {
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

.updateCommentButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.deleteCommentButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.returnComment {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}
</style>
