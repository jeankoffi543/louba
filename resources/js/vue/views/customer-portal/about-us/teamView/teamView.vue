<template>
    <div class="teamView">
        <SmallBanner :title="title"></SmallBanner>
    </div>
    <div class="mt-5">
        <div class="container col-md-9">
            <div v-loading="isLoading" class="row">
                <EmptyState v-if="teams.length===0" class="col-sm-12 col-md-12" @reload="fetchData"/>
                <div v-for="(team, index) in teams" v-else :key="index" class="col-sm-12 col-md-3">
                    <div class="item-team d-flex flex-column align-left">
                        <div class="container-img">
                            <img :src="imageUser(team)" alt="">
                        </div>
                        <h5 class="fullname">{{ team?.nom_prenom }}</h5>
                        <p class="poste oni-color-primary app-text-uppercase italic">{{ team?.poste }}</p>
                        <h6 class="role">{{ team?.description }}</h6>
                        <div class="member-social d-flex flex-row justify-content-evenly align-center">
                            <div class="icon">
                                <i class="bi bi-twitter"></i>
                            </div>
                            <div class="icon">
                                <i class="bi bi-facebook"></i>
                            </div>
                            <div class="icon">
                                <i class="bi bi-dribbble"></i>
                            </div>
                            <div class="icon">
                                <i class="bi bi-linkedin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script lang="js" src="./_teamView.js"></script>
<style lang="less" scoped src="./_teamView.less"></style>
