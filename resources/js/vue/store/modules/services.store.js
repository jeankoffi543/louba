import axios from "axios";

const initialData = [
    /*  {
          id: 1,
          level: 5,
          title: "Services VIP",
          code: serviceType.SERVICES_VIP,
          imgUrl: "/assets/vue/illustration/illustration_services_vip_oneci.svg",
          nameUrl: 'service-vip',
          type: "SERVICE"
      },
      {
          id: 2,
          level: 6,
          code: serviceType.PROCEDURE_URGENCE,
          title: "Procédure d'urgence",
          imgUrl: "/assets/vue/imgs/others/urgence.jpg",
          nameUrl: 'process-evacuation-sanitary',
          type: "SERVICE"
      },
      {
          id: 3,
          level: 7,
          title: "Statut de mon document",
          imgUrl: "/assets/vue/imgs/others/progress.jpg",
          nameUrl: '',
          code: serviceType.STATUT_DOCUMENT,

          type: "SERVICE"
      },
      {
          id: 4,
          level: 8,
          code: serviceType.TROUVER_CENTRE,
          title: "Trouver un centre",
          imgUrl: "/assets/vue/imgs/others/map.jpeg",
          nameUrl: 'on-site-enrolment',
          type: "SERVICE"
      },*/
];

const state = {
    isLoading: false,
    services: initialData,
    oneService: null
};
const getters = {
    IS_LOADING_SERVICES: (state) => state.isLoading,
    GET_SERVICES: (state) => state.services,
    GET_ONE_SERVICE: (state) => state.oneService
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_SERVICES(state, payload) {
        state.services = payload;
    },
    SET_ONE_SERVICE(state, payload) {
        state.oneService = payload;
    }
};
const actions = {

    // eslint-disable-next-line no-unused-vars
    FETCH_SERVICES({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get('/api/get-services').then(responseAxios => {
            commit("SET_SERVICES", responseAxios.data ?? []);
        }).catch((err) => {
            commit("SET_SERVICES", []);
            console.log("err", err);
        }).finally(() => {
            commit("SET_LOADING", false);
        });
    },
    // eslint-disable-next-line no-unused-vars
    FETCH_ONE_SERVICE({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/services/one/${payload.id}`).then(responseAxios => {
            commit("SET_ONE_SERVICE", responseAxios.data);
        }).catch((err) => {
            commit("SET_ONE_SERVICE", null);
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
