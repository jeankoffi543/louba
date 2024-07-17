import axios from "axios";

const initialData = [];

const state = {
    isLoading: false,
    teams: initialData
};
const getters = {
    IS_LOADING_TEAMS: (state) => state.isLoading,
    GET_TEAMS: (state) => state.teams
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_TEAMS(state, payload) {
        state.teams = payload;
    }

};
const actions = {

    FETCH_TEAMS({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get('/api/get-teams').then(responseAxios => {
            commit("SET_TEAMS", responseAxios.data ?? []);
        }).catch((err) => {
            commit("SET_TEAMS", []);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    }

};

export default {
    namespace: true,
    state,
    getters,
    mutations,
    actions
};
