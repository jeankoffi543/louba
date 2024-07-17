// @vue/component
import EmptyPage from "../../../../components/shared/EmptyPage";
import EmptyState from "../../../../components/shared/EmptyState.vue";
import ProductDocu from "../../../../components/shared/ProductDocu";
import SmallBanner from "../../../../components/shared/SmallBanner";
import {TAGS_CONTENTE} from "../../../../core/constants";
import {mapActions, mapGetters} from "vuex";

export default {
    name: 'SentenseDg',

    components: {
        EmptyState,
        SmallBanner,
        ProductDocu,
        EmptyPage
    },


    mixins: [],

    props: {},

    data() {
        return {
            title: "DIRECTEUR GENERAL"
        }
    },

    computed: {
        ...mapGetters({
            isLoading: "IS_LOADING_OTHER",
            content: "GET_SENTENS_DG"
        }),
        ...mapActions(['FETCH_CONTENT'])
    },

    watch: {},

    mounted() {
        this.fetchContent();
    },

    methods: {
        fetchContent() {
            this.$store.dispatch('FETCH_CONTENT', {tag: TAGS_CONTENTE["DG"]})
        }
    }
}
