<script>
import {mapActions, mapGetters} from "vuex";
import SliderApp from "./slides/SliderApp.vue";

export default {
    name: "CarousselApp",
    components: {

        SliderApp
    },
    computed: {
        ...mapActions(['FETCH_SLIDERS']),
        ...mapGetters({
            isLoading: "IS_LOADING_SLIDERS",
            sliders: "GET_SLIDERS"
        })
    },
    beforeMount() {
        this.fetchSliders();
    },
    methods: {
        fetchSliders() {
            this.$store.dispatch('FETCH_SLIDERS')
        }
    }
};
</script>
<template>
    <div v-if="sliders.length > 0" class="">
    <!-- <div v-if="sliders.length > 0" class="container"> -->
        <el-carousel v-loading="isLoading" :autoplay="sliders.length > 0" height="500px" indicator-position="outside">
            <el-carousel-item v-for="(item, index) in sliders" :key="index">
                <SliderApp :slide="item"/>
            </el-carousel-item>
        </el-carousel>
    </div>
    <span v-else></span>
</template>

<style scoped>
.el-carousel__item {
    margin: 0;
    height: inherit;
    overflow-y: hidden;
}

.el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
    background-color: #d3dce6;
}

.el-carousel {
    width: 100%;
    margin: auto;
}
</style>
