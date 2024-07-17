// @vue/component
import ProductDocu from "../../../../components/shared/ProductDocu.vue";
import SmallBanner from '../../../../components/shared/SmallBanner.vue';


export default {
    name: 'ListDocVisa',

    components: {
        ProductDocu,
        SmallBanner
    },

    mixins: [],

    props: {},

    data() {
        return {
            title: ' VISAS',
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
            typeVisa: [
                {
                    name: "Entrée",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Transit",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Transbordement",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Prorogation",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Long séjour",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Courtoisie",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Service",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Diplomatique",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "E-visa",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },

            ],
        };


    },

    computed: {},

    watch: {},

    created() {
    },

    methods: {}
}
