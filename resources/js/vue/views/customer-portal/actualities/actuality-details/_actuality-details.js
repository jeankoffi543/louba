// @vue/component
import ActualityApp from "../../../../components/ActualityApp";
import {mapActions, mapGetters, mapState} from "vuex";

export default {
    name: 'ActualityDetails',

    components: {
        ActualityApp
    },

    mixins: [],

    props: {},

    data() {
        return {};
    },

    computed: {
        ...mapState(["ACTUALITIES"]),
        ...mapActions(["FETCH_ONE_ACTUALITY"]),
        ...mapGetters({
            isLoading: "IS_LOADING_ACTUALITIES",
            actuality: "GET_ONE_ACTUALITY",
        }),
    },
    methods: {

        fetchData() {
            const id = this.$route.params.id;
            this.$store.dispatch('FETCH_ONE_ACTUALITY', {id});
        },

        generateSource(source) {
            if (source.startsWith('http')) {
                return `<a href="${source}" target="_blank">${source}</a>`
            }
            return `<span>${source ?? "-"}</span>`;
        }
    },
    mounted() {
        this.fetchData();
    },
    watch: {
        '$route'() {
            this.fetchData();
        }
    },

    created() {

    },
};
