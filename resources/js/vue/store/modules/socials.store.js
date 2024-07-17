import axios from "axios";

const initialData = []

const state = {
    isLoading: false,
    socials: initialData,
};
const getters = {
    IS_LOADING_SOCIALS: (state) => state.isLoading,
    GET_SOCIALS: (state) => state.socials,
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_SOCIALS(state, payload) {
        state.socials = payload;
    },

};
const actions = {

    // eslint-disable-next-line no-unused-vars
    FETCH_SOCIALS({state, commit}, payload) {
        commit("SET_LOADING", true);
        //
        axios.get(`/api/get-social-link`)
            .then(responseAxios => {
                const response = responseAxios.data;
                commit("SET_SOCIALS", response);
            })
            .catch((err) => {
                commit("SET_SOCIALS", []);
                console.log("err", err);
            }).finally(() => {
            commit("SET_LOADING", false);
        });
    },
};

export default {
    namespace: true,
    state,
    getters,
    mutations,
    actions,
};
