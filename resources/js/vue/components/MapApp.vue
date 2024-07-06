<template>
    <div v-loading.fullscreen.lock="isLoading" class="container-map">
        <LMap ref="map" v-bind:zoom="zoom" :center="centerMap" :fade-animation="true"
              :max-zoom="maxZoom">

            <LTileLayer layer-type="base"
                        name="OpenStreetMap"
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            ></LTileLayer>

            <LMarker v-for="(marker, index) in markerLatLng" :lat-lng="marker.lngLat" :key="index">
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
<script lang="js">
export default {
    name: 'MapComponent',
    props: {
        isLoading: false,
        zoom: {
            type: Number,
            default: 13
        },
        maxZoom: {
            type: Number,
            default: 19
        },
        centerMap: {
            type: Array,
            default: [9.6412, -13.5784]
        },
        markerLatLng: {
            type: Array,
            default: []
        },
    },
    data() {
        return {}
    },
    mounted() {
        console.log("markerLatLng", this.markerLatLng);
    }
}
</script>
