import axios from "axios";

const initialData = [];

const state = {
    isLoading: false,
    sliders: initialData
};
const getters = {
    IS_LOADING_SLIDERS: (state) => state.isLoading,
    GET_SLIDERS: (state) => state.sliders
};
const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_SLIDERS(state, payload) {
        state.sliders = payload;
    }

};
const actions = {

    FETCH_SLIDERS({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get('/api/get-sliders').then(responseAxios => {
            commit("SET_SLIDERS", responseAxios.data ?? []);
        }).catch((err) => {
            commit("SET_SLIDERS", []);
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
