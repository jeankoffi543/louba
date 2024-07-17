// @vue/component
import ItemListeApp from "../../../../components/shared/ItemListeApp";
import DownloadDf from "../../../../components/shared/DownloadDf";
import SmallBanner from '../../../../components/shared/SmallBanner.vue';

export default {
    name: 'ListCenterSejour',

    components: {
        DownloadDf,
        ItemListeApp,
        SmallBanner
    },

    mixins: [],

    props: {},

    data () {
        return {
            title: "LISTE DES CENTRES D'ENROLEMENTS ET DE RETRAITS (TITRE DE SEJOUR) ",
            sousTitre:"NOS PRODUITS",
            data_sites:[

                {
                    name: 'Conakry',
                    centres: [
                        {
                            localite: 'Conakry',
                            localisation: 'coleah',
                        }
                    ],

                },
                {
                    name: 'conakry',
                    centres: [
                        {
                            localite: 'conakry 2',
                            localisation: 'coleah 2',
                        }
                    ],

                }
            ],
        }
    },

    computed: {},

    watch: {},

    created () {},

    methods: {}
}
