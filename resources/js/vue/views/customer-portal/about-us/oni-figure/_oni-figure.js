// @vue/component
import {mapActions, mapGetters} from "vuex";
import OniInNumber from "../../../../components/OniInNumber";
import EmptyState from "../../../../components/shared/EmptyState.vue";
import ProductDocu from "../../../../components/shared/ProductDocu";
import SmallBanner from "../../../../components/shared/SmallBanner";
import {TAGS_CONTENTE} from "../../../../core/constants";

export default {
    name: 'OniFigure',
    components: {
        EmptyState,
        SmallBanner,
        OniInNumber,
        ProductDocu
    },
    mixins: [],

    props: {},

    data() {
        return {
            title: "RADIANGN EN CHIFFRES"
        }
    },
    computed: {
        ...mapGetters({
            isLoading: "IS_LOADING_OTHER",
            content: "GET_ONINUMBER"
        }),
        ...mapActions(['FETCH_CONTENT'])
    },

    mounted() {
        this.fetchContent();
    },

    methods: {
        fetchContent() {
            this.$store.dispatch('FETCH_CONTENT', {tag: TAGS_CONTENTE["ONI_EN_CHIFFRE"]})
        }
    }
}
