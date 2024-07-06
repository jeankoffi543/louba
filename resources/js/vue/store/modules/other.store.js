import axios from "axios";
import {TAGS_CONTENTE} from "../../core/constants";

const initialData = [];

const state = {
    isLoading: false, DG: null,
    presentation: null,
    oniNumber: null,
    ferry_day: []
};
const getters = {
    IS_LOADING_OTHER: (state) => state.isLoading,
    GET_SENTENS_DG: (state) => state.DG,
    GET_PRESENTATION: (state) => state.presentation,
    GET_ONINUMBER: (state) => state.oniNumber,
    GET_FERRY_DAY: (state) => state.ferry_day.map((day) => {
        return {
            ...day,
            dateFormat: new Date(day?.date_jfpe).toLocaleDateString(undefined, {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric"
            })
        }
    })
};

const mutations = {

    SET_LOADING(state, payload) {
        state.isLoading = payload;
    }, SET_SENTENS_DG(state, payload) {
        state.DG = payload;
    }, SET_PRESENTATION(state, payload) {
        state.presentation = payload;
    }, SET_ONINUMBER(state, payload) {
        state.oniNumber = payload;
    }
    ,
    SET_FERRY_DAY(state, payload) {
        state.ferry_day = payload;
    }

};

function emitNewStatus(tag, commit, content) {
    switch (tag) {
        case TAGS_CONTENTE['DG']:
            commit("SET_SENTENS_DG", content);
            break;
        case TAGS_CONTENTE["PRESENTATION"]:
            commit("SET_PRESENTATION", content);
            break;
        case TAGS_CONTENTE['ONI_EN_CHIFFRE']:
            commit("SET_ONINUMBER", content);
            break;
    }
}

const actions = {
    FETCH_CONTENT({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/get-about-content/${payload.tag}`).then(responseAxios => {
            const tag = payload.tag;
            if (responseAxios.data !== "")
                emitNewStatus(tag, commit, responseAxios.data);
            else
                emitNewStatus(tag, commit, null);
        }).catch((err) => {
            const tag = payload.tag;
            emitNewStatus(tag, commit, null);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    },
    FETCH_FERRY_DAY({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/get-ferry-day`).then(responseAxios => {
            commit("SET_FERRY_DAY", responseAxios.data ?? []);
        }).catch((err) => {
            commit("SET_FERRY_DAY", []);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    }

};

export default {
    namespace: true, state, getters, mutations, actions
};
