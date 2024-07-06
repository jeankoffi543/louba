import axios from "axios";

const initialData = null;

const state = {
    isLoading: false,
    statusResponse: initialData
};
const getters = {
    IS_LOADING_REQUEST: (state) => state.isLoading,
    GET_RESPONSE: (state) => state.statusResponse
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_RESPONSE(state, payload) {
        state.statusResponse = payload;
    }

};
const actions = {
    SEND_REQUEST({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.post('/api/send-request', payload).then(responseAxios => {
            commit("SET_RESPONSE", responseAxios.data?.message ?? "Votre requête à été envoyé");
        }).catch((err) => {
            commit("SET_RESPONSE", "Votre requête à échoué");
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
