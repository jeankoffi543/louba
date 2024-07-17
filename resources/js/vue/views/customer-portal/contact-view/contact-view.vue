<template>
  <div class="contact-view container my-5">

    <div class="container my-5"></div>

    <div class="row align-items-center g-lg-5 py-5">
      <div class="d-no col-md-7 col-lg-7 text-center text-lg-start">
        <img src="/assets/vue/imgs/others/concatus.png" width="350">
        <h1 class="display-4 fw-bold lh-1 mb-3">Contactez le service client de l'office national   </h1>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
					<p class="fs-3 fw-bold oni-color-secondary">Formulaire de Contact</p>

        <form class="p-4 p-md-5 border rounded-3 bg-light">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Votre mail</label>
          </div>
          <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                  style="height: 100px"></textarea>
            <label for="floatingTextarea2">Tapez votre message ...</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary bg-oni-primary" type="submit">Contactez nous</button>
          <hr class="my-4">
          <p class="text-center text-muted">
            By LOUBA  © 2022
          </p>

        </form>
        <p class="text-end mt-2">

          <a  class="text-danger justify fw-bold" href="/public#/nos-services/service-reclamation">
            Pour une reclamation veuillez suivre ce lien
          </a>
        </p>
      </div>
    </div>

  </div>
</template>

<script src="./_contact-view.js" lang="js"></script>
<style src="./_contact-view.less" lang="less" scoped></style>
