<template>
  <HeaderNavbar />
  <div>
    <div class="contener_categorydetails">
      <div class="AdminNavBarGridCSS">
        <Admin_Navbar />
      </div>
      <div class="Admin_CategoryDetails">
        <h1 class="AdminTitle">Category details</h1>
        <div class="AdminCategoryDetailsForm">
          <form @submit="onSubmitUCat" class="updateCategoryForm">
            <label class="AdminlabelCSS">Name</label>
            <input
              class="AdminCategoryDetailsCSS"
              name="categoryUCat"
              v-model="categoryUCat"
              type="text"
              :placeholder="name"
              minlength="2"
              required
            />
            <div class="UserButton">
              <button type="submit" class="updateCategoryButton">Update</button>
              <button
                type="button"
                class="deleteCategoryButton"
                @click="handleDeleteCategory"
              >
                Delete
              </button>
              <router-link
                class="routerlinkUserCSS"
                :to="{ name: 'AdminCategories' }"
              >
                <button type="button" class="returnCategory">Return</button>
              </router-link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderNavbar from "../components/HeaderNavbar";
import Admin_Navbar from "../components/Admin_Navbar";
import { mapActions } from "vuex";

export default {
  name: "AdminCategoriesDetails",
  props: ["id", "name"],
  components: { HeaderNavbar, Admin_Navbar },
  data() {
    return {
      categoryUCat: this.name,
    };
  },
  computed: {
    categories() {
      return this.$store.state.categories;
    },
  },
  mounted() {
    //this.$store.dispatch("getAllCategories");
  },
  methods: {
    ...mapActions(["removeCategory", "updateCategory"]),
    handleDeleteCategory() {
      this.removeCategory(this.id);
      this.$router.push({ name: "AdminCategories" });
    },
    onSubmitUCat(e) {
      e.preventDefault();
      const category = { name: this.categoryUCat, id: this.id };
      this.updateCategory(category);
      this.$router.push({ name: "AdminCategories" });
    },
  },
};
</script>

<style scoped>
.contener_categorydetails {
  display: grid;
  min-height: 100vh;
  grid-template-columns: 150px 1fr;
}

.Admin_CategoryDetails {
  display: flex;
  flex-direction: column;
  height: auto;
}

.updateCategoryForm {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 20px;
  margin-right: 20px;
  margin-left: 20px;
  width: 50%;
}

.AdminCategoryDetailsForm {
  display: flex;
  justify-content: center;
}

.AdminCategoryDetailsCSS {
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

.updateCategoryButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.deleteCategoryButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.returnCategory {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}
</style>
