<template>
  <div class="report-appointement app-container-page">
    <el-row :gutter="24" class="container-row">
      <el-col
        :sm="18"
        :xs="24"
        class="title-card app-title-section underline-title"
      >
        <h3 class="ange">Reporter un rendez-vous</h3>
      </el-col><br>
      <el-col :sm="18" :xs="20" class="info-appointment">
        <el-form class="ligne">
          <el-form-item class="app-w-100 mr-5" label="Date du RDV prévue"> <br>

            <div class="content-info-personal-appointment">
            <CalendarApp></CalendarApp>
            </div>

            <!-- <el-input
              v-model="dateAppointment"
              placeholder="10/08/2020"
              size="medium"
              type="date"
            ></el-input> -->
          </el-form-item>

          <div class="ml">

          </div>

          <el-form-item class="app-w-100 ml-5" label="Raison du report">
            <el-input
              v-model="resonReport"
              :autosize="{ minRows: 5, maxRows: 5 }"
              placeholder="Demande de passeport"
              size="medium"
              type="textarea"
            ></el-input>

            <el-checkbox class="para" v-model="checkedNotify" style="color: #606266 !important"
            >Être notifié de la prochaine dates du RDV (E-mail)
          </el-checkbox>
          </el-form-item>


        </el-form>
      </el-col>
      <el-col :sm="18" :xs="24">
        <div class="app-d-flex app-justify-content-flex-end">
          <ButtonApp
            :loading="isLoading"
            :primary-btn="false"
            button-title="Reporter"
            @click="sendReport"
          ></ButtonApp>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script lang="js" src="./_report-appointement.js"></script>
<style lang="less" scoped src="./_report-appointement.less"></style>
