// @vue/component
import {mapActions, mapGetters} from "vuex";
import EmptyState from "../../../../components/shared/EmptyState.vue";
import SmallBanner from '../../../../components/shared/SmallBanner.vue';
import {TAGS_CONTENTE} from "../../../../core/constants";
import Teamview from "../teamView/_teamView";

export default {
    name: 'PresentationOniView',

    components: {
        Teamview,
        EmptyState,
        SmallBanner
    },

    mixins: [],

    props: {},

    data() {
        return {
            title: 'QUI NOUS SOMMES'
        }
    },

    computed: {
        ...mapGetters({
            isLoading: "IS_LOADING_OTHER",
            content: "GET_PRESENTATION",
            teams: "GET_TEAMS",
            IS_LOADING_TEAMS: "IS_LOADING_TEAMS"
        }),
        ...mapActions(['FETCH_CONTENT', 'FETCH_TEAMS'])
    },

    watch: {},

    mounted() {
        this.fetchContent();
        this.fetchDataTeams();
    },

    methods: {
        fetchContent() {
            this.$store.dispatch('FETCH_CONTENT', {tag: TAGS_CONTENTE["PRESENTATION"]});
        },
        fetchDataTeams() {
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
