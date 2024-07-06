<template>
  <div class="container mt-5 back p-1 mb-0" style="color: #FFFFFF">
    <!--    <div class="container">
          <h3 class="border-bottom pb-3 ">PLAN DU SITE</h3>
          <footer class="mt-5">

            <div class="row">
              <div class="col-sm-12 col-md-6 col-lg  mb-3">
                <h5 class="border-bottom text-muted ">Qui nous sommes</h5>

                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                    <router-link :to="{name:'presentation-oni'}" class="text-decoration-none text-light">Presentation
                    </router-link>
                  </li>
                  <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                    <router-link :to="{name:'list-of-enrolment-centres'}" class="text-decoration-none text-light">Centres
                      d’enrôlements </router-link>
                  </li>
                  <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                    <router-link :to="{name:'list-ambassade'}" class="text-decoration-none text-light">Ambassades
                    </router-link>
                  </li>



                </ul>

              </div>
              <div class="col-sm-12 col-md-6 col-lg-6  mb-3">
                <h5 class="border-bottom text-muted ">Nos Produits</h5>
                <ul class="nav  d-flex justify-content-between">
                  <li class="nav-item mb-2 ">
                    <a href="#" class="nav-link p-0 oni-color-secondary  fs-5 fw-bold">Passeport</a>

                    <ul class="nav flex-column ">
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name:'ordinary-passport'}" class="text-decoration-none text-light">Passeport
                          Ordinaire</router-link>

                      </li>
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name:'passeport-diplomatique'}" class="text-decoration-none text-light">Passeport
                          Diplomatique</router-link>

                      </li>
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name:'product-services'}" class="text-decoration-none text-light">Passeport de
                          Service</router-link>

                      </li>

                    </ul>


                  </li>
                  <li class="nav-item mb-2 "><a href="#" class="nav-link p-0 oni-color-secondary fw-bold">Visa</a>

                    <ul class="nav flex-column ">
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name: 'list-docs-visa'}" class="dropdown-item">
                          Procedure d'obtention
                        </router-link>
                      </li>
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name: 'visa-centers'}" class="dropdown-item">
                          Centre d’enrôlement et de retrait
                        </router-link>
                      </li>
                      <router-link class="dropdown-item" to="#" @click="openWindow"><i
                            class="bi bi-box-arrow-up-right icon-color me-2"></i>
                          E-visa
                        </router-link>
                    </ul>

                  </li>
                  <li class="nav-item mb-2 "><a href="#" class="nav-link p-0 oni-color-secondary fw-bold">Titre de
                      séjour</a>


                    <ul class="nav flex-column ">
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name: 'titre-sejour'}" class="dropdown-item">
                          Procedure d'obtention
                        </router-link>
                      </li>
                      <router-link :to="{name: 'titre-sejour-centres'}" class="dropdown-item">
                        Centre d’enrôlement et de retrait
                      </router-link>
                    </ul>

                  </li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 oni-color-secondary fw-bold">Carte nationale
                      d'identité</a>


                    <ul class="nav flex-column ">
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>


                        <router-link :to="{name: 'cni-list-docs'}" class="dropdown-item">
                          Procedure d'obtention
                        </router-link>
                      </li>
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name: 'cni-vip-service'}" class="dropdown-item">
                          Centre d’enrôlement et de retrait
                        </router-link>
                      </li>


                    </ul>

                  </li>


                </ul>
              </div>
              <div class="col-sm-12 col-md-6 col-lg  mb-3">
                <h5 class="border-bottom text-muted ">Nos Services</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 oni-color-secondary fw-bold">Services</a>

                    <ul class="nav flex-column ">
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name: 'service-vip'}" class="dropdown-item">

                          Service VIP
                        </router-link>
                      </li>
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name: 'on-site-enrolment'}" class="dropdown-item">
                          Enrôlement sur site
                        </router-link>
                      </li>
                      <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                        <router-link :to="{name: 'process-evacuation-sanitary'}" class="dropdown-item">
                          Procédure d’évacuation sanitaire
                        </router-link>
                      </li>
                      <li class="nav-item mb-2">
                        <router-link :to="{name: 'process-student'}" class="dropdown-item">
                          Document de voyage pour etudiant
                        </router-link>
                      </li>

                      <li class="nav-item mb-2">
                        <router-link :to="{name: 'pilgrimage'}" class="dropdown-item">
                          Pélérinage
                        </router-link>
                      </li>
                      <li class="nav-item mb-2">
                        <router-link :to="{name: 'reclamation'}" class="dropdown-item">
                          Réclamations
                        </router-link>

                      </li>



                    </ul>


                  </li>



                </ul>
              </div>
              <div class="col-sm-12 col-md-6 col-lg col-md-2 mb-3">
                <h5 class="border-bottom text-muted">Divers</h5>

                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                    <router-link class="dropdown-item" :to="{name: 'documentation'}">

                          Documentations
                        </router-link>

                  </li>
                  <li class="nav-item mb-2"><i class="bi bi-caret-right-fill"></i>
                    <router-link class="dropdown-item" :to="{name: 'mediatheque'}">

                          Médiathèque
                        </router-link>
                  </li>


                </ul>

              </div>

              &lt;!&ndash; <div class="col-sm-12 col-md-3 col-lg-3  mb-3 d-flex align-items-end">
                  <form>
                      <h5>Abonnez-vous à notre Newsletter pour ne rien rater sur les actualités de l'ONECI.</h5>
                      <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                          <label for="newsletter1" class="visually-hidden">Email address</label>
                          <input id="newsletter1" type="email" class="form-control" placeholder="Email address">
                          <button class="btn bg-oni-secondary fw-bold" type="button">Souscrire</button>
                      </div>
                  </form>
              </div> &ndash;&gt;
            </div>


          </footer>

        </div>-->

    <div class="container">
      <footer class="mt-5">

        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12  mb-3">
            <ul class="row">
              <li class="col-sm-12 col-md-2  mb-3">Recrutement</li>
              <li class=" col-md-1 bar-space ">|</li>
              <li class="col-sm-12 col-md-2  mb-3">Nous contacter</li>
              <li class=" col-md-1 bar-space">|</li>
              <li class="col-sm-12 col-md-2  mb-3">Appels d'offres</li>
              <li class=" col-md-1 bar-space">|</li>
              <li class="col-sm-12 col-md-2  mb-3">Mentions légales</li>
            </ul>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-12 text-end mb-3 social-network">
            <i class="bi bi-facebook"></i>
            <i class="bi bi-twitter"></i>
            <i class="bi bi-youtube"></i>
            <i class="bi bi-linkedin"></i>
          </div>
        </div>


      </footer>

    </div>

  </div>
</template>

<script>
export default {
  name: "PlanSiteApp",
  methods: {
    openWindow() {
      window.open("https://www.paf.gov.gn/visa", "_blank");
    }
  }
};
</script>


<style lang="less" scoped>
ul {
  display: flex;
  justify-content: space-evenly;
  align-content: center;

  li {
    list-style: none;
    margin-left: 1rem;
    color: #FFF;font-weight: bold;
  }
}

.bar-space {
  color: var(--secondaryColor)
}

.back {
  background-color: #008d5c;
}

.border-bottom.text-muted {
  color: #FFFFFF !important;
}

.nav-item {
  cursor: pointer;
  // &:hover {
  //   color: #CE1126 !important;
  // }
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

@media (min-width: 576px) {
  .d-sm-none{
    display: none !important;
  }
}
</style>
