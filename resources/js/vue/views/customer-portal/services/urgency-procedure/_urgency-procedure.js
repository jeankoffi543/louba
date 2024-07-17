// @vue/component
import ProductDocu from "../../../../components/shared/ProductDocu.vue";
import SmallBanner from "../../../../components/shared/SmallBanner.vue";

export default {
    name: 'UrgencyProcedure',

    components: {
        ProductDocu,
        SmallBanner
    },


    mixins: [],

    props: {},

    data() {
        return {
            title: "CAS D’URGENCES SANITAIRE",
            urgencyProcedure: [
                {
                    name: "Service",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Procedure d'urgence",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Statut de mon document",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                },
                {
                    name: "Trouve un centre",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."
                }


            ]
        }
    },

    computed: {},

    watch: {},

    created() {
    },

    methods: {}
}
