// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";
import {KEY_FORM_JSON, typeAppointment} from '../../../core/constants';
import {mapActions} from "vuex";

export default {
    name: "ObjectAppointment",

    components: {
        ButtonApp,
    },

    mixins: [],

    props: {},
    mounted() {
        this.loading = false;
    },
    data() {
        return {
            loading: Boolean,
            typeAppointmentSelected: null,
            typesAppointments: [
                {
                    label: "evisa",
                    code: typeAppointment.EVISA,
                    checked: false,
                    imgUrl: require('/assets/vue/imgs/others/waiting-amico.png'),
                    id: "1",
                },
                {
                    label: "Résident",
                    code: typeAppointment.RESIDENT,
                    imgUrl: require('/assets/vue/imgs/others/waiting-amico.png'),
                    id: "2",
                    checked: true,
                },
            ],
        };
    },

    computed: {
        ...mapActions(["FORM_DATA_REQUEST"]),
    },

    watch: {},

    created() {
    },

    methods: {
        radioAppointmentChange(item) {
            if (item.code === typeAppointment.EVISA) {
                window.open('https://www.paf.gov.gn/visa', "_blank");
            }
            this.typeAppointmentSelected = item;
            this.$store.dispatch('FORM_DATA_REQUEST', {
                key: [KEY_FORM_JSON.TYPE_REQUEST],
                data: item
            });
        },
        prevStep() {
            window.history.go(-1);
        },
        nextFormInfo() {
            // @Todo control
            this.$router.push({name: "appointment-step-three"});
        },
    },
};
