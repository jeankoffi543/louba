// @vue/component
import EmptyPage from "../../../../components/shared/EmptyPage";
import ProductDocu from "../../../../components/shared/ProductDocu.vue";
import SmallBanner from "../../../../components/shared/SmallBanner.vue";

export default {
    name: 'ServiceVipView',

    components: {
        EmptyPage,
        ProductDocu,
        SmallBanner
    },

    mixins: [],

    props: {},

    data() {
        return {
            title: 'Service',
            type: null,
            reverseImageId: 1,
            dataServices: [
                {
                    label: "VIP",
                    img: "/assets/vue/illustration/illustration_services_vip_oneci.svg",
                    id: "1",
                    checked: false,
                    hasFile: false,
                    file: null,
                    code: 1
                },
                {
                    label: "EXPRESS",
                    img: "/assets/vue/imgs/others/document.jpg",
                    id: "2",
                    checked: false,
                    hasFile: false,
                    file: null,
                    code: 2
                }]
        };
    },

    computed: {},

    watch: {},

    created() {
        this.type = this.dataServices[0];
    },

    methods: {
        handleClick(item) {
            console.log("item", item);
            this.type = item;
        }
    }
}
