<template>
  <div class=" w-100 oni-font mt-4 p-4">
    <div class="overlay shadow"></div>
    <div class="text-center p-3 text-light" data-aos="fade-down-right">
      <h1 class="fw-bold oni-color-primary fs-1">
        OMNIFORM <br/>
        en chiffres
      </h1>
      <img src="/assets/vue/imgs/others/divider-red.png"/>
    </div>

    <div class="container">
      <div class="row d-flex justify-content-center">
        <p
            class="col-sm-12 col-md-4 col-lg-4 text-center"
            data-aos="zoom-out-up"
        >
          <span class="fs-1 fw-bold oni-color-secondary">500</span> <br/>
          <span class="fs-4 oni-color-primary fw-bold">PRODUITS / JOUR</span>
        </p>
        <p class="col-sm-12 col-md-4 col-lg-4 text-center" data-aos="fade-up">
          <span class="fs-1 fw-bold oni-color-secondary">27</span> <br/>
          <span class="fs-4 oni-color-primary fw-bold"
          >POINTS D'ENRÔLEMENTS</span
          >
        </p>
        <p class="col-sm-12 col-md-4 col-lg-4 text-center" data-aos="zoom-out">
          <span class="fs-1 fw-bold oni-color-secondary">1.5M</span> <br/>
          <span class="fs-4 oni-color-primary fw-bold">
            PASSEPORTS PRODUITS</span
          >
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "OniInNumber",
};
</script>

<style scoped>



.overlay {
  position: absolute;
  background-image: url("/assets/vue/imgs/others/thinking-woman.png");
  filter: blur(1.5rem);
  background-size: cover;
  opacity: 98%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
</style>
