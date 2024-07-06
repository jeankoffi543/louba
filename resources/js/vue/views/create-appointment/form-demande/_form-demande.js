// @vue/component
import ButtonApp from '../../../components/shared/ButtonApp';
import CommonFormAppointment from "../../../components/shared/CommonFormAppointment";
import {mapActions} from "vuex";
import {KEY_FORM_JSON} from '../../../core/constants';

export default {
    name: 'FormDemande',

    components: {ButtonApp, CommonFormAppointment},

    mixins: [],

    props: {},

    data() {
        return {
            formValue: null
        };
    },

    computed: {
        ...mapActions(["FORM_DATA_REQUEST"]),
    },

    watch: {},
    created() {

    },

    methods: {
        onFormValueChange(f) {
            console.log("onFormValueChange f", f);
            const payload = {
                key: [KEY_FORM_JSON.FORM_INFO_USER],
                data: f
            };
            this.$store.dispatch('FORM_DATA_REQUEST', payload);

        },
        nextFormInfo() {
            this.$router.push({name: "appointment-step-site"});
        },

        prevStep() {
            window.history.go(-1);
        },
    }
};
