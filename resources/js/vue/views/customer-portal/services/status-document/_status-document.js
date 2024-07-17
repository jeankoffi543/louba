// @vue/component
import ResultSearch from "../../../../components/ResultSearch.vue";
import SearchStatus from "../../../../components/SearchStatus.vue";
import SmallBanner from "../../../../components/shared/SmallBanner.vue";

export default {
    name: 'StatusDocument',

    components: {ResultSearch, SmallBanner, SearchStatus},

    mixins: [],

    props: {},

    data() {
        return {
            title: "Verifier le statut de votre Document"
        }
    },

    computed: {},

    watch: {},

    created() {
    },

    methods: {}
}
