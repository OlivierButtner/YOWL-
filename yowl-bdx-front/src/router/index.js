import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import AdminArticles from '../views/AdminArticles.vue'
import AdminComments from '../views/AdminComments.vue'
import AdminPage from '../views/AdminPage.vue'
import AdminUsers from '../views/AdminUsers'
import ArticleDetails from '../views/ArticleDetails.vue'
import AdminUsersDetails from '../views/AdminUsersDetails'
import AdminArticlesDetails from "../views/AdminArticlesDetails";
import AdminCommentsDetails from "../views/AdminCommentsDetails";
import Register from '../views/Register.vue'
import Login from '../views/Login.vue'
import MyComments from '../views/MyComments.vue'
import MyProfile from '../views/MyProfile.vue'
import MyArticles from '../views/MyArticles'
import AdminCategories from "../views/AdminCategories";
import AdminCategoriesDetails from "../views/AdminCategoriesDetails";
import store from "../store";

// const isAdmin = $store.isAdmin

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/AdminArticles',
    name: 'AdminArticles',
    component: AdminArticles,
    props: true
  },
  {
    path: '/AdminComments',
    name: 'AdminComments',
    component: AdminComments,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/AdminCommentsDetails/:id',
    name: 'AdminCommentsDetails',
    component: AdminCommentsDetails,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/AdminPage',
    name: 'AdminPage',
    component: AdminPage,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/AdminUsers',
    name: 'AdminUsers',
    component: AdminUsers,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/AdminUsersDetails/:id',
    name: 'AdminUsersDetails',
    component: AdminUsersDetails,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/ArticleDetails/:id',
    name: 'ArticleDetails',
    component: ArticleDetails,
    props: true
  },
  {
    path: '/AdminArticlesDetails/:id',
    name: 'AdminArticlesDetails',
    component: AdminArticlesDetails,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/AdminCategories',
    name: 'AdminCategories',
    component: AdminCategories,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/AdminCategoriesDetails/:id',
    name: 'AdminCategoriesDetails',
    component: AdminCategoriesDetails,
    props: true,
    meta: { requiresAdmin: true },
  },
  {
    path: '/Login',
    name: 'Login',
    component: Login
  },
  {
    path: '/MyArticles',
    name: 'MyArticles',
    component: MyArticles,
    meta: { requiresAuth: true },
  },
  {
    path: '/MyComments',
    name: 'MyComments',
    component: MyComments,
    meta: { requiresAuth: true },
  },
  {
    path: '/MyProfile',
    name: 'MyProfile',
    component: MyProfile,
    meta: { requiresAuth: true },
  },
  {
    path: '/Register',
    name: 'Register',
    component: Register
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (store.getters.isLoggedIn) {
      next();
      return;
    }
    next("/login");
  } else {
    next();
  }
});


router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAdmin)) {
    if (store.getters.isAdmin) {
      next();
      return;
    }
    next("/login");
  } else {
    next();
  }
});

export default router
