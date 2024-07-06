// @vue/component
import {mapActions, mapGetters} from "vuex";
import EmptyState from "../../../components/shared/EmptyState.vue";
import ItemDocument from "../../../components/shared/ItemDocument";

export default {
    name: "StatutDocument",

    components: {EmptyState, ItemDocument},

    mixins: [],

    props: {},

    data() {
        const item = {
            date: "2016-05-02",
            name: "Visa",
            userName: "Koffi ange",
            refDoc: "662215050",
            status: "En cours",
            receipt: "RDV 30-10-2022"
        };

        return {};
    },
    computed: {
        ...mapActions(["FETCH_APPOINTMENT"]),
        ...mapGetters({
            isLoading: "IS_LOADING_APPOINTMENT",
            documentsAppointment: "GET_APPOINTMENT"
        })
    },

    watch: {},

    created() {
    },
    mounted() {
    },
    beforeMount() {
        this.fetchData()
    },
    methods: {
        fetchData() {
            this.$store.dispatch("FETCH_APPOINTMENT");
        }
    }
};
