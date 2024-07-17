<template>
  <div class="object-appointment">
    <div class="appointment-title text-center">
      <h3 class="app-m-0 fs-3">TYPE DE RENDEZ-VOUS ?</h3>
    </div>
    <div class="container-fluid container-appointment-form">

      <div class="row d-flex justify-content-center container-appointment-form-row">

        <div v-for="(item, index) in typesAppointments"
             :key="index"
             class="item-request-type col-sm-6 col-md-6 col-lg-3"
             @click="radioAppointmentChange(item)">

          <div class="card rounded-3 shadow border-0" :class="{ selected: item.code == typeAppointmentSelected?.code }">
            <div class="item-request-type-head mt-3 text-center border-0">
              <img :src="item?.imgUrl" class="rounded-circle border-3 border-primary img">
            </div>
            <h4 class="my-0 fw-bold text-center" style="margin: 13px 0px !important;">{{ item?.label }}
            </h4>
            <div class="card-body bg-light">
              <p class="text-center">
                Lorem ipsum dolor sit amet consectetur adipisicing
              </p>
              <div class="d-block text-center">
                <button class="btn bg-oni-primary text-light" type="button">Selectionner</button>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>

    <div class="reduire">
      <div class="app-w-100 app-d-flex app-justify-content-center ">
        <el-row :gutter="24" class="app-w-50">
          <el-col :sm="12" :xs="24" class="mt-3">
            <ButtonApp :primary-btn="false" block button-title="Retour" @click="prevStep"></ButtonApp>
          </el-col>
          <el-col :sm="12" :xs="24" class="mt-3">
            <ButtonApp block button-title="Suivant" @click="nextFormInfo"></ButtonApp>
          </el-col>
        </el-row>
      </div>
    </div>
  </div>
</template>

<script lang="js" src="./_type-rdv-appointment.js"></script>
<style lang="less" scoped src="./_type-rdv-appointment.less"></style>
