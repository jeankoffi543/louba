// @vue/component
import ItemListeApp from "../../../../components/shared/ItemListeApp";
import DownloadDf from "../../../../components/shared/DownloadDf";
import SmallBanner from '../../../../components/shared/SmallBanner.vue';


export default {
    name: 'ListCenterVisa',

    components: {
        ItemListeApp,
        DownloadDf,
        SmallBanner
    },

    mixins: [],

    props: {},

    data() {
        return {
            title: "LISTE DES CENTRES D'ENROLEMENTS ET DE RETRAITS ( VISA)",
            sousTitre:"NOS PRODUITS",

            data_sites:[

                {
                    name: 'conakry',
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

    created() {
    },

    methods: {
    }
}
