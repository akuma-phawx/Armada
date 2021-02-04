<template>
  <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/market">Market</router-link> |
    <div class="links" v-if="!this.$store.state.isLoggedIn">
      <router-link to="/login">Login</router-link> |
      <router-link to="/register">Register</router-link>
    </div>
    <div class="links" v-else>
      <router-link v-on:click.native="doSomethingCool" to="/"
        >Logout</router-link
      >
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    doSomethingCool() {
      this.$store.commit("logout");
    },
  },
};
</script>

<style>
.links {
  display: inline-block;
}
</style>
