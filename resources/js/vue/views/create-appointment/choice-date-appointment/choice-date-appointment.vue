<template>
  <div class="choice-date-appointment">
    <div class="info-personal-title app-sub-title-section">
      <h3 class="app-m-0">Choisissez votre date de RDV</h3>
    </div>
    <div class="container-body app-flex-d-column">
      <el-row :gutter="24"
              align="middle"
              class="app-m-0 app-w-100 justify-content-between app-d-flex">
        <el-col
            :md="16"
            :sm="16"
            :xs="24"
            class="container-calandar"
        >
          <div class="content-info-personal-appointment">
            <el-calendar v-model="dateAppointment" ref="calendar"></el-calendar>
            <div class="legende">
              <p class="titre">Légende </p>
              <div class="ouvrable">
                <div class="ouv-1"></div>
                <p class="p">jour disponible</p>
              </div>
              <div class="non-ouvrable">
                <div class="ouv-3">
                  <div class="ouv-3-1"></div>
                </div>
                <p class="p">jour non disponible</p>
              </div>
              <div class="ferie">
                <div class="ouv-4">&#9733;</div>
                <p class="p">jour ferie</p>
              </div>
            </div>
          </div>
        </el-col>

        <el-col :md="8" :sm="8" :xs="24">
          <div class="container h-100 ">
            <div class="row h-100 flex-column justify-content-start">
              <div class="col-sm-12 col-md-12 col-lg-12 mt-2 app-cursor-pointer" @click="chooseTime(item)"
                   v-for="(item, index) in times" :key="index">
                <div class="item-time text-center w-100 p-2 rounded-2"
                     :class="[item.checked?'item-selected bg-oni-primary text-white' : '']">
                  <span class="fw-bold">{{ item.label }}</span>
                </div>
              </div>

            </div>
          </div>
        </el-col>

      </el-row>

      <div class="">
        <div class="app-w-100 app-d-flex app-justify-content-center mt-4">
          <el-row :gutter="24" class="app-w-50">
            <el-col :xs="24" :sm="12" class="">
              <ButtonApp button-title="Retour" @click="prevStep" :primary-btn="false" block></ButtonApp>
            </el-col>
            <el-col :xs="24" :sm="12" class="">
              <ButtonApp button-title="Suivant" block @click="nextPage"></ButtonApp>
            </el-col>
          </el-row>
        </div>
      </div>

    </div>
  </div>
</template>

<script lang="js" src="./_choice-date-appointment.js"></script>
<style lang="less" scoped src="./_choice-date-appointment.less"></style>
