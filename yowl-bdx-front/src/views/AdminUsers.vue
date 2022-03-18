<template>
  <HeaderNavbar />
  <div class="contener_users">
    <div class="AdminNavBarGridCSS">
      <Admin_Navbar />
    </div>
    <div class="Admin_Users">
      <h1 class="AdminTitle">Users List</h1>
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
          <tr :id="user.id" v-for="user in users" :key="user.id">
            <td>
              {{ user.id }}
            </td>
            <td>
              {{ user.username }}
            </td>
            <td>
              {{ user.email }}
            </td>
            <td>
              <p v-if="user.is_admin === 1">Yes</p>
              <p v-else>No</p>
            </td>
            <td>
              <router-link
                :to="{
                  name: 'AdminUsersDetails',
                  params: {
                    id: user.id,
                    username: user.username,
                    email: user.email,
                    is_admin: user.is_admin,
                  },
                }"
              >
                <button class="routerlinkUserCSS">Update</button>
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
</template>

<script>
import Admin_Navbar from "../components/Admin_Navbar";
import Pagination from "../components/Pagination";
import HeaderNavbar from "../components/HeaderNavbar";

export default {
  name: "AdminUsers.vue",
  components: { HeaderNavbar, Pagination, Admin_Navbar },
  props: ["id", "username", "email", "is_admin"],
  data() {
    return {};
  },
  computed: {
    users() {
      return this.$store.state.users;
    },
  },
  mounted() {
    this.$store.dispatch("getAllUsers");
  },
  methods: {},
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

.contener_users {
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

.Admin_Users {
  display: flex;
  flex-direction: column;
  height: fit-content;
  justify-self: center;
  width: 80%;
}
</style>
