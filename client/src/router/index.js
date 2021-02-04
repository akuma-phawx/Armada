import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../components/Home.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import Market from "../components/market/Market.vue";
import MarketContent from "../components/market/MarketContent.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/market/:id",
    name: "MarketContent",
    component: MarketContent,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
  },
  {
    path: "/market",
    name: "Market",
    component: Market,
  },
];

const router = new VueRouter({
  routes,
});

export default router;
