// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";
import {mapActions, mapGetters} from "vuex";
import {KEY_FORM_JSON, locationEnrolment, typePassport} from '../../../core/constants';

export default {
    name: "SiteAppointment",

    components: {
        ButtonApp,
    },

    mixins: [],

    props: {},
    mounted() {
    },
    data() {
        return {
        };
    },

    computed: {
        ...mapActions(["FETCH_LOCATIONS_ENROLMENTS", "FORM_DATA_REQUEST"]),
        ...mapGetters({
            typeAppointmentSelected: "GET_TYPE_APPOINTMENT_SELECTED",
            locationsAppointment: "GET_LOCATIONS_ENROLMENTS",
            locationsEnrolmentsSelected: "GET_LOCATIONS_ENROLMENTS_SELECTED",
            loading: "IS_LOADING_LOCATIONS_ENROLMENTS",
        }),
    },

    watch: {},

    created() {
        if (this.typeAppointmentSelected?.code == typePassport.SERIVECES_VIP || this.typeAppointmentSelected?.code == typePassport.EVACUATION_SANITAIRE) {
            const item = this.locationsAppointment.find(el => el.code == locationEnrolment.COLEAH);
            this.radioAppointmentChange(item);
        } else {
            this.radioAppointmentChange(null);
        }
    },

    methods: {
        radioAppointmentChange(item) {
            this.$store.dispatch('LOCATION_ENROLMENT_SELECTED', item);
            this.$store.dispatch('FORM_DATA_REQUEST', {
                key: [KEY_FORM_JSON.SITE_APPOINTMENT],
                data: item
            });
        },

        nextFormInfo() {
            // @Todo control
            this.$router.push({name: "appointment-step-five"});
        },
        prevStep() {
            window.history.go(-1);
        },
        fetchData() {
            this.$store.dispatch('FETCH_LOCATIONS_ENROLMENTS');
        },
    },
};
