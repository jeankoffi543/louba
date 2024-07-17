<template>
  <div class="pay-appointment app-container-page">
    <el-row :gutter="24" class="container-row">
      <el-col :sm="24" :xs="24" :md="16" :lg="16" class="mt-1 ">
        <div class="info-appointment">
          <div class="content-card-info-appointment app-mb-1">
            <div class="payment-method-title">
              <h3>Choisissez votre moyen de paiement</h3>
            </div>
            <el-row :gutter="24" class="container-item">
              <el-col
                  v-for="(item, index) in methodsPaiment"
                  :key="index"
                  :class="{ 'disabled-item': index !== indexMethodsPaimentActive }"
                  :md="8"
                  :sm="8"
                  :style="{ 'border-color': item.color }"
                  :xs="24"
                  class="item-payment-method"
                  @click="indexMethodsPaimentActive = index"
              >
                <div
                    class="content app-w-100 app-d-flex app-justify-content-center app-align-items-center"
                >
                  <div :class="item.classNameLogo" class="content-img"></div>
                  <span>{{ item.name }}</span>
                </div>
              </el-col>
            </el-row>
          </div>
          <el-form>
            <el-form-item class="app-mb-1" label="Demande de passeport">
              <el-input
                  v-model="labelRequest"
                  placeholder="Demande de passeport"
                  readonly
                  size="medium"
              ></el-input>
            </el-form-item>

            <el-form-item class="app-mb-1" label="Date du rendez-vous">
              <el-input
                  v-model="dateRequest"
                  placeholder="Demande de passeport"
                  readonly
                  size="medium"
              ></el-input>
            </el-form-item>
          </el-form>
        </div>

      </el-col>
      <el-col :sm="24" :xs="24" :md="8" :lg="8" class="mt-1 content container-card-other-info">
        <div class="content-card-other-info">
          <div class="amount-appointment">
            <h5>Montant du rendez-vous</h5>
            <h1>5.000 GNF</h1>
          </div>

          <!-- <div
            class="app-d-flex app-justify-content-space-between app-align-items-center"
          >
            <span class="title-info">Reference</span>
            <h5 class="app-m-0">662215050</h5>
          </div> -->
          <div
              class="app-d-flex app-justify-content-space-between app-align-items-center"
          >
            <p class="description-info app-m-0 app-mb-1">
              Les frais de prise de rendez-vous ne sont pas remboursables.
            </p>
          </div>

          <div class="">
            <ButtonApp
                :loading="isLoading"
                :primary-btn="false"
                block
                button-title="Payer"
                icon="el-icon-money"
                @click="redirectToAllDocument"
            >
              <template v-slot:icon>
                <el-icon>
                  <Money/>
                </el-icon>
              </template>
            </ButtonApp>
          </div>
        </div>
        <div class="app-w-100 app-mt-1">
          <el-button class="app-w-100" @click="payAppointmentAfter" type="primary" plain>Payer plus tard

          </el-button>
          <!--          <ButtonApp
                        :loading="isLoading"
                        :primary-btn="true"
                        block
                        button-title=""

                    ></ButtonApp>-->
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script lang="js" src="./_pay-appointment.js"></script>
<style lang="less" scoped src="./_pay-appointment.less"></style>
