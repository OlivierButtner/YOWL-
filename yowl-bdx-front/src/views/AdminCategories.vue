<template>
  <HeaderNavbar />
  <div class="contener_categories">
    <div class="AdminNavBarGridCSS">
      <Admin_Navbar />
    </div>
    <div class="Admin_Categories">
      <h1 class="AdminTitle">Categories List</h1>
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
          <tr
            :id="category.id"
            v-for="category in categories"
            :key="category.id"
          >
            <td>
              {{ category.id }}
            </td>
            <td>
              {{ category.name }}
            </td>
            <td>
              <router-link
                :to="{
                  name: 'AdminCategoriesDetails',
                  params: { id: category.id, name: category.name },
                }"
              >
                <button class="routerlinkUserCSS">Update</button>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="AdminCategoryAdd">
        <button
          v-if="showAdminCategoryAdd"
          class="addCategoryButton"
          @click="handleAddCategory"
        >
          Add a category
        </button>
        <form
          @submit="onSubmitC"
          v-if="!showAdminCategoryAdd"
          class="AdminCategoryAddButton"
        >
          <input
            name="nameC"
            v-model="nameC"
            type="text"
            autofocus
            placeholder="Write the name of the category"
            minlength="2"
          />
          <input
            type="submit"
            class="AdminCategoryFormAddButton"
            value="Add a category"
          />
          <button
            class="AdminCategoryFormAddButtonCancel"
            @click="handleAdminCategoryFormAddButtonCancel"
          >
            Return
          </button>
        </form>
      </div>
      <div>
        <Pagination />
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
  name: "AdminCategories",
  components: { HeaderNavbar, Pagination, Admin_Navbar },
  props: ["id", "name"],
  data() {
    return {
      nameC: "",
      showAdminCategoryAdd: true,
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
    ...mapActions(["addCategory"]),
    handleAddCategory() {
      this.showAdminCategoryAdd = !this.showAdminCategoryAdd;
    },
    onSubmitC(e) {
      e.preventDefault();
      const category = { name: this.nameC };
      this.addCategory(category);
      this.showAdminCategoryAdd = !this.showAdminCategoryAdd;
      this.nameC = "";
    },
    handleAdminCategoryFormAddButtonCancel() {
      this.showAdminCategoryAdd = !this.showAdminCategoryAdd;
      this.nameC = "";
    },
  },
};
</script>

<style scoped>
.routerlinkUserCSS {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.contener_categories {
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

.Admin_Categories {
  display: flex;
  flex-direction: column;
  height: fit-content;
  justify-self: center;
  width: 80%;
}

.AdminCategoryAdd {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

.AdminCategoryAddButton {
  display: flex;
  margin-top: 20px;
  border-radius: 20px;
  border: #2b78d2 1px solid;
  padding: 10px;
  flex-wrap: wrap;
}

[name="nameC"] {
  display: flex;
  width: 100%;
  padding: 3px;
  margin-bottom: 8px;
  border-radius: 20px;
}

.addCategoryButton {
  display: flex;
  margin-top: 20px;
  justify-self: center;
  color: whitesmoke;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
  background-color: #2b78d2;
}

.AdminCategoryFormAddButton {
  display: flex;
  justify-self: center;
  color: whitesmoke;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
  background-color: #2b78d2;
  width: fit-content;
  margin-right: auto;
}

.AdminCategoryFormAddButtonCancel {
  display: flex;
  justify-self: center;
  color: whitesmoke;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
  background-color: #2b78d2;
  width: fit-content;
  margin-left: auto;
}
</style>
