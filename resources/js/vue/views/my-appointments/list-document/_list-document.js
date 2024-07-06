// @vue/component
import {mapActions, mapGetters} from "vuex";
import EmptyState from "../../../components/shared/EmptyState.vue";
import ItemDocument from "../../../components/shared/ItemDocument";

export default {
    name: "ListDocument",

    components: {EmptyState, ItemDocument},

    mixins: [],

    props: {},

    data() {
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
