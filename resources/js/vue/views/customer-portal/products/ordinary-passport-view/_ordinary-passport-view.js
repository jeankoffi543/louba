// @vue/component
import EmptyPage from "../../../../components/shared/EmptyPage";
import ProductDocu from '../../../../components/shared/ProductDocu';
import SmallBanner from '../../../../components/shared/SmallBanner.vue';
import {mapGetters} from "vuex";
import {typePassport} from '../../../../core/constants';

export default {
    name: 'OrdinaryPassportView',

    components: {
        EmptyPage,
        ProductDocu,
        SmallBanner
    },

    mixins: [],

    props: {},

    data() {
        return {
            title: 'NOS PRODUITS',
            type: null,
            typePassport: typePassport
        };
    },

    computed: {
        ...mapGetters({
            typesPassports: "GET_TYPES_APPOINTMENTS",
        }),
    },

    watch: {},

    created() {
        this.type = this.typesPassports[0];
    },

    methods: {
        handleClick(item) {
            console.log("item", item);
            this.type = item;
        }
    }
};
