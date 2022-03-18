<template>
  <HeaderNavbar></HeaderNavbar>
  <CategoryNavbar></CategoryNavbar>
  <div class="BodyOfArticleDetails">
    <div class="BlockOfArticle">
      <ArticleDetails v-bind:article="article" />
    </div>
    <div v-if="this.$store.state.token" class="CreateComment">
      <div class="TitleOfCommentSubmit">Express yourself...</div>
      <div class="CreateCommentButton"></div>
      <form @submit="NewCommentSubmit">
        <input v-model="NeWComment" class="InputOfComment" /><button
          class="ButtonOfSubmitComment"
        >
          SUBMIT
        </button>
      </form>
    </div>

    <div class="BlockOfComments">
      <div v-for="comment in commentsbyArticle" :key="comment.id">
        <div class="CommentOfThisArticle">
          <div class="UserOfComment">{{ comment.username }}</div>
          <div class="CreationDateOfComment">{{ comment.created_at }}</div>
          <td>
            {{ comment.content }}
          </td>
        </div>
      </div>
    </div>
  </div>
  <!-- </div> -->
</template>

<script>
import ArticleDetails from "../components/ArticleDetails";
import CategoryNavbar from "@/components/CategoryNavbar";
import HeaderNavbar from "@/components/HeaderNavbar";
import { mapActions } from "vuex";
//import { computed } from '@vue/reactivity';
export default {
  name: "ArticleDetails.vue",
  components: { ArticleDetails, CategoryNavbar, HeaderNavbar },
  props: ["id", "content"],
  data() {
    return {
      NeWComment: "",
    };
  },
  created() {
    this.$store.dispatch("SET_CURRENT_ARTICLE", this.id);
    this.$store.dispatch("getAllCommentsByArticles", this.id);
  },
  computed: {
    article: function () {
      return this.$store.getters.getCurrentArticle;
    },
    comments() {
      return this.$store.state.comments;
    },
    commentsbyArticle() {
      return this.$store.state.commentsByArticle;
    },
  },
  mounted() {},
  methods: {
    ...mapActions(["addComment"]),
    NewCommentSubmit(e) {
      e.preventDefault();
      let comment = {
        article_id: this.id,
        content: this.NeWComment,
      };
      this.addComment(comment);
      this.$router.push("/");
    },
  },
};
</script>

<style>
.BodyOfArticleDetails {
  display: grid;
  /*grid-template-columns: repeat(2, minmax(15%,auto));*/
  grid-template-rows: auto;
  margin-left: 50px;
  margin-top: 30px;
  margin-right: 200px;

  margin-top: 5px;
}
.BlockOfArticle {
height: 20px;
}
.CreateComment {

}
.CreateCommentButton {
  display: inline-block;
}
.BlockOfComments {
  grid-area: right;

  margin-top: 10px;
}

.TitleOfCommentSubmit {
  margin: 5px;
  text-align: left;
  font-size: 24px;
  color: #171616;
}
.InputOfComment {
  border-radius: 10px;
  font-size: 24px;
  color: #171616;
  text-align: center;
  padding: 20px 10px;

}
.ButtonOfSubmitComment {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
  margin-top: 10px;
}
.UserOfComment {
  margin: 5px;
  text-align: left;
  font-size: 18px;
  color: #4fa9fd;
}
.CreationDateOfComment {
  margin: 5px;
  text-align: left;
  font-size: 18px;
  color: #4fa9fd;
}
.CommentOfThisArticle {
  display: flex;
  justify-content: left;
  width: 100%;
  border-radius: 0px;
  box-shadow: 1px 1px 1px 1px rgb(184, 200, 217);
  font-size:20px;
  color: #171616;
  text-align: right;
  padding: 20px 10px;
  margin-top: 20px;

}
</style>
