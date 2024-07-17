<template>

  <div class="object-appointment">
    <div class="appointment-title text-center">
      <h3 class="app-m-0 fs-3">TYPE DE RENDEZ-VOUS</h3>
    </div>
    <div class="container-fluid container-appointment-form">

      <div class="row d-flex justify-content-center container-appointment-form-row">

        <div class="item-request-type mb-2 col-sm-6 col-md-6 col-lg-3"
             v-for="(item, index) in objectsAppointment"
             :key="index"
             @click="radioAppointmentChange(item)"
        >

          <div class="card rounded-3 shadow border-0" :class="{selected : item.id == typeAppointmentSelected?.id} ">
            <div class="item-request-type-head mt-3 text-center border-0"
                 style="flex: 1 1 auto; justify-content: space-around;">
              <img :src="item.img" width="100" class="rounded-circle border-3 border-primary"
              ></div>
            <h4 class="my-0 fw-bold text-center" style="margin: 13px 0px !important;">{{ item.label }}
            </h4>
            <div class="card-body bg-light">
              <p class="text-center">
                Lorem ipsum dolor sit amet consectetur adipisicing
              </p>
              <div class="d-block text-center">
                <input class="fileInput" type="file" ref="fileInput" id="" hidden="hidden"
                       @change="onUploadFile($event, item)">

                <button class="btn bg-oni-primary text-light"
                        v-if="item.checked &&item.hasFile" @click="initUploadFile($event, index)">
                  <el-icon type="el-icon-upload2"></el-icon>
                  Pièce justificative
                </button>
                <button class="btn bg-oni-primary text-light" type="button" v-else>Sélectionner</button>
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

  <!-- <div class="element-request">
    <div class="container-element-request">
      <el-row
        :gutter="24"
        align="middle"
        class="app-m-0 app-w-100 app-justify-content-center app-d-flex"
        justify="center"
      >
        <el-col
          :md="16"
          :sm="12"
          :xs="24"
          class="container-element-request-appointment"
        >
          <div class="content-element-request-appointment">
            <el-row
              :gutter="24"
              align="middle"
              class="app-justify-content-center app-d-flex"
              justify="center"
            >
              <el-col
                :md="20"
                :sm="20"
                :xs="24"
                class="content-form app-pl-0 app-pr-0"
              >
                <el-form
                  :model="formPersonalInfo"
                  label-position="top"
                  label-width="100px"
                >
                  <el-row :gutter="24" class="app-ml-0 app-mr-0">
                    <el-col
                      :sm="24"
                      :xs="24"
                      class="element-request-title app-sub-title-section"
                    >
                      <h3 class="app-m-0">Élément de la demande</h3>
                    </el-col>

                    <el-col :sm="24" :xs="24" class="">
                      <el-form-item label="Type de  la demande">
                        <el-radio-group
                          v-model="formPersonalInfo.typeOfRequest"
                        >
                          <el-checkbox border label="1" class="renouv"
                            >Première demande
                          </el-checkbox>
                          <el-checkbox border label="2" class=""
                            >Renouvellement
                          </el-checkbox>
                          <el-checkbox border label="3">Duplicata</el-checkbox>
                        </el-radio-group>
                      </el-form-item>
                    </el-col>

                    <el-col :sm="24" :xs="24" class="">
                      <el-form-item label="Type de  passport">
                        <el-radio-group
                          v-model="formPersonalInfo.typeOfPassport"
                        >
                          <el-checkbox border label="1" class="renouv" >Diplomatique</el-checkbox>
                          <el-checkbox border label="2"
                            >Ordinaire
                          </el-checkbox>
                          <el-checkbox border label="3" >Service</el-checkbox>
                        </el-radio-group>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="18" :xs="24" class="">
                      <el-form-item label="Numéro d’indentification unique">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Numéro d’indentification unique"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                  </el-row>
                </el-form>
              </el-col>
            </el-row>
          </div>
          <div class="app-w-100 app-d-flex app-justify-content-center">
            <ButtonApp
              button-title="Suivant"
              icon="el-icon-right"
              @click="nextFormInfo"
            ></ButtonApp>
          </div>
        </el-col>
      </el-row>
    </div>
  </div> -->
</template>

<script lang="js" src="./_element-request.js"></script>
<style lang="less" scoped src="./_element-request.less"></style>
