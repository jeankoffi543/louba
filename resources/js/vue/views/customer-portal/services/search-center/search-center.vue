<template>
    <div class="search-center">

        <div>

        </div>
        <div v-loading.fullscreen.lock="isLoading" class="container-map">
            <LMap ref="map" v-model:zoom="zoom" :center="centerMap" :fade-animation="true"
                  :max-zoom="maxZoom">



                <LTileLayer layer-type="base"
                            name="OpenStreetMap"
                            url="https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png"

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
    </div>
</template>

<script lang="js" src="./_search-center.js"></script>
<style lang="less" scoped src="./_search-center.less"></style>
