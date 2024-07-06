<template>
    <footer class="mt-5 w-100">
        <div class="bg-grey-louba " style="padding: 2rem;">
            <div class="container m-auto">
                <div class="row text-center text-md-center">
                    <div
                        class="col-sm-12 col-md-3 col-lg-3 justify-content-center d-flex justify-content-sm-center mb-1">
                        <div class="container-img">
                            <img alt="" src="/assets/vue/imgs/blason/logoGN.png" style="filter: brightness(0) invert(1);">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <div class="container-fluid site-plan">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <ul class="">
                                        <a class="nav-link p-0 oni-color-secondary  fs-5 fw-bold" href="#">Passeport</a>
                                        <li class="nav-item mb-2">
                                            <i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name:'passport'}"
                                                         class="text-decoration-none text-light">Procedure d'obtention
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name:'list-of-enrolment-centres'}"
                                                         class="text-decoration-none text-light">Centres
                                                d’enrôlements
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name:'list-ambassade'}"
                                                         class="text-decoration-none text-light">Ambassades
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <ul class="">
                                        <a class="nav-link p-0 oni-color-secondary fw-bold" href="#">Visa</a>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'list-docs-visa'}" class="dropdown-item">
                                                Procedure d'obtention
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'visa-centers'}" class="dropdown-item">
                                                Centre d’enrôlement et de retrait
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <i class="bi bi-caret-right-fill"></i>
                                            <router-link class="dropdown-item" to="#" @click="openWindow">
                                                E-visa
                                            </router-link>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <ul class="">
                                        <a class="nav-link p-0 oni-color-secondary fw-bold" href="#">Titre de séjour</a>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'titre-sejour'}"
                                                         class="dropdown-item">
                                                Procedure d'obtention
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'titre-sejour-centres'}" class="dropdown-item">
                                                Centre d’enrôlement et de retrait
                                            </router-link>
                                        </li>


                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <ul class="">
                                        <a class="nav-link p-0 oni-color-secondary fw-bold" href="#">Casier judiciaire</a>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>


                                            <router-link :to="{name: 'cni-list-docs'}" class="dropdown-item">
                                                Procedure d'obtention
                                            </router-link>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <ul class="">
                                        <a class="nav-link p-0 oni-color-secondary fw-bold" href="#">Services</a>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'service-vip'}" class="dropdown-item">
                                                Service VIP
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'on-site-enrolment'}" class="dropdown-item">
                                                Servive express
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'process-evacuation-sanitary'}"
                                                         class="dropdown-item">
                                                Procédure d’évacuation sanitaire
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'process-student'}" class="dropdown-item">
                                               Statut de mon document
                                            </router-link>
                                        </li>

                                        <li class="nav-item mb-2">
                                            <i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'pilgrimage'}" class="dropdown-item">
                                                Pélérinage
                                            </router-link>
                                        </li>
                                        <li class="nav-item mb-2">
                                            <i class="bi bi-caret-right-fill"></i>
                                            <router-link :to="{name: 'reclamation'}" class="dropdown-item">
                                                Réclamations
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="foot w-100">
            <div class="row">
                <div class="col-5">
                    <span class="copyright">© Copyright 2023 Develop. by Radian</span>
                </div>
                <div class="col-7">
                    <div class="col-sm-12 col-md-3 col-lg-3 text-md-end social-network">
                        <div v-for="(social, index) in socialsNetwork"
                             :key="index"
                             class="content-social">
                            <!--  <div class="img"  :style="{'background-image': 'url('+social?.image+')'}"
                                    @click="openLink(social)">
                             </div>-->
                            <img :alt="social?.name" :src="social?.image"
                                 class="img" @click="openLink(social)">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </footer>

</template>

<script>
import LogoApp from "../../components/shared/LogoApp";
import {mapActions, mapGetters} from "vuex";
import {background} from "../../../../../public/assets/vendor/quill/quill";

export default {
    name: "FooterApp",
    components: {
        LogoApp
    },
    computed: {
        ...mapActions(['FETCH_SOCIALS']),
        ...mapGetters({
            socialsNetwork: "GET_SOCIALS",
            isLoading: "IS_LOADING_SOCIALS",
        })

    },
    mounted() {
        this.$store.dispatch("FETCH_SOCIALS")
    },
    methods: {
        background() {
            return background
        },
        openWindow() {
            window.open("https://www.paf.gov.gn/visa", "_blank");
        }
        ,
        openLink(social) {
            if (social && social?.link?.length > 0) {
                window.open(social?.link, "_blank");
            }
        }
    },


};
</script>

<style lang="less" scoped>

.social-network {
    display: flex;

    .content-social {

        width: 38px;
        height: initial;
        margin: auto;
        padding: 0.5px;


        .img {
            object-fit: contain;
            width: 100%;
            height: 100%;
            padding: 7px;
            border-radius: 100px;
            background: #FFF;
            cursor: pointer;
        }
    }
}

.container-img {
    width: 80%;

    img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
}

.foot {
    padding: 1rem;
    color: #FFFF;
    background: #383838;

    .row {
        justify-content: center;
        align-items: center;
        display: flex;

        .col-6 {
            justify-content: center;
            align-items: center;
            display: flex;
        }
    }
}


.site-plan {
    .row {
        .col-sm-12 {
            height: fit-content;
        }
    }
}

ul {
    align-items: flex-start;
    display: flex;
    flex-direction: column;
    padding: 0 !important;

    > a.nav-link {
        text-transform: uppercase;
        font-weight: bold !important;
        font-size: 1.2rem !important;
        align-items: flex-start;
        text-align: start;
    }

    li {
        list-style: none;
        margin-left: 0rem;
        padding: 0;
        color: #FFF;
        font-weight: bold;
    }
}

.dropdown-item {
    white-space: pre-wrap;
}

.border-bottom.text-muted {
    color: #FFFFFF !important;
}

.nav-item {
    cursor: pointer;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    text-align: start;
    margin-left: 0;
}

.nav :hover {
    color: #fff !important;
}

.social-network {
    i {
        color: #FFF;
        font-size: 1.4rem;
        margin-left: 1.4rem;
    }
}


.app-mb-0 {
    margin-bottom: 0 !important;
}

.text-color {
    color: #FFFFFF
}


@media only screen and (min-width: 576px) and (max-width: 768px) {
    .bar-space {
        display: none !important;
    }

    .flex-row-reverse {
        flex-direction: column-reverse;
    }

    .bar-space {
        display: block !important;
    }
}

</style>
