// @vue/component
import {mapActions, mapGetters} from "vuex";

export default {
    name: 'ComplaintPage',

    components: {},

    mixins: [],

    props: {},

    data() {
        return {
            isLoading: false,
            form: {
                fullname: "",
                phone: "",
                subject: "",
                email: "",
                type_request: "0",
                message: ""
            },
            typeRequest: [
                {
                    label: "Réclamations",
                    value: "0"
                },
                {
                    label: "Demande",
                    value: "1"
                }
            ]
        }
    },

    computed: {
        ...mapActions(["SEND_REQUEST"]),
        ...mapGetters({
            isLoading: "IS_LOADING_REQUEST",
            responseMessage: "GET_RESPONSE"
        })
    },

    watch: {},

    created() {
    },

    methods: {

        resetForm() {
            this.form = {
                fullname: "",
                phone: "",
                subject: "",
                email: "",
                type_request: "0",
                message: ""
            }
        },
        onSendMessage() {
            const data = {
                nom_prenom: this.form.fullname,
                email: this.form.email,
                telephone: this.form.phone,
                sujet: this.form.subject,
                message: this.form.message,
                type_request: this.form.type_request
            };
            this.$store.dispatch('SEND_REQUEST', data);
        }
    }
}
