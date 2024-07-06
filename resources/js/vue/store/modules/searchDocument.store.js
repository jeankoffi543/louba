import axios from "axios";


const state = {
    isLoading: false,
    document: null
};
const getters = {
    IS_LOADING_SEARCH_DOCUMENT: (state) => state.isLoading,
    GET_RESULT_SEARCH_DOCUMENT: (state) => state.document
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_RESULT_SEARCH_DOCUMENT(state, payload) {
        state.document = payload;
    }

};
const actions = {

    SEARCH_DOCUMENT({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/search-document/${payload.code}`).then(responseAxios => {
            commit("SET_RESULT_SEARCH_DOCUMENT", responseAxios.data);
        }).catch((err) => {
            commit("SET_RESULT_SEARCH_DOCUMENT", null);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    },

    RESULT_DOCUMENT({state, commit}, payload) {
        commit("SET_RESULT_SEARCH_DOCUMENT", payload);
    }

};

export default {
    namespace: true,
    state,
    getters,
    mutations,
    actions
};
