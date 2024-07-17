<template>
  <div class="col-lg-12 text-light text-center mt-5">
    <h1 class="display-4 fw-bold oni-color-secondary fs-2">
      Procédure d’obtention <br />
      de papiers
    </h1>
    <img alt="" src="/assets/vue/imgs/others/divider-red.png" srcset="" />
  </div>
  <div class="container mt-5">
    <div class="container-sm">
      <div class="row mt-5" data-aos="fade-up">
        <div class="col-sm-12 col-md-4 col-lg-2">
          <img
            alt=""
            class="rounded-3"
            src="/assets/vue/imgs/others/passport-green.png"
            srcset=""
            width="200"
          />
        </div>
        <div
          class="d-flex flex-column justify-content-between col-sm-12 col-md-8 col-lg-10 ps-sm-0 ps-md-3 ps-lg-5"
        >
          <h5 class="mb-1 fs-3">
            <i class="bi bi-person-lines-fill fs-1"></i> Carte d'identité
          </h5>

          <p class="">
            Tout étranger doit, pour entrer en République de Guinée être
            titulaire d'un passeport ou d'un titre de voyage en tenant lieu et
            en cours de validité, revêtu d'un visa.
          </p>
          <div class="lead mb-2 oni-color-primary">
            <p class="text-muted">En cours de redaction...</p>
          </div>

          <button
            class="btn btn-outline-primary bg-oni-primary oni-color-secondary fw-bold"
            @click="startAppointment"
          >
            Prise de rendez vous
          </button>
        </div>
      </div>

      <div class="row mt-5" data-aos="fade-down">
        <div
          class="d-flex flex-column justify-content-between col-sm-12 col-md-8 col-lg-10 ps-sm-0 ps-md-3 ps-lg-0"
        >
          <h5 class="mb-1 fs-3">
            <i class="bi bi-credit-card-2-front-fill fs-1"></i> Passeport
            Biometrique
          </h5>
          <p class="">
            Le passeport biométrique guinéen est d'une sécurité sans faille. Il
            est fabriqué suivant la technologie du polycarbonate. Il porte en
            son sein une puce qui embarque les informations de son titulaire. La
            sécurité biométrique qui le sous-tend ne peut être violée.
          </p>
          <div class="lead mb-2 oni-color-primary">
            <ul class="list-unstyled">
              <li>
                <i class="bi bi-check-lg"></i>Avoir un reçu de paiement Ecobank
                de 500 000 GNF pour le passeport de 5ans et 1 000 000 GNF pour
                celui de 10ans.
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

          <button
            class="btn btn-outline-primary bg-oni-primary oni-color-secondary fw-bold"
            @click="startAppointment"
          >
            Prise de rendez vous
          </button>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-2 order-oni">
          <img
            alt=""
            class="rounded-3"
            src="/assets/vue/imgs/others/umprunt-digital.png"
            srcset=""
            width="200"
          />
        </div>
      </div>

      <div class="row mt-5" data-aos="fade-right">
        <div class="col-sm-12 col-md-4 col-lg-2">
          <img
            alt=""
            class="rounded-3"
            src="/assets/vue/imgs/others/thinking-woman.png"
            srcset=""
            width="200"
          />
        </div>
        <div
          class="d-flex flex-column justify-content-between col-sm-12 col-md-8 col-lg-10 ps-sm-0 ps-md-3 ps-lg-5"
        >
          <h5 class="mb-1 fs-3">
            <i class="bi bi-airplane-fill fs-1"></i> Obtention de visa
          </h5>

          <p class="">
            Ce visa est délivré uniquement à tout étranger résidant en Guinée
            après l'expiration de son visa d'entrée unique.
          </p>
          <div class="lead mb-2 oni-color-primary">
            <p class="text-muted">En cours de redaction...</p>
          </div>

          <button
            class="btn btn-outline-primary bg-oni-primary oni-color-secondary fw-bold"
            @click="startAppointment"
          >
            Prise de rendez vous
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ServicePasseport",
  methods: {
    startAppointment() {
      //console.log("startAppointment");
      this.$router.push({ name: "appointment-start" });
    },
  },
};
</script>

<style scoped>
@media screen and (max-width: 768px) {
  .order-oni {
    order: -1;
  }
}
</style>
