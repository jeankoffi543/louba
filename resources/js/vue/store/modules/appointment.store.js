import axios from "axios";
import {KEY_FORM_JSON, typePassport} from '../../core/constants';
import utils from "../../core/utils";

const initialTypeAppointments = [{
    label: "PASSEPORT BIOMETRIQUE",
    img: "/assets/vue/imgs/others/passeport.png",
    id: "1",
    checked: false,
    hasFile: false,
    file: null,
    code: typePassport.ORDINANL
}, {
    label: "VISA ELECTRONIQUE",
    img: "/assets/vue/illustration/illustration_services_vip_oneci.svg",
    id: "2",
    checked: false,
    hasFile: false,
    file: null,
    code: typePassport.SERIVECES_VIP

}, {
    label: "CASIER JUDICIAIRE",
    img: "/assets/vue/imgs/others/Esanitaire.png",
    id: "3",
    checked: false,
    hasFile: true,
    file: null,
    code: typePassport.EVACUATION_SANITAIRE
}
    /*{
        label: "Pèlerinage",
        img: /assets/vue/imgs/others/vectorPelerinage.png",
        id: "5",
        checked: false,
        hasFile: true,
        file: null
    },
    {
        label: "Étudiant",
        img: /assets/vue/imgs/others/study-abroad-pana.png",
        id: "6",
        checked: false,
        hasFile: true,
        file: null
    },*/


];
const initialFormDataRequest = {
    [KEY_FORM_JSON.PRODUCT]: null,
    [KEY_FORM_JSON.TYPE_REQUEST]: null,
    [KEY_FORM_JSON.FORM_INFO_USER]: null,
    [KEY_FORM_JSON.SITE_APPOINTMENT]: null,
    [KEY_FORM_JSON.DATE_APPOINTMENT]: null
};

// typeRequest
const state = {
    isLoading: false,
    typesAppointments: initialTypeAppointments,
    formDataRequest: initialFormDataRequest,
    typeAppointmentSelected: null,
    objectAppointmentSelected: null,
    productsSelected: null,
    serviceSelected: null,
    statusResponse: null,
    appointments: {message: null, demandes: []},
    appointmentsBrouillon: {message: null, demandes: []},
    appointment: null,
    initPayData: null,
};

const getters = {
    IS_LOADING_APPOINTMENT: (state) => state.isLoading,
    GET_TYPES_APPOINTMENTS: (state) => state.typesAppointments,
    GET_TYPE_APPOINTMENT_SELECTED: (state) => state.typeAppointmentSelected,
    GET_OBJECT_APPOINTMENT_SELECTED: (state) => {
        return {
            ...state.objectAppointmentSelected,
            id: state.objectAppointmentSelected?.id_type_document,
            titre: state.objectAppointmentSelected?.nom_type_document,
            imgUrl: state.objectAppointmentSelected?.image_type_document
        }
    },
    GET_FORM_DATA_REQUEST: (state) => state.formDataRequest,
    GET_PRODUCT_SELECTED: (state) => state.productsSelected,
    GET_SERVICE_SELECTED: (state) => state.serviceSelected,
    GET_STATUS_RESPONSE: (state) => state.statusResponse,
    GET_APPOINTMENT: (state) => state.appointments.demandes,
    GET_APPOINTMENT_BROUILLON: (state) => state.appointmentsBrouillon.demandes,
    GET_ONE_APPOINTMENT: (state) => state.appointment,
    GET_MESSAGE_APPOINTMENT: (state) => state.appointments.message,
    GET_INIT_RESPONSE_PAYMENT: (state) => state.initPayData,
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    }, SET_TYPES_APPOINTMENTS(state, payload) {
        state.typesAppointments = payload;
    }, SET_TYPE_APPOINTMENT_SELECTED(state, payload) {
        state.typeAppointmentSelected = payload;
    }, SET_OBJECT_APPOINTMENT(state, payload) {
        state.objectAppointmentSelected = payload;
    }, SET_FORM_DATA_REQUEST(state, payload) {
        state.formDataRequest[payload.key] = payload.data;
    }, SET_PRODUCT_SELECTED(state, payload) {
        state.productsSelected = payload;
    }, SET_SERVICE_SELECTED(state, payload) {
        state.serviceSelected = payload;
    }, SET_STATUS_RESPONSE(state, payload) {
        state.statusResponse = payload;
    },
    SET_APPOINTMENT(state, payload) {
        state.appointments = payload;
    },
    
    SET_APPOINTMENT_BROUILLON(state, payload) {
        state.appointmentsBrouillon = payload;
    },
    SET_ONE_APPOINTMENT(state, payload) {
        state.appointment = payload;

    },
    SET_INIT_RESPONSE_PAYMENT(state, payload) {
        state.initPayData = payload;
    }

};
const actions = {
    // eslint-disable-next-line no-unused-vars
    TYPE_APPOINTMENT_SELECTED({state, commit}, payload) {
        commit("SET_TYPE_APPOINTMENT_SELECTED", payload);
    },

    // eslint-disable-next-line no-unused-vars
    OBJECT_APPOINTMENTS_SELECTED({state, commit}, payload) {
        commit("SET_OBJECT_APPOINTMENT", payload);
    }, // eslint-disable-next-line no-unused-vars
    TYPES_APPOINTMENTS({state, commit}) {
        commit("SET_TYPES_APPOINTMENTS", state.typesAppointments);
    }, // eslint-disable-next-line no-unused-vars
    FORM_DATA_REQUEST({state, commit}, payload) {
        commit("SET_FORM_DATA_REQUEST", payload);
    }, PRODUCT_SELECTED({state, commit}, payload) {
        commit("SET_PRODUCT_SELECTED", payload);
    }, SERVICE_SELECTED({state, commit}, payload) {
        commit("SET_SERVICE_SELECTED", payload);
    }, SAVE_APPOINTMENT({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.post(`/api/save-appointment`, payload).then(responseAxios => {
            console.log("responseAxios", responseAxios)
            commit("SET_STATUS_RESPONSE", {...responseAxios.data});
        }).catch((err) => {
            commit("SET_STATUS_RESPONSE", {message: "Echèc de l'enregistrement"});
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    },

    FETCH_APPOINTMENT({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/get-appointment`, payload).then(responseAxios => {
            commit("SET_APPOINTMENT", responseAxios.data);
        }).catch((err) => {
            commit("SET_APPOINTMENT", {message: "Aucune demande", demandes: []});
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    },

    FETCH_APPOINTMENT_BROUILLON({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/get-appointment-brouillon`, payload).then(responseAxios => {
            console.log("responseAxios.data", responseAxios.data)
            commit("SET_APPOINTMENT_BROUILLON", responseAxios.data);
        }).catch((err) => {
            commit("SET_APPOINTMENT_BROUILLON", {message: "Aucune demande", demandes: []});
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    },


    FETCH_ONE_APPOINTMENT({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/get-one-appointment/${payload}`, payload).then(responseAxios => {
            commit("SET_ONE_APPOINTMENT", responseAxios.data);
        }).catch((err) => {
            commit("SET_ONE_APPOINTMENT", {message: "Aucune demande trouvé"});
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });


    },

    INIT_PAYEMENT({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/init-pay-demande/${payload}`, payload).then(responseAxios => {
            commit("SET_INIT_RESPONSE_PAYMENT", responseAxios.data);
        }).catch((err) => {
            commit("SET_INIT_RESPONSE_PAYMENT", {message: "Échec du paiement"});
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });


    }
};


export default {
    namespace: true, state, getters, mutations, actions
};
