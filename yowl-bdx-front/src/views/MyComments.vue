<template>
  <HeaderNavbar />
  <CategoryNavbar />
  <div>
    <h1 class="MyCommentsTitle">My Comments details</h1>
    <div class="CSSComments">
    <tr class="CSSTrComments" :id="comment.id" v-for="comment in comments" :key="comment.id">
      <div class="MyComments">{{ comment.content }}</div>
      <router-link
        :to="{
          name: 'MyComments',
          params: { id: comment.id, content: comment.content },
        }"
      >
      </router-link>
      <div class="UserButton">
        <button
          class="ButtonMyComment"
          @click="handleDeleteComment(comment.id)"
        >
          Delete
        </button>
      </div>
    </tr>
    </div>
  </div>
</template>

<script>
import CategoryNavbar from "@/components/CategoryNavbar";
import HeaderNavbar from "@/components/HeaderNavbar";
import { mapActions } from "vuex";

export default {
  name: "Mycomments",
  components: { CategoryNavbar, HeaderNavbar },
  props: ["id", "content"],
  data() {
    return {};
  },
  computed: {
    comments() {
      return this.$store.state.myComments;
    },
  },
  mounted() {
    this.$store.dispatch("getMyComments");
  },

  methods: {
    ...mapActions(["removeComment", "updateComment"]),
    handleDeleteComment(id) {
      this.removeComment(id);
      this.$router.push("/");
    },
  },
};
</script>

<style>

.CSSComments {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  width: 100%;
  justify-content: center;
}

.CSSTrComments {
  display: flex;
  width: 80%;
  align-self: center;
}

.MyComments {
  display: flex;
  width: 100%;
  justify-content: center;
  margin: auto;
  margin-bottom: 20px;
  margin-right: 10px;
}

.UserButton {
  display: flex;
  align-items: center;
}

.ButtonMyComment {
display: flex;
  margin: auto;
}

</style>
