<template>
  <div class="col">
    <div class=" mb-4 border-top-0">
      <div class="p-0">

        <img :src="item?.imgUrl" height="300" class="w-100 radius-img"/>

        <div class="w-100 btn btn-lg fw-normal border rounded-0  bg-white  p-3  radius-btn change-text" type="button">
          {{ item?.title }}

          <button class="btn btn-lg bg-oni-primary fw-lighter text-white mt-2">
            Prendre rendez vous
            <i class="bi bi-arrow-right"></i>
          </button>
        </div>

      </div>

    </div>
  </div>
</template>


<script>
export default {
  name: "ItemAppointment",
  props: {
    item: null,
  },
  data() {
    return {};
  }
};
</script>

<style scoped>


.border-radius {
  border-radius: 0.5rem;
}

.description-card {

  width: 70%;
  height: 300px;
  font-style: normal;
  font-weight: 300;
  color: #000000;
  text-align: justify;

}

.radius-img {

  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  height: 200px;

}

.radius-btn {

  border-bottom-left-radius: 10px !important;
  border-bottom-right-radius: 10px !important;


}

.change-text :hover {

  color: #fff !important;
}


/* desktop screen */
@media screen and (min-width: 768px) {
  .d-no {
    display: none !important;
  }

  .h-row {

    height: 500px;
  }
}

/* Mobile screen */

@media screen and (max-width: 768px) {
  .d-none {
    display: none !important;
  }
}

.description-card {

  height: 600px;


}
</style>
