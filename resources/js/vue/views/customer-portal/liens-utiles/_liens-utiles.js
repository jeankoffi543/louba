// @vue/component
import SmallBanner from '../../../components/shared/SmallBanner.vue';

export default {
    name: 'LiensUtiles',

    components: {
        SmallBanner
    },

    mixins: [],

    props: {},

    data () {
        return {
            title: 'LIENS UTILES' ,

            listing: [
                {
                    id: 1,
                    name: 'Gouvernement de guinée',
                    lien: 'https://presidence.gov.gn/',
                },
                {
                    id: 2,
                    name: 'minspc',
                    lien: 'https://minspc.gov.gn/ ',
                },
                {
                    id: 3,
                    name: 'Mot du directeur central',
                    lien: 'https://www.paf.gov.gn/dnpaf/?page_id=99',
                },
                {
                    id: 4,
                    name: 'La primature',
                    lien: 'https://www.primature.gov.gn/ ',
                },
                {
                    id: 5,
                    name: 'maeciage',
                    lien: 'http://maeciage.gov.gn/ ',
                },

            ]
        }
    },

    computed: {},

    watch: {},

    created () {},

    methods: {}
}
