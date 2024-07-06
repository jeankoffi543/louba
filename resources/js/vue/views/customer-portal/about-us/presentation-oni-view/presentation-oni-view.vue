<template>
    <div class="">
        <SmallBanner :title="title"></SmallBanner>

        <div v-loading="isLoading" class="container mt-5">

            <div class="row">
                <EmptyState v-if="content == null" class="col-sm-12 col-md-10" @reload="fetchContent"/>
                <template v-else>
                    <div class="col-sm-12 col-md-8">

                        <div>
                            <p class="fw-bold text-black fs-3 border-bottom">
                                {{ content?.titre }}
                            </p>
                            <div class="mb-1 justify" v-html="content?.paragraphe1"></div>


                        </div>
                        <div>
                            <p class="fw-bold text-black fs-3 border-bottom">
                                Structures et lois relatives à l'identification
                            </p>
                            <div class="mb-1 justify" v-html="content?.paragraphe2"></div>
                        </div>


                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div>
                            <img alt="" src="/assets/vue/imgs/others/home-family.png" srcset="" width="200">
                        </div>

                    </div>
                </template>

            </div>

        </div>

        <div class="mt-5" >
            <div class="container">
                <div>
                    <p class="fw-bold text-black fs-3 border-bottom">
                        ÉQUIPE (ORGANIGRAMME)
                    </p>
                </div>


                <div v-loading="IS_LOADING_TEAMS" class="row">
                    <EmptyState v-if="teams.length===0" class="col-sm-12 col-md-12" @reload="fetchDataTeams"/>
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

    </div>
</template>

<script lang="js" src="./_presentation-oni-view.js"></script>
<style lang="less" scoped src="./_presentation-oni-view.less"></style>
