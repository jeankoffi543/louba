// @vue/component
import {mapActions, mapGetters} from "vuex";
import CalendarApp from "../../../components/CalendarApp";
import ButtonApp from "../../../components/shared/ButtonApp";
import {KEY_FORM_JSON} from "../../../core/constants";

export default {
    name: "ChoiceDateAppointment",

    components: {ButtonApp, CalendarApp},

    mixins: [],

    props: {},

    data() {
        return {
            dateAppointment: new Date(),
            times: [
                {
                    label: "Matin 8h30-12h30",
                    id: 1,
                    checked: true
                },
                {
                    label: "Soir 13h30-17h00",
                    id: 2,
                    checked: false
                }
            ]
        };
    },

    computed: {
        ...mapActions(["FETCH_LOCATIONS_ENROLMENTS"]),
        ...mapActions(["FORM_DATA_REQUEST"]),
        ...mapGetters({
            typeAppointmentSelected: "GET_TYPE_APPOINTMENT_SELECTED",
            locationsAppointment: "GET_LOCATIONS_ENROLMENTS",
            locationsEnrolmentsSelected: "GET_LOCATIONS_ENROLMENTS_SELECTED",
            loading: "IS_LOADING_LOCATIONS_ENROLMENTS",
            dataRequest: "GET_FORM_DATA_REQUEST"
        })
    },

    watch: {},

    created() {
    },

    methods: {


        nextPage() {
            const payload = {
                key: [KEY_FORM_JSON.DATE_APPOINTMENT],
                data: {
                    date: this.dateAppointment,
                    time: this.times.find((it) => it.checked)
                }
            };
            this.$store.dispatch("FORM_DATA_REQUEST", payload);
            console.log(
                "GET_FORM_DATA_REQUEST_VALUE",
                JSON.stringify(this.dataRequest)
            );
            // this.$router.push({name: "pay-appointment"});
        },

        prevStep() {
            window.history.go(-1);
        },
        chooseTime(item) {
            // console.log("this.value", this.value);
            this.times = this.times.map((it) => {
                return {
                    ...it,
                    checked: it.id == item.id
                };
            });
        }
    }
};
