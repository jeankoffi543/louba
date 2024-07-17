// @vue/component
import {mapActions, mapGetters} from "vuex";

export default {
    name: "NewAppointment",

    components: {},

    mixins: [],

    props: {},

    data() {
        return {
            appointmentStep: [
                // {  pathName: "appointment-step-first"},
                {pathName: "appointment-start"},
                {pathName: "appointment-step-two"},
                {pathName: "appointment-step-three"},
                {pathName: "appointment-step-foor"},
                {pathName: "appointment-step-site"},
                {pathName: "appointment-step-five"}
            ]
        };
    },

    computed: {
        ...mapGetters({
            objectAppointmentSelected: "GET_OBJECT_APPOINTMENT_SELECTED",
            typeRequestSelected: "GET_TYPE_APPOINTMENT_SELECTED"
        }),

        ...mapActions(["FETCH_USER"]),
        getSurfixForm() {
            return this.typeRequestSelected == null
                ? this.objectAppointmentSelected?.title
                : this.typeRequestSelected?.label;
        }
    },

    watch: {},

    created() {
    },
    mounted() {
    },

    methods: {},

    updated() {
        // this.objectAppointment = typeRequest == null ? JSON.parse(objectAppointment)?.label : JSON.parse(typeRequest).label;
    }
};
