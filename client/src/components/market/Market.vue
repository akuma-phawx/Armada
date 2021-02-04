<template>
  <div v-if="!this.$store.state.isLoggedIn">
    <NotAuthenticated />
  </div>
  <div v-else>
    <b-container>
      <b-row> <MarketDropdown /></b-row>
    </b-container>
  </div>
</template>

<script>
import NotAuthenticated from "../NotAuthenticated.vue";
import MarketDropdown from "./MarketDropdown.vue";
export default {
  components: {
    NotAuthenticated,
    MarketDropdown,
  },
  beforeMount() {
    console.log("Fetcing Data..");
    this.$store.dispatch("loadIndicies");
  },
};
</script>

<style></style>
