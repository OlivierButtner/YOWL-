<template>
  <div class="category">
    <div v-for="category in categories" :key="category.id">
      {{ category.name }}
    </div>

    <router-view />
  </div>
</template>

<script>
/*import {mapActions} from 'vuex'*/
export default {
  name: "CategoryNavbar.vue",
  computed: {
    categories() {
      return this.$store.state.categories;
    },
  },
  mounted() {
    this.$store.dispatch("getAllCategories");
  },
};
</script>

<style>
.category {
  display: flex;
  justify-content: space-between;
  font-weight: bold;
  border: solid #f7f9fa 1px;
}
</style>
