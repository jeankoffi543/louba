import axios from "axios";

/*const initialData = [
    {
        id: 1,
        level: 1,
        title: "Passeport biométrique",
        code: productType.PASSEPORT,
        imgUrl: "/assets/vue/imgs/others/passport-specimen.png",
        nameUrl: 'passport',
        type: "PRODUCT"
    },
    {
        id: 2,
        level: 2,
        title: "Visa",
        code: productType.VISA,
        imgUrl: "/assets/vue/imgs/others/visa.jpg",
        nameUrl: 'list-docs-visa',
        type: "PRODUCT"
    },
    {
        id: 3,
        level: 3,
        title: "Titre de séjour",
        code: productType.TITRE_SEJOUR,
        imgUrl: "/assets/vue/imgs/others/passport-green.png",
        nameUrl: 'titre-sejour',
        type: "PRODUCT"
    },
    {
        id: 4,
        level: 4,
        title: "Carte d’identité biométrique",
        code: productType.CNI,
        imgUrl: "/assets/vue/imgs/others/carte-identite.jpg",
        nameUrl: 'cni-list-docs',
        type: "PRODUCT"
    },

];*/
/* [
    {
        id: 1,
        level: 1,
        title: "Passeport biométrique",
        code: productType.PASSEPORT,
        imgUrl: "/assets/vue/imgs/others/passport-specimen.png",
        nameUrl: 'passport',
        type: "PRODUCT"
    },
    {
        id: 2,
        level: 2,
        title: "Visa",
        code: productType.VISA,
        imgUrl: "/assets/vue/imgs/others/visa.jpg",
        nameUrl: 'list-docs-visa',
        type: "PRODUCT"
    },
    {
        id: 3,
        level: 3,
        title: "Titre de séjour",
        code: productType.TITRE_SEJOUR,
        imgUrl: "/assets/vue/imgs/others/passport-green.png",
        nameUrl: 'titre-sejour',
        type: "PRODUCT"
    },
    {
        id: 4,
        level: 4,
        title: "Carte d’identité biométrique",
        code: productType.CNI,
        imgUrl: "/assets/vue/imgs/others/carte-identite.jpg",
        nameUrl: 'cni-list-docs',
        type: "PRODUCT"
    },
    {
        id: 5,
        level: 5,
        title: "Services VIP",
        code: serviceType.SERVICES_VIP,
        imgUrl: "/assets/vue/illustration/illustration_services_vip_oneci.svg",
        nameUrl: 'service-vip',
        type: "SERVICE"
    },
    {
        id: 6,
        level: 6,
        code: serviceType.PROCEDURE_URGENCE,
        title: "Procédure d'urgence",
        imgUrl: "/assets/vue/imgs/others/urgence.jpg",
        nameUrl: 'process-evacuation-sanitary',
        type: "SERVICE"
    },
    {
        id: 7,
        level: 7,
        title: "Statut de mon document",
        imgUrl: "/assets/vue/imgs/others/progress.jpg",
        nameUrl: '',
        code: serviceType.STATUT_DOCUMENT,
        type: "SERVICE"
    },
    {
        id: 8,
        level: 8,
        code: serviceType.TROUVER_CENTRE,
        title: "Trouver un centre",
        imgUrl: "/assets/vue/imgs/others/map.jpeg",
        nameUrl: 'on-site-enrolment',
        type: "SERVICE"
    }
];*/
const allProducts = []

const state = {
    isLoading: false,
    allProducts: allProducts,
    products: [],
    oneProduct: null
};
const getters = {
    IS_LOADING_PRODUCTS: (state) => state.isLoading,
    GET_PRODUCTS: (state) => state.products,
    // GET_SERVICES: (state) => state.allProducts.filter(it => it.type === CategoryProduct.SERVICE).sort((a, b) => a.order - b.order),
    GET_ALL_PRODUCTS: (state) => state.allProducts.sort((a, b) => a.order - b.order),
    GET_ONE_PRODUCT: (state) => state.oneProduct
};

const mutations = {
    SET_LOADING(state, payload) {
        state.isLoading = payload;
    },
    SET_PRODUCTS(state, payload) {
        state.products = payload;
    },
    SET_ONE_PRODUCT(state, payload) {
        state.oneProduct = payload;
    }

};
const actions = {

    FETCH_PRODUCTS({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/api/get-products`)
            .then(responseAxios => {
                commit("SET_PRODUCTS", responseAxios.data ?? []);
            })
            .catch((err) => {
                commit("SET_PRODUCTS", []);
                console.log("err", err);
            }).finally(() => {
            commit("SET_LOADING", false);
        });
    },

    // eslint-disable-next-line no-unused-vars
    FETCH_ONE_PRODUCT({state, commit}, payload) {
        commit("SET_LOADING", true);
        axios.get(`/products/one/${payload.id}`).then(responseAxios => {
            commit("SET_ONE_PRODUCT", responseAxios.data);
        }).catch((err) => {
            commit("SET_ONE_PRODUCT", null);
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
