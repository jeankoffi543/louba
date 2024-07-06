// @vue/component
import ItemListDocument from '../../../../components/shared/ItemListDocument.vue';
import DownloadDf from '../../../../components/shared/DownloadDf.vue';
import SmallBanner from '../../../../components/shared/SmallBanner.vue';

export default {
    name: 'ListDocSejour',

    components: {
        ItemListDocument,
        DownloadDf,
        SmallBanner
    },

    mixins: [],

    props: {},

    data () {
        return {
          title: ' TITRE DE SEJOUR',
            data: [
                {
                    id: 1,
                    title: 'titre 1',
                    documents: ['document 1', 'document 2']
                },
                {
                    id: 2,
                    title: 'titre 2',
                    documents: ['document 1', 'document 2']
                }
            ],
            processFolder: [
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."}
            ],
            requestFolder: [
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "},
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "},
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "},
                {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "}
            ]
        }
    },

    computed: {},

    watch: {},

    created () {},

    methods: {}
}
