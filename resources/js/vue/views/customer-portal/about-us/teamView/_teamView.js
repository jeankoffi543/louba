// @vue/component
import {mapActions, mapGetters} from "vuex";
import EmptyPage from "../../../../components/shared/EmptyPage";
import EmptyState from "../../../../components/shared/EmptyState.vue";
import ProductDocu from "../../../../components/shared/ProductDocu";
import SmallBanner from "../../../../components/shared/SmallBanner";

export default {
    name: 'Teamview',

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
            title: "ÉQUIPE (ORGANIGRAMME)"
        }
    },

    computed: {
        ...mapGetters({
            teams: "GET_TEAMS",
            isLoading: "IS_LOADING_TEAMS"
        }),
        ...mapActions(['FETCH_TEAMS'])

    },

    watch: {},

    beforeMount() {
        this.fetchData()
    },
    created() {
    },

    methods: {
        fetchData() {
            this.$store.dispatch('FETCH_TEAMS');
        },

        imageUser(user) {
            if (user && user.image) {
                return user.image;
            }
            return "/images/img/team/member-1.jpg"
        }
    }
}
