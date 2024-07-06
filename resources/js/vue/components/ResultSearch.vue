<template>
    <div class="w-100 oni-font mt-4 p-4 ">
        <template v-if="demand == null"></template>
        <template v-else>
            <div class="">
                <h3 class="oni-color-secondary"><span class="fw-bold">Code demande : </span> {{ demand?.code_demande }}
                </h3>
                <p class="">
                    <span class="fw-bold">Statut Demande : </span>
                    <span v-if="sigleDemand?.status_demande == -1"> Echec: dossier non conforme</span>
                    <span v-else-if="sigleDemand?.status_demande == 0">En attente de rendez-vous</span>
                    <span
                        v-else-if="sigleDemand?.status_demande == 1">Rendez-vous fait, maintenant en attente de retrait</span>
                    <span v-else-if="sigleDemand?.status_demande == 2">retrait</span>
                    <span v-else-if="sigleDemand?.status_demande == -2">en attente de paiement</span>
                </p>
                <p class="">
                    <span class="fw-bold">Document Demandé : </span>
                    <span>{{ sigleDemand?.nom_type_document }}</span>
                </p>
                <p class="">
                    <span class="fw-bold">Point d'enrolement : </span>
                    <span>{{ sigleDemand?.nom_pe }}</span>
                </p>
                <p class="">
                    <span class="fw-bold">Date d'enrolement : </span>
                    <span>{{ sigleDemand?.date_enregistrement_demande }}</span>
                </p>
            </div>

            <div v-loading.fullscreen.lock="isLoading" class="container-map">
                <LMap ref="map" v-model:zoom="zoom" :center="centerMap" :fade-animation="true"
                      :max-zoom="maxZoom">

                    <LTileLayer layer-type="base"
                                name="OpenStreetMap"
                                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    ></LTileLayer>

                    <LMarker v-for="(marker, index) in markerLatLng" :key="index" :lat-lng="marker.lngLat">
                        <LTooltip>
                            <p class="uppercase " style="margin: 0;">{{ marker.name }}</p>
                        </LTooltip>
                        <LPopup>
                            <p class="p fw-bold uppercase">Point d'enrolement de {{ marker.name }}</p>
                            <p class="p"><span class="fw-bold">Contact:</span> {{ marker.phone }}</p>
                            <p class="p"><span class="fw-bold">Email:</span> {{ marker.email }}</p>
                            <p class="p"><span class="fw-bold">Longitude:</span> {{ marker.lngLat[0] }}</p>
                            <p class="p"><span class="fw-bold">Latitude:</span> {{ marker.lngLat[1] }}</p>
                        </LPopup>
                    </LMarker>

                </LMap>
            </div>

        </template>
    </div>

</template>

<script>
import LMap from "@vue-leaflet/vue-leaflet/src/components/LMap.vue";
import LMarker from "@vue-leaflet/vue-leaflet/src/components/LMarker.vue";
import LPopup from "@vue-leaflet/vue-leaflet/src/components/LPopup.vue";
import LTileLayer from "@vue-leaflet/vue-leaflet/src/components/LTileLayer.vue";
import LTooltip from "@vue-leaflet/vue-leaflet/src/components/LTooltip.vue";
import {mapGetters} from "vuex";
import MapApp from "./MapApp.vue";

export default {
    name: "ResultSearch",
    components: {LPopup, LTooltip, LMarker, LTileLayer, LMap, MapApp},

    data() {
        return {
            code: "",
            zoom: 13,
            maxZoom: 19,
            centerMapIntial: [9.6412, -13.5784],
        }
    },
    computed: {
        ...mapGetters({
            isLoading: "IS_LOADING_SEARCH_DOCUMENT",
            demand: "GET_RESULT_SEARCH_DOCUMENT"
        }),
        markerLatLng: function () {
            console.log("markerLatLng", this.demand?.demandes)
            return this.demand?.demandes.map((point) => {
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
            if (this.demand && this.demand?.demandes.length > 0) {
                return [JSON.parse(this.demand?.demandes[0].longitude_pe.toString()), JSON.parse(this.demand?.demandes[0].latitude_pe.toString())];
            }
            return this.centerMapIntial;
        },
        sigleDemand: function () {
            console.log("sigleDemand", this.demand?.demandes)
            if (this.demand && this.demand?.demandes.length > 0) {
                return this.demand?.demandes[0];
            }
            return null;
        }
    },
    mounted() {


    },

    methods: {}
};
</script>

<style scoped>

.leaflet-container {
    height: 400px;
    width: 600px;
    max-width: 100%;
    max-height: 100%;
}

.leaflet-bottom {
    display: none;
}

.container-hearder {
    margin: auto;
    justify-content: center;
    align-items: center;
    display: flex;
    flex-direction: column;

}


.container-map {
    height: 500px;
    width: 800px;
    margin: 1rem auto auto;
    border: 2px solid var(--primaryColor);
}


.form-select:focus, .form-control:focus {
    color: #212529;
    background-color: #fff;
    border-color: var(--primaryColor);
    outline: 0;
    box-shadow: 0 0 0 0.25rem var(--primary300Color);
}

.overlay {
    position: absolute;
    background-image: url("/assets/vue/imgs/others/thinking-woman.png");
    filter: blur(1.5rem);
    background-size: cover;
    opacity: 98%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
</style>
