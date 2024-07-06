<template>
  <div class="form-demande">
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-8 overflow-auto">
            <CommonFormAppointment @form-value="onFormValueChange"/>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-4">

            <h1 class="text-muted border-bottom border-3 pb-3">Avertissement </h1>

            <div class="mt-3">
              <p class="text-danger mb-3"><i class="bi bi-exclamation-circle-fill me-3"></i>Tous les champs de ce
                formulaire sont requires *</p>

              <p class="text-danger mb-3"><i class="bi bi-exclamation-circle-fill me-3"></i>Renseignez les bonnes
                informations</p>

              <p class="text-danger mb-3"><i class="bi bi-exclamation-circle-fill me-3"></i>Les caractere speciaux sont
                interdit</p>

            </div>


          </div>

        </div>
      </div>
      <div class="app-w-100 app-d-flex app-d-flex app-justify-content-center">
        <el-row :gutter="24" class="app-w-50">

          <el-col :xs="24" :sm="12" class="mt-3">
            <ButtonApp button-title="Retour" @click="prevStep" :primary-btn="false" block></ButtonApp>
          </el-col>
          <el-col :xs="24" :sm="12" class="mt-3">
            <ButtonApp button-title="Suivant" block @click="nextFormInfo"></ButtonApp>
          </el-col>
        </el-row>

      </div>


    </div>

  </div>
</template>

<script src="./_form-demande.js"></script>
<style src="./_form-demande.less" lang="less" scoped></style>
