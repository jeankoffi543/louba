// @vue/component
import SmallBanner from '../../../../components/shared/SmallBanner.vue';

export default {
    name: 'AmbassadeView',

    components: {
        SmallBanner
    },

    mixins: [],

    data() {

        return {
            title:'NOS AMBASSADES',

            icon: "bi bi-plus-square-fill", view: false, tableData: [

                {
                    id: 1,
                    pays: 'Afrique du Sud - Pretoria',
                    adresse: '336 Orient Street Arcadia, 0083 PO Box 13523 Hatfield, 0028 Pretoria Afrique du Sud',
                    tel: '(2712)342 49 06 /  (2712)342 08 93 /Fax : (2712)342 7348',
                    lien: 'embaguinea@iafrica.com',

                },

                {
                    id: 2,
                    pays: 'Algérie - Algiers',
                    adresse: '47, Boulevard Said Hamdine, Hydra Algiers-Algérie',
                    tel: '(2132) 16 93 611',
                    lien: 'embaguinea@iafrica.com',
                }, {
                    id: 3,
                    pays: 'Allemagne - Berlin',
                    adresse: 'Jägerstrasse 67-69 Berlin 10117 Allemagne',
                    tel: '(49)228 23 10 98 /302 00 74 33 33',
                    lien: 'berlin@ambaguinee.de / info@ambaguinee.de / www.ambaguinee.de',
                }, {
                    id: 4,
                    pays: 'Angola - Luanda',
                    adresse: 'Rua I, Casa W24, Bairro Cassenda Luanda-Angola',
                    tel: '(244) 2223 59 366',
                    lien: '',
                }, {
                    id: 5,
                    pays: 'Arabie Saoudite - Riyad',
                    adresse: 'Embassies Quarter P.O. Box 94326 Riyadh 11693 Arabie Saoudite',
                    tel: '(9661)14881101 / (9661)14881121',
                    lien: 'ryadambaguinee@yahoo.com',
                },


            ]

        }

    }, methods: {

        toggle() {

            this.view = !this.view;
            this.icon = this.view ? "bi bi-x-square-fill" : "bi bi-plus-square-fill"


        }
    },

    props: {},

    computed: {},

    watch: {},

    created() {
    },
}
