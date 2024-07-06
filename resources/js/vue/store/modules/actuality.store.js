import axios from "axios";

const initialData = [];

const initialPagination = {
    pageIndex: 1,
    size: 4,
    totalOfPages: 1,
    total: initialData.length
};
const state = {
    isLoading: false,
    actualities: initialData,
    oneActuality: null,
    pagination: initialPagination
};
const getters = {
    IS_LOADING_ACTUALITIES: (state) => state.isLoading,
    GET_ACTUALITIES: (state) => state.actualities,
    GET_ONE_ACTUALITY: (state) => state.oneActuality,
    GET_PAGINATION_ACTUALITY: (state) => state.pagination
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    }, SET_ACTUALITIES(state, payload) {
        state.actualities = payload;
    }, SET_ONE_ACTUALITY(state, payload) {
        state.oneActuality = payload;
    },

    SET_PAGINATION_ACTUALITY(state, payload) {
        state.pagination = payload;
    }
};
const actions = {

    FETCH_ACTUALITIES({state, commit}, payload) {
        commit("SET_LOADING", true);
        const pageIndex = payload?.pageIndex ?? state.pagination.pageIndex;
        const size = payload?.size ?? state.pagination.size;
        axios.get(`/api/get-actualities`, {
            data: {
                page: pageIndex,
                size: size
            }
        }).then(responseAxios => {
            const response = responseAxios.data;
            const items = (response.items || []).map(it => {
                return {
                    ...it,
                    date: new Date(it.date_of_publish).toLocaleDateString(),
                    description: it.description == null || it.description == "" ? "Aucune description enregistré" : it.description
                };
            });
            commit("SET_ACTUALITIES", items);
            commit("SET_PAGINATION_ACTUALITY", {
                pageIndex: pageIndex,
                totalOfPages: response?.total,
                total: response?.total
            });
        })
            .catch((err) => {
                commit("SET_ACTUALITIES", []);
                console.log("err", err);
            }).finally(() => {
            commit("SET_LOADING", false);
        });
    }, // eslint-disable-next-line no-unused-vars

    FETCH_ONE_ACTUALITY({state, commit}, payload) {
        // get-articles
        commit("SET_LOADING", true);
        axios.get(`/api/get-one-actuality/${payload.id}`).then(responseAxios => {
            const response = responseAxios.data;
            const data = {
                ...response,
                date: new Date(response.date_of_publish).toLocaleDateString(),
                description: response.description == null || response.description == "" ? "Aucune description enregistré" : response.description
            }
            commit("SET_ONE_ACTUALITY", data);
        })
            .catch((err) => {
                commit("SET_ONE_ACTUALITY", state.actualities.find(it => it.id == payload.id));
                console.log("err", err);
            }).finally(() => {
            commit("SET_LOADING", false);
        });
    }
};

export default {
    namespace: true, state, getters, mutations, actions
};
