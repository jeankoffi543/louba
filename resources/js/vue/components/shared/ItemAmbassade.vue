<template>

  <div class="container">

    <div class="bg-oni-primary text-light rounded-3 p-3 cursor-pointer fw-bold" @click="toggle()">
      <i :class="icon" class="me-3"></i> Republique de cote d'ivoire ( <span>
                <img src="/assets/vue/imgs/others/flag-ci.png" width="15"> )
            </span>
    </div>
    <div v-if="view" class="border rounded-0 p-5 card shadow" style="height: 400px">

      <p class="fw-bold border-bottom w-50"><i class="bi bi-circle-fill me-3 oni-color-primary"></i>Nos
        ambassade Republique de cote d'ivoire</p>


      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm ">
        <div class="col-6 p-2">

          <iframe
              allowfullscreen=""
              height="100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.5374066555505!2d-4.01023508531855!3d5.3345930961302725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1eb528c613f1f%3A0x3b98346a2fbb8216!2sAmbassade%20de%20Guin%C3%A9e%20Conakry%20en%20C%C3%B4te%20d&#39;Ivoire.!5e0!3m2!1sfr!2sci!4v1663300222871!5m2!1sfr!2sci" style="border:0;"
              width="100%"></iframe>


        </div>
        <div class="col-6  d-flex flex-column justify-content-center overflow my-3 px-3">

          <p class="oni-color-primary">
            <i class="bi bi-alarm-fill"></i> Nos horaires
          </p>
          <ul class="list-unstyled text-black">
            <li>lundi - jeudi <span class="fw-bold">09:00–15:00</span></li>
            <li>vendredi <span class="fw-bold">08:00–13:00</span></li>
            <li>samedi- dimanche <span class="text-danger fw-bold">Fermé</span></li>
          </ul>
          <p class=" oni-color-primary">
            <i class="bi bi-geo-alt-fill"></i> Localisation : <span class="text-black">8XMR+RQP, Rue des Bougainvilliers, Abidjan</span>
          </p>

          <button class="btn bg-oni-primary text-light fw-bold">Prise de rendez vous</button>
        </div>

      </div>


    </div>


  </div>

</template>
<script>
export default {
  name: "ItemAmbassade",
  data() {

    return {

      icon: "bi bi-plus-square-fill",
      view: false,
      tableData: [{
        localite: 'Conakry',
        localisation: 'Tomm',

      },
        {
          localite: 'conakry 2',
          localisation: 'Tommm',

        },

      ]

    }

  },
  methods: {

    toggle() {

      this.view = !this.view;
      this.icon = this.view ? "bi bi-x-square-fill" : "bi bi-plus-square-fill"


    }
  }

}
</script>
<style>
.cursor-pointer {

  cursor: pointer;
}

</style>
