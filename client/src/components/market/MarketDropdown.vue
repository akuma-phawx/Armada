<template>
  <div class="home">
    <h2>Select Index:</h2>
    <select @change="onChange($event)" v-model="selectedIndex" name="index">
      <option v-for="ind in indicies" :value="ind.id" :key="ind.id">
        {{ ind.id }}
      </option>
    </select>
    <!-- <p>{{ selectedIndex }}</p> -->
  </div>
</template>

<script>
export default {
  name: "Home",
  computed: {
    indicies() {
      return this.$store.state.indicies;
    },
  },
  data() {
    return {
      selectedIndex: "-",
    };
  },
  mounted() {
    console.log("Fetcing Data..");
    this.$store.dispatch("loadIndicies");
  },
  methods: {
    onChange(event) {
      this.$router.push(`/market/${event.target.value}`);
    },
  },
};
</script>
