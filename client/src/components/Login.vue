<template>
  <b-container id="login">
    <hr />
    <h2>Login Form</h2>
    <hr />
    <b-form @submit="login">
      <label for="inp-email">E-mail:</label>
      <b-form-input
        id="inp-email"
        type="email"
        v-model="email"
        required
      ></b-form-input>
      <label for="inp-password">Password:</label>
      <b-form-input
        id="inp-password"
        type="password"
        v-model="password"
        :state="passwordLength"
        minlength="5"
        required
      ></b-form-input>
      <b-form-text id="input-live-help">At least 5 characters.</b-form-text>
      <b-button size="lg" type="submit" variant="outline-primary"
        >Login</b-button
      >
    </b-form>
  </b-container>
</template>

<script>
export default {
  computed: {
    passwordLength() {
      return this.password.length > 4;
    },
  },
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      this.$store
        .dispatch("login", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          this.$router.push("/");
        });
    },
  },
};
</script>

<style></style>
