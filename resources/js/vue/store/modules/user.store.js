import axios from "axios";
import * as utils from "../../core/utils";

const initialData = [];

const state = {
    isLoading: false,
    user: null
};
const getters = {
    IS_LOADING_USER: (state) => state.isLoading,
    GET_USER: (state) => state.user
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },

    SET_USER(state, payload) {
        state.user = payload;
    }

};

const actions = {


    FETCH_USER({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/get-user-info`).then(responseAxios => {
            commit("SET_USER", responseAxios?.data.client);
        }).catch((err) => {
            this.$router.push({name: 'login'}),
            commit("SET_USER", null);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    }

};

export default {
    namespace: true, state, getters, mutations, actions
};
