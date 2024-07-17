import {locationEnrolment} from '../../core/constants';

const initialData = [
    {
        label: "Coléah",
        code: locationEnrolment.COLEAH,
        id: "1"
    },
    {
        label: "Matoto",
        code: locationEnrolment.MATOTO,
        id: "2"
    },
    {
        label: "Nongo",
        code: locationEnrolment.NONGO,
        id: "3"
    }

];

const state = {
    isLoading: false,
    locationsEnrolments: initialData,
    enrolmentsPoints: [],
    locationsEnrolmentsSelected: null
};
const getters = {
    IS_LOADING_LOCATIONS_ENROLMENTS: (state) => state.isLoading,
    GET_LOCATIONS_ENROLMENTS: (state) => state.locationsEnrolments,
    GET_ENROLMENTS_POINTS: (state) => state.enrolmentsPoints,
    GET_LOCATIONS_ENROLMENTS_SELECTED: (state) => state.locationsEnrolmentsSelected
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_LOCATIONS_ENROLMENTS(state, payload) {
        state.locationsEnrolments = payload;
    },
    SET_LOCATIONS_ENROLMENTS_SELECTED(state, payload) {
        state.locationsEnrolmentsSelected = payload;
    },
    SET_ENROLMENTS_POINTS(state, payload) {
        state.enrolmentsPoints = payload;
    }

};
const actions = {


    FETCH_ENROLMENTS_POINTS({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get('/api/get-enrolment-point').then(responseAxios => {
            console.log("responseAxios.data", responseAxios.data)
            commit("SET_ENROLMENTS_POINTS", responseAxios.data);
        }).catch((err) => {
            commit("SET_ENROLMENTS_POINTS", []);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    },

    // eslint-disable-next-line no-unused-vars
    FETCH_LOCATIONS_ENROLMENTS({state, commit}, payload) {
        commit("SET_LOCATIONS_ENROLMENTS", state.locationsEnrolments);
        /*commit("SET_LOADING", true);
        axios.get('/services/all').then(responseAxios => {
            commit("SET_SERVICES", responseAxios.data);
        }).catch((err) => {
            commit("SET_SERVICES", []);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });*/
    },


    // eslint-disable-next-line no-unused-vars
    LOCATION_ENROLMENT_SELECTED({state, commit}, payload) {
        commit("SET_LOCATIONS_ENROLMENTS_SELECTED", payload);
    }

};

export default {
    namespace: true,
    state,
    getters,
    mutations,
    actions
};
