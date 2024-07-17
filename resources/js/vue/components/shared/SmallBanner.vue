 <template>
  <div class="container-fluid bg-small-banner position-relative d-flex align-items-center">
    <div class="overlay"></div>

    <div class="container">
      <p class="fw-light text-white fs-4" v-if="sousTitre">
        {{ sousTitre  }}

      </p>
      <p class="fw-bolder oni-color-secondary fs-1 text-uppercase">
       {{ title.toLowerCase()}}
      </p>

    </div>

  </div>
</template>

<script>


export default {
  name: "SmallBanner",
  props: {
    title: {
      type: String,
    },
    sousTitre: { type : String}
  },
}
</script>
<style>
.bg-small-banner {

  background-image: url('/assets/imgs/others/passeport.png');
  background-size: cover;
  height: 150px;
}

.overlay {
  position: absolute;
  background-color: #000;
  background-size: cover;
  opacity: 50%;
  top: 0;
  left: 0;
  width: 100%;
  right: 0;
  contain: "";
  bottom: 0;
}
</style>
