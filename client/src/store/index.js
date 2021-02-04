import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    isLoggedIn: false,
    //Indicies array
    indicies: [],
    content: [],
    jwtToken: "",
  },
  mutations: {
    loadIndicies(state, payload) {
      state.indicies = payload;
      // console.log(state.indicies); //FOR TESTING PURPOSES
    },
    login(state, payload) {
      state.isLoggedIn = true;
      state.jwtToken = payload;
    },
    loadContent(state, payload) {
      state.content = payload;
      console.log(state.content);
    },
    logout(state) {
      state.jwtToken = "";
      state.isLoggedIn = false;
    },
  },
  actions: {
    //Loading all content of each id (as before with api call on dynamic endpoint)
    async loadContent({ commit, getters }, id) {
      await axios
        .get(`http://localhost:8000/market/${id}`, {
          headers: {
            Authorization: getters.getToken,
          },
        })
        .then((res) => {
          console.log(res.data);
          commit("loadContent", res.data);
        });
    },
    //Loading all IDS from Json File with API Call (from my phpsymfonybackend)
    async loadIndicies({ commit, getters }) {
      // console.log(this.state.indicies);//FOR TESTING PURPOSES
      await axios
        .get("http://localhost:8000/market/", {
          headers: {
            Authorization: getters.getToken,
          },
        })
        .then((res) => {
          commit("loadIndicies", res.data);
        });
      // console.log(this.state.indicies);//FOR TESTING PURPOSES
    },
    async register({ commit }, userObj) {
      const bodyFormData = new FormData();
      bodyFormData.append("email", userObj.email);
      bodyFormData.append("password", userObj.password);
      // console.log(bodyFormData);
      await axios
        .post("http://localhost:8000/auth/register", bodyFormData)
        .then((res) => {
          alert("success");
          console.log(res.data);
        })
        .catch((err) => {
          alert("Failed to register", err);
        });
    },
    async login({ commit }, userObj) {
      const bodyFormData = new FormData();
      bodyFormData.append("email", userObj.email);
      bodyFormData.append("password", userObj.password);
      // console.log(bodyFormData);
      await axios
        .post("http://localhost:8000/auth/login", bodyFormData)
        .then((res) => {
          const msg = res.data.message;
          if (msg === "success!") {
            alert("success");
            commit("login", res.data.token);
          } else {
            alert("Failed to login. Make sure your credentials were correct");
          }
        })
        .catch((err) => {
          alert(err);
        });
    },
  },
  getters: {
    getToken(state) {
      return state.jwtToken;
    },
  },
  modules: {},
});
