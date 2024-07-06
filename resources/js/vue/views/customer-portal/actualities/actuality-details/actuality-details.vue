<template>
    <div v-loading.fullscreen.lock="isLoading" class="actuality-details">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 p-0">
                    <div class="container-image">
                        <div :style="{'background-image': 'url('+actuality?.imagebg || actuality?.image+')'}"
                             class="content-bg-image"></div>
                        <div class="title-actuality fw-bold fs-1 py-5 ps-3 mb-3 text-start">
                            <h1>{{ actuality?.titre }} </h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 h-50">
                    <div class="image-front">
                        <img :alt="actuality?.titre" :src="actuality?.image" class="content-img" srcset="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="content-other-info">

                        <p class="fs-3">
                            <span class="text-muted fs-5"><b>Publiée le : </b> {{ actuality?.date }}</span>
                        </p>
                        <p v-if="actuality?.author" class="fs-3">
                            <span class="text-muted fs-5"><b>Auteur : </b> {{ actuality?.author ?? '-' }}</span>
                        </p>
                        <p v-if="actuality?.source" class="fs-3">
                            <span class="text-muted fs-5">
                                <b>Source : </b> <span v-html="generateSource(actuality?.source)"></span>
                            </span>
                        </p>

                    </div>
                </div>

            </div>
        </div>
        <div class="container mt-5 text-center mb-5">
            <div class="container-sm">

                <div class="bg-light p-5 text-start justify">

                    <p v-html="actuality?.description"></p>

                    <p v-html="actuality?.full_description"></p>
                </div>

            </div>
        </div>
        <div class="h mb-5 mt-5">
            <ActualityApp/>
        </div>
    </div>


</template>

<script lang="js" src="./_actuality-details.js"></script>
<style lang="less" scoped src="./_actuality-details.less"></style>
