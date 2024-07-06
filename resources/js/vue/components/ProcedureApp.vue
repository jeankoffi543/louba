<template>
  <!-- <div class="container mt-5">
    <div class="col-lg-12 text-light  mt-5">
      <h1 class=" fw-bold oni-color-secondary fs-1">
        Procédure d’obtention  de papiers
      </h1>
      <img alt="" src="/assets/vue/divider-red.png" />
    </div>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 col-lg-4   ">
          <blockquote class="landing-quote">
            <div class="card-body p-4" data-aos="zoom-in-right">
              <div
                class=" mb-3 oni-color-secondary bg-oni-primary p-3 rounded-2 "
              >
                <div>
                  <i class="bi bi-credit-card-2-front-fill fs-1"></i>
                </div>
                <div class="ps-3">
                  <h5 class="mb-1 mt-2">Passeport Biometrique</h5>
                </div>
              </div>
              <div class="lead mb-2 oni-color-primary">
                <ul class="list-unstyled">
                  <li>
                    <i class="bi bi-check-lg"></i>Avoir un reçu de paiement
                    Ecobank de 500 000 GNF pour le passeport de 5ans et 1 000
                    000 GNF pour celui de 10ans.
                  </li>
                  <li>
                    <i class="bi bi-check-lg"></i>Disposez de votre extrait de
                    naissance, acte de naissance ou carte d’identite nationale
                    guinéenn.e
                  </li>
                  <li>
                    <i class="bi bi-check-lg"></i>Disposez de votre extrait de
                    naissance, acte de naissance ou carte d’identite nationale
                    guinéenn.e
                  </li>
                  <li>
                    <i class="bi bi-check-lg"></i>Disposez de deux (2) photos
                    d’identite fond rouge.
                  </li>
                </ul>
              </div>
            </div>
          </blockquote>
        </div>
        <div class="col-md-6 col-lg-4 oni-color-secondary  ">
          <blockquote class="landing-quote">
            <div class="card-body p-4">
              <div
                class="d-flex align-items-center mb-3 bg-oni-primary p-3 rounded-2"
                data-aos="zoom-in"
              >
                <div>
                  <i class="bi bi-person-lines-fill fs-1"></i>
                </div>
                <div class="ps-3">
                  <h5 class="mb-1 mt-2">Carte d'identité</h5>
                </div>
              </div>
              <p class="lead mb-2 text-muted">En redaction...</p>
            </div>
          </blockquote>
        </div>
        <div class="col-md-6 col-lg-4 oni-color-secondary ">
          <blockquote class="landing-quote ">
            <div class="card-body p-4" data-aos="zoom-in-left">
              <div
                class="d-flex align-items-center mb-3 bg-oni-primary p-3 rounded-2"
              >
                <div>
                  <i class="bi bi-airplane-fill fs-1"></i>
                </div>
                <div class="ps-3">
                  <h5 class="mb-1 mt-2">Obtention de visa</h5>
                </div>
              </div>
              <p class="lead mb-2 text-muted">En redaction...</p>
            </div>
          </blockquote>
        </div>
      </div>
    </div>
  </div> -->

  <div class="container my-5">
    <div class="col-lg-12 text-light mt-5 mb-4">
      <h1 class="fw-bold oni-color-secondary fs-1">
        Prise de rendez-vous
      </h1>
      <img alt="" src="/assets/vue/imgs/others/divider-red.png"/>
    </div>
    <div v-loading="isLoading" class="row">
      <EmptyState v-if="dataProceedings.length===0" @reload="onReloadData"/>

      <div v-for="item in dataProceedings" v-else :key="item.id" class="col-sm-12 col-lg-3 col-md-6 "
           @click="goAppointment(item)">
        <div class="mb-4 border-top-0">
          <div class="p-0">

            <img :src="item?.illustrator" class="w-100 radius-img" height="300"/>

            <div
                class="w-100 align-items-center d-flex flex-column fw-normal border rounded-0 bg-white p-3 radius-btn change-text"
                type="button">

              <span class="fs-5">{{ item?.title }}</span>
              <button class="btn btn-lg bg-oni-primary fw-lighter text-white mt-2">
                Prendre rendez vous
                <i class="bi bi-arrow-right"></i>
              </button>
            </div>

          </div>

        </div>
      </div>

    </div>
  </div>
</template>
<script>

import {mapActions, mapGetters} from "vuex";
import {KEY_FORM_JSON, productType} from '../core/constants';
import EmptyState from "../components/shared/EmptyState";

export default {
  name: "ProcedureApp",
  components: {EmptyState},
  data() {
    return {
      dataProceedings: []
    };
  },
  computed: {
    ...mapActions(["FETCH_PRODUCTS", 'OBJECT_APPOINTMENTS_SELECTED', 'FORM_DATA_REQUEST']),
    ...mapGetters({
      isLoading: "IS_LOADING_PRODUCTS",
      dataProducts: "GET_PRODUCTS",
    }),
  },
  mounted() {
    this.fetchData();
    this.dataProceedings = this.dataProducts.map((it) => {
      return {
        ...it,
        show: true
      };
    });
  },
  methods: {
    fetchData() {
      this.$store.dispatch('FETCH_PRODUCTS');
    },
    goAppointment: function (item) {
      this.$store.dispatch('OBJECT_APPOINTMENTS_SELECTED', item);
      this.$store.dispatch('FORM_DATA_REQUEST', {
        key: [KEY_FORM_JSON.PRODUCT],
        data: item
      });
      switch (item.code) {
        case productType.PASSEPORT:
          this.$router.push({name: 'appointment-step-two'});
          break;
        case productType.VISA:
          this.$router.push({name: 'appointment-step-first'});
          break;
        case productType.TITRE_SEJOUR:
          this.$store.dispatch('TYPE_APPOINTMENT_SELECTED', null);
          this.$router.push({name: 'appointment-step-three'});
          break;
        case productType.CNI:
          this.$store.dispatch('TYPE_APPOINTMENT_SELECTED', null);
          this.$router.push({name: 'appointment-step-three'});
          break;
        default:
          this.$router.push({name: 'appointment-start'});
          break;
      }
    },

    onReloadData() {
      this.fetchData();
    }
  },


};
</script>

<style scoped>

</style>
