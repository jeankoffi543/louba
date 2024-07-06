// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";
import {mapActions, mapGetters} from "vuex";
import {productType} from '../../../core/constants';

export default {
    name: "ObjectAppointment",
    components: {
        ButtonApp,
    },
    mixins: [],
    props: {},
    mounted() {
        this.fetchData();
    },
    data() {
        return {};
    },
    computed: {
        ...mapActions(["FETCH_PRODUCTS"]),
        ...mapGetters({
            products: "GET_PRODUCTS",
            objectAppointmentSelected: "GET_OBJECT_APPOINTMENT_SELECTED",
            loading: "IS_LOADING_PRODUCTS",
        }),

    },
    watch: {},

    created() {
        console.log("objectAppointmentSelected", this.objectAppointmentSelected);
    },

    methods: {
        fetchData() {
            this.$store.dispatch('FETCH_PRODUCTS');
        },
        radioAppointmentChange(item) {
            this.$store.dispatch('OBJECT_APPOINTMENTS_SELECTED', item);
        },
        prevStep() {
            this.$router.push({name: "index"});
        },
        nextFormInfo() {
            switch (this.objectAppointmentSelected?.code) {
                case productType.PASSEPORT:
                    this.$router.push({name: 'appointment-step-two'});
                    break;
                case "VISA":
                    this.$router.push({name: 'appointment-step-first'});
                    break;
                case productType.TITRE_SEJOUR:
                    // localStorage.removeItem('typeRequest');
                    this.$store.dispatch('TYPE_APPOINTMENT_SELECTED', null);
                    this.$router.push({name: 'appointment-step-three'});
                    break;
                case productType.CNI:
                    this.$store.dispatch('TYPE_APPOINTMENT_SELECTED', null);
                    this.$router.push({name: 'appointment-step-three'});
                    break;
                default:
                    this.$router.push({name: 'appointment-start'});
                    break;
            }
        },
    },
};
