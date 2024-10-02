// @vue/component
import {mapActions, mapGetters} from "vuex";
import EmptyState from "../../../components/shared/EmptyState.vue";
import ItemDocumentBrouillon from "../../../components/shared/ItemDocumentBrouillon";

export default {
    name: "ListBrouillon",

    components: {EmptyState, ItemDocumentBrouillon},

    mixins: [],

    props: {},

    data() {
        return {};
    },
    computed: {
        ...mapActions(["FETCH_APPOINTMENT_BROUILLON"]),
        ...mapGetters({
            isLoading: "IS_LOADING_APPOINTMENT",
            documentsAppointment: "GET_APPOINTMENT_BROUILLON"
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
            this.$store.dispatch("FETCH_APPOINTMENT_BROUILLON");
        }
    }
};
