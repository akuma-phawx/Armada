<template>
  <div id="app">
    <NavigationBar />

    <router-view />
  </div>
</template>

<script>
import NavigationBar from "./components/NavigationBar.vue";
export default {
  components: {
    NavigationBar,
  },
};
</script>

<style>
* {
  font-family: "Comic Sans MS", "Comic Sans", cursive;
}
</style>
