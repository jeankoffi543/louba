import axios from "axios";

const initialData = []

const state = {
    isLoading: false,
    partners: initialData,
    onePartner: null,
};
const getters = {
    IS_LOADING_PARTNERS: (state) => state.isLoading,
    GET_PARTNERS: (state) => state.partners,
    GET_ONE_PARTNER: (state) => state.onePartner,
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_PARTNERS(state, payload) {
        state.partners = payload;
    },
    SET_ONE_PARTNER(state, payload) {
        state.onePartner = payload;
    },
};
const actions = {

    // eslint-disable-next-line no-unused-vars
    FETCH_PARTNERS({state, commit}, payload) {
        commit("SET_LOADING", true);
        //
        axios.get(`/api/get-partners`)
            .then(responseAxios => {
                const response = responseAxios.data;
                const items = (response || []).map(it => {
                    return {
                        ...it,
                        logoName: it?.name,
                        uriSrc: it?.path,
                    };
                });
                commit("SET_PARTNERS", items);
            })
            .catch((err) => {
                commit("SET_PARTNERS", []);
                console.log("err", err);
            }).finally(() => {
            commit("SET_LOADING", false);
        });
    },
    // eslint-disable-next-line no-unused-vars
    FETCH_ONE_PARTNER({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/partners/one/${payload.id}`).then(responseAxios => {
            commit("SET_ONE_PARTNER", responseAxios.data);
        }).catch((err) => {
            commit("SET_ONE_PARTNER", null);
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
    actions,
};
