// @vue/component

import LMap from "@vue-leaflet/vue-leaflet/src/components/LMap.vue";
import LMarker from "@vue-leaflet/vue-leaflet/src/components/LMarker.vue";
import LPopup from "@vue-leaflet/vue-leaflet/src/components/LPopup.vue";
import LTileLayer from "@vue-leaflet/vue-leaflet/src/components/LTileLayer.vue";
import LTooltip from "@vue-leaflet/vue-leaflet/src/components/LTooltip.vue";
import {mapActions, mapGetters} from "vuex";
import MapApp from "../../../../components/MapApp.vue";

export default {
    name: 'SearchCenter',

    components: {LPopup, LTooltip, LMarker, LTileLayer, LMap, MapApp},

    mixins: [],

    props: {},

    data() {
        return {
            zoom: 13,
            maxZoom: 19,
            centerMapIntial: [9.6412, -13.5784],
        }
    },

    computed: {
        ...mapActions(['FETCH_ENROLMENTS_POINTS']),
        ...mapGetters({
            enrolmentsPoint: "GET_ENROLMENTS_POINTS",
            isLoading: "IS_LOADING_LOCATIONS_ENROLMENTS"
        }),
        markerLatLng: function () {
            return this.enrolmentsPoint.map((point) => {
                return {
                    phone: point.telephone_pe,
                    name: point.nom_pe,
                    email: point.email_pe,
                    lngLat: [
                        JSON.parse(point.longitude_pe.toString()),
                        JSON.parse(point.latitude_pe.toString())
                    ]
                }
            });
        },
        centerMap: function () {
            if (this.enrolmentsPoint.length > 0) {
                return [JSON.parse(this.enrolmentsPoint[0].longitude_pe.toString()), JSON.parse(this.enrolmentsPoint[0].latitude_pe.toString())];
            }
            return this.centerMapIntial;
        }
    },

    watch: {},

    created() {

    },
    updated() {
    },
    beforeMount() {
        this.fetchData()
    },

    methods: {
        fetchData() {
            this.$store.dispatch('FETCH_ENROLMENTS_POINTS');
        }
    }
}
