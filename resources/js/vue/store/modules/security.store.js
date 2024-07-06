 import axios from "axios";

const state = {
    isLoading: false,
    response: null,
    message: null

};
const getters = {
    IS_LOADING_SECURITY: (state) => state.isLoading,
    USER_REGISTER: (state) => state.response?.user,
    TOKEN_USER_REGISTER: (state) => state.response?.token,
    STATUS_MESSAGE: (state) => state.message
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    RESPONSE_REGISTER(state, payload) {
        state.response = payload;
    },
    RESPONSE_ERROR(state, payload) {
        state.message = payload;
    }

};
const actions = {

    // eslint-disable-next-line no-unused-vars
    REGISTER_USER({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.post(`/api/register_client`, payload)
            .then(responseAxios => {
                const response = responseAxios.data;
                commit("RESPONSE_REGISTER", {user: response?.client, token: response.client?.telephone_client});
                if (response.client == null) {
                    commit("RESPONSE_ERROR", response.message);
                }
            })
            .catch((err) => {
                commit("RESPONSE_REGISTER", {user: null, token: null});
                commit("RESPONSE_ERROR", "L email ou le téléphone existe deja");
                console.log("err", err);
            }).finally(() => {
            commit("SET_LOADING", false);
        });
    },
    USER({state, commit}, payload) {
        commit("RESPONSE_REGISTER", {user: payload?.client, token: payload?.client?.telephone_client});
    },

    LOGIN_USER({state, commit}, payload) {
        commit("SET_LOADING", true);
    }
};

export default {
    namespace: true,
    state,
    getters,
    mutations,
    actions
};
