<template>
  <HeaderNavbar />
  <div>
    <div class="contener_userdetails">
      <div class="AdminNavBarGridCSS">
        <Admin_Navbar />
      </div>
      <div class="Admin_UserDetails">
        <h1 class="AdminTitle">User details</h1>
        <div class="AdminUserDetailsForm">
          <form @submit="onSubmitUU" class="updateUserForm">
            <label class="AdminlabelCSS">Username</label>
            <input
              class="AdminUserDetailsCSS"
              name="usernameUU"
              v-model="usernameUU"
              type="text"
              :placeholder="username"
              minlength="2"
              required
            />
            <label class="AdminlabelCSS">Email</label>
            <input
              class="AdminUserDetailsCSS"
              name="emailUU"
              v-model="emailUU"
              type="email"
              :placeholder="email"
              required
            />
            <div class="radioIsAdmin" id="v-model-radiobuttonIsAdmin">
              <label class="AdminlabelCSS">Is Admin</label>
              <div class="IsAdminRadioTrue">
                <label for="IsAdminTrue">True</label>
                <input
                  type="radio"
                  id="IsAdminTrue"
                  value="1"
                  v-model="picked"
                />
              </div>
              <div class="IsAdminRadioFalse">
                <label for="IsAdminFalse">False</label>
                <input
                  type="radio"
                  id="IsAdminFalse"
                  :value="0"
                  v-model="picked"
                />
              </div>
              <div v-if="picked == 1" class="IsAdminSelected">
                <p>Selected : True</p>
              </div>
              <div v-else>
                <p>Selected : False</p>
              </div>
            </div>
            <div class="UserButton">
              <button class="updateUserButton">Update</button>
              <button
                type="button"
                class="deleteUserButton"
                @click="handleDeleteUser"
              >
                Delete
              </button>
              <router-link
                class="routerlinkUserCSS"
                :to="{ name: 'AdminUsers' }"
              >
                <button type="button" class="returnUser">Return</button>
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
  name: "AdminUsersDetails.vue",
  props: ["id", "username", "email", "is_admin"],
  components: { HeaderNavbar, Admin_Navbar },
  data() {
    return {
      usernameUU: this.username,
      emailUU: this.email,
      picked: this.is_admin,
    };
  },
  computed: {
    user() {
      return this.$store.state.user;
    },
  },
  mounted() {
    this.$store.dispatch("getAllUsers");
  },
  methods: {
    ...mapActions(["removeUser", "updateUser"]),
    handleDeleteUser() {
      this.removeUser(this.id);
      this.$router.push({ name: "AdminUsers" });
    },
    onSubmitUU(e) {
      e.preventDefault();
      const user = {
        username: this.usernameUU,
        email: this.emailUU,
        is_admin: this.picked,
        id: this.id,
      };
      this.updateUser(user);
      this.$router.push({ name: "AdminUsers" });
    },
  },
};
</script>

<style scoped>
.contener_userdetails {
  display: grid;
  min-height: 100vh;
  grid-template-columns: 150px 1fr;
}

.Admin_UserDetails {
  display: flex;
  flex-direction: column;
  height: auto;
}

.updateUserForm {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 20px;
  margin-right: 20px;
  margin-left: 20px;
  width: 50%;
}

.AdminUserDetailsForm {
  display: flex;
  justify-content: center;
}

.AdminUserDetailsCSS {
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

.updateUserButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.deleteUserButton {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.returnUser {
  color: white;
  background-color: #2b78d2;
  padding: 20px 10px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
}

.radioIsAdmin {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 100%;
  margin-bottom: 20px;
  justify-content: left;
  row-gap: 10px;
}

.IsAdminSelected {
  display: flex;
}

#IsAdminTrue {
  display: flex;
  width: fit-content;
  margin-left: 20px;
}

#IsAdminFalse {
  display: flex;
  width: fit-content;
  margin-left: 20px;
}

.IsAdminRadioTrue {
  display: flex;
  width: 100%;
  justify-content: left;
}

.IsAdminRadioFalse {
  display: flex;
  width: 100%;
  justify-content: left;
}
</style>
