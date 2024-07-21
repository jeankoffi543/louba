<template>
  <div class="fotgetPassword col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

    <div class="d-flex justify-content-center py-4">
      <a class="logo d-flex align-items-center " href="#">
          <img alt="" src="/assets/vue/imgs/logo.png">
      </a>
    </div><!-- End Logo -->

    <div class="card mb-3">

      <div class="card-body">

        <div class="pt-4 pb-2">
          <h5 class="card-title text-center pb-0 fs-4">Mot de passe oublié</h5>
        </div>

        <form  class="row g-3 needs-validation">
          <div class="col-12">
            <label class="form-label" for="yourUsername">Email</label>
            <div class="input-group has-validation">
              <span id="inputGroupPrepend" class="input-group-text">@</span>
              <input id="yourUsername" class="form-control" name="email" required type="email">
              <div class="invalid-feedback">Veuillez entrez votre identifiant.</div>
            </div>
          </div>

          <div class="col-12">
            <button class="btn  w-100 app-btn-primary" type="submit">Soumettre</button>
          </div>

        </form>

      </div>
    </div>

    <div class="credits">
      <router-link :to="{name: 'login'}">Se connecter</router-link>
    </div>

  </div>
</template>

<script src="./_fotgetPassword.js" lang="js"></script>
<style src="./_fotgetPassword.less" lang="less" scoped></style>
