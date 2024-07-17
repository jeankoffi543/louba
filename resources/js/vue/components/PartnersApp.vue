<template>
  <div class="container mt-5 col-md-9">
    <p class="text-start mt-5 fs-1 oni-color-secondary fw-bold">
      Nos Partenaires
    </p>
    <div class="text-start">
      <img alt="" src="/assets/vue/imgs/others/divider-red.png" srcset=""/>
    </div>
    <div v-loading="isLoading" class="row mt-3 text-center">
      <EmptyState v-if="partners.length===0" @reload="onReloadData"/>

      <carousel v-else :items-to-scroll="itemsToScroll" :items-to-show="itemsToShow">

        <slide v-for="(partner, index) in partners" :key="index">
          <ImagePartners :link="partner?.link" :logo-name="partner.logoName" :uri-src="partner.uriSrc"
                         :width="partner?.width"></ImagePartners>
        </slide>
        <template #addons>
          <navigation/>
          <pagination/>
        </template>
      </carousel>


    </div>
  </div>
</template>

<script>
import ImagePartners from "../components/shared/ImagePartners";
import {mapActions, mapGetters, mapState} from "vuex";
import 'vue3-carousel/dist/carousel.css';
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel';
import EmptyState from "../components/shared/EmptyState";

export default {
  name: "PartnersApp",
  components: {
    ImagePartners,
    EmptyState,
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data() {
    return {
      sizeScreenMobile: 767,
      itemsToShow: 6,
      itemsToScroll: 3,
    };
  },
  computed: {
    ...mapState(["PARTNERS"]),
    ...mapActions(["FETCH_PARTNERS"]),
    ...mapGetters({
      partners: "GET_PARTNERS",
      isLoading: "IS_LOADING_PARTNERS",
    }),
  },
  methods: {
    fetchData() {
      this.$store.dispatch('FETCH_PARTNERS');
    },

    myEventHandler(e) {
      if (e?.srcElement?.screen?.width <= this.sizeScreenMobile) {
        this.itemsToShow = 2;
        this.itemsToScroll = 1;
      } else {
        this.itemsToShow = 6;
        this.itemsToScroll = 3;
      }
    },
    onReloadData() {
      this.fetchData();
    },
  },
  mounted() {
    this.fetchData();
    this.myEventHandler();
  },
  created() {
    window.addEventListener("resize", this.myEventHandler);
  },
  unmounted() {
    window.removeEventListener("resize", this.myEventHandler);
  },

};
</script>
<style>
.img {
  border: 1px solid #EEE;

}

.el-carousel__item > div {
  height: 100%;
}

.carousel__slide {
  display: block;
}


</style>
