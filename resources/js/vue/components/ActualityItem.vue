<template>
    <div class="col-sm-12 col-md-4 col-lg-3 app-cursor-pointer">

        <div class="card mb-4 rounded border-0 shadow">
            <div :style="{'background-image': 'url('+getBackgroundImage()+')'}" class="rounded-0 mx-2 pt-3 container-img">
                <!--                <div class="content-img">
                                    <img :src="actuality?.image" class="img"/>
                                </div>-->
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <el-tooltip
                        :content="actuality?.titre"
                        class="box-item"
                        effect="dark"
                        placement="top">
                        <h4 class="text-start app-text-ellipsis">{{ actuality?.titre }}</h4>

                    </el-tooltip>
                    <p class="text-start time">
                        <i class="bi bi-clock me-2"></i>
                        <span class="text-muted">{{ actuality?.date }}</span>
                    </p>
                    <div class=" text-start fs-4">
                        <p class="m-0 description app-text-ellipsis "
                           v-html="actuality?.description"></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ActualityItem',
    props: {
        actuality: null
    },
    mounted() {
    },

    methods: {

        getBackgroundImage() {
            if (this.actuality?.image) {
                return this.actuality?.image;
            }
            return this.actuality?.imagebg;
        }
    }
};
</script>
<style lang="less" scoped>

.container-img {
    padding-top: 0 !important;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;

    margin: 0 !important;
    height: 150px;
}

.content-img {
    width: 50%;
    margin: auto;
    height: 40%;

    img {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }
}

.description {
    font-size: 17px;
    color: #726e6e;
}

.time {
    display: flex;
    align-items: center;
    font-size: 14px;
}

@media screen and (max-width: 768px) {
}
</style>
