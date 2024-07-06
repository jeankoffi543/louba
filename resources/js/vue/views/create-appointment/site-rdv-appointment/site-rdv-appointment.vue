<template>
  <div class="object-appointment">
    <div class="appointment-title text-center">
      <h3 class="app-m-0 fs-3 text-uppercase">Centre d’enrôlement </h3>
    </div>
    <div class="container-fluid">
      <div class="row container-appointment-form-row justify-content-center">

        <div class="item-request-type col-sm-12 col-md-6 col-lg-3 mb-2"
             v-for="(item, index) in locationsAppointment"
             :key="index"
             @click="radioAppointmentChange(item)"
        >
          <div class="card" :class="{selected : item.id == locationsEnrolmentsSelected?.id} ">
            <div class="item-request-type-head mt-3 text-center border-0"
                 style="flex: 1 1 auto; justify-content: space-around;">
              <img src="/assets/vue/imgs/others/map.png" width="100" class="rounded-circle border-3 border-primary">
            </div>
            <h4 class="my-0 fw-bold text-center" style="margin: 13px 0px !important;">{{ item.label }}
            </h4>
            <div class="card-body bg-light">
              <p class="text-center">
                Lorem ipsum dolor sit amet consectetur adipisicing
              </p>
              <div class="d-block text-center">
                <button class="btn bg-oni-primary text-light" type="button">Sélectionner</button>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>

    <div class="reduire">
      <div class="app-w-100 app-d-flex app-justify-content-center ">
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

<script lang="js" src="./_site-rdv-appointment.js"></script>
<style lang="less" scoped src="./_site-rdv-appointment.less"></style>
