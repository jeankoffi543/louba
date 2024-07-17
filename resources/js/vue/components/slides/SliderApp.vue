<template>
    <div
        :style="{'background-image': 'url('+slide?.image+')'}"
        class="w-100 h-100 p-5 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 position-relative bg-banner oni-font d-flex justify-content-right">
        <div :style="{'background-image': 'url('+slide?.imagebg+')'}" class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7 col-lg-7 p-3 p-lg-5 pt-lg-3 text-light">
                    <!--          <p class=" fs-5">PORTAIL OFFICIEL DE</p>-->
                    <h1 class="display-4  fw-bold lh-1 text-light">
                        <span class="oni-color-secondary mt-3 titre fz-2">
                            {{ slide?.titre }}
                        </span>
                    </h1>
                    <img alt="" class="img-fluid" src="/assets/vue/imgs/others/divider-red.png"/>
                    <p class="lead fs-3">
                        {{ slide?.paragraphe1 }}
                    </p>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start  mb-lg-3">

                        <router-link   to="#" class="btn bg-oni-primary btn-lg text-light" @click="startAppointment">
                            <i class="bi  bi-calendar-check-fill oni-color-secondary me-1"></i> Prise de rendez vous
                        </router-link>

                        <router-link v-if="slide?.boutton.toLowerCase() == 'oui'" class="btn bg-oni-primary btn-lg px-4 text-light"
                                     to="#" @click="aboutUs()">
                            <i class="bi bi-info-circle oni-color-secondary me-1"></i>
                            En savoir plus
                        </router-link>

                    </div>

                </div>
<!--                <div class="col-5"></div>-->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SliderApp",
    props: {
        slide: {}
    },
    mounted() {
        // console.log("slide", this.slide);
    },
    methods: {
        startAppointment() {
            this.$router.push({name: "appointment-start"});
        },

        aboutUs() {
            this.$router.push({name: 'presentation-oni'});
        }
    }
};
</script>
<style scoped>

.overlay {
    position: absolute;
    /*opacity: 60%;*/
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    content: "";
    background-repeat: no-repeat;
    background-position: 50% 0px;
    /*background-image: url("/images/img/slides/slide-1/slide-bg-2.jpg");*/
    background-size: cover !important;
    z-index: -1;
}

.fz-2 {
    font-size: xx-large;
}

.lead {
    font-size: medium !important;
}

.bg-banner {
    /*background-image: url("/imgg/bg1.png");*/
    background-size: auto;
    background-repeat: no-repeat;
    padding-left:40px;
    background-position: 110% 100%;
}

.btn-oni :hover {
    background-color: #000 !important;
}

@media screen and (min-width: 768px) {
    .h-banner {
        height: 100%;
    }
    .titre1{
        font-size:48px;
    }
}

/* Mobile device  */
@media screen and (max-width: 768px) {

    .d-none {
        display: none !important;
    }

    .h-banner {
        height: 100% !important;
    }

    .bg-banner {
    }

}

@media screen and (max-width: 500px) {

   .bg-banner {
   
    background-position: center;
    }

    .titre{
        font-size:30px;
    }

}
</style>
