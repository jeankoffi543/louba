<template>
  <div class="info-personal-appointment">
    <div class="container-info-personal-form">
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
          class="container-info-personal-appointment"
        >
          <div class="content-info-personal-appointment">
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
                      class="info-personal-title app-sub-title-section"
                    >
                      <h3 class="app-m-0">
                        Saisir vos informations personnelles
                      </h3>
                    </el-col>
                    <el-col :sm="24" :xs="24" class="container-avatar-user">
                      <div class="el-avatar-group">
                        <el-avatar :size="100" icon="el-icon-user"></el-avatar>
                        <el-button
                            circle
                            icon="el-icon-camera-solid"
                            type="success"
                            @click="$refs.fileInput.click()"
                        ></el-button>
                        <input type="file" hidden="hidden" ref="fileInput">
                      </div>
                    </el-col>
                    <el-col :sm="24" :xs="24" class="app-d-flex">
                      <el-form-item label="Motif de la demande">
                        <el-radio-group v-model="formPersonalInfo.motifRequest">
                          <el-radio border label="newAppointement">Nouvelles demande</el-radio>
                          <el-radio border label="Duplicata">Duplicata</el-radio>
                          <el-radio border label="Renouvellement">Renouvellement</el-radio>
                        </el-radio-group>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Non et prénom">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Votre nom complet"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <!--                    <el-col :sm="12" :xs="24" class="">
                                          <el-form-item label="Date de naissance">
                                            <el-date-picker
                                              v-model="formPersonalInfo.dateOfBirth"
                                              placeholder="Date de naissance"
                                              type="date"
                                            >
                                            </el-date-picker>
                                          </el-form-item>
                                        </el-col>-->
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Lieu de naissance">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Ville de naissance"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Profession">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Profession"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Nationalité">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Nationalité"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Domicile">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Domicile"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Situation matrimoniale">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Situation matrimoniale"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Email">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Adresse email"
                          size="medium"
                          type="email"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Numéro de téléphone">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Numéro de téléphone"
                          size="medium"
                        ><template #prepend>+224</template></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="app-d-flex">
                      <el-form-item label="Sexe">
                        <el-radio-group v-model="formPersonalInfo.gender">
                          <el-radio border label="H">Homme</el-radio>
                          <el-radio border label="F">Femme</el-radio>
                        </el-radio-group>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="app-d-flex" v-if="typeRequestIsOrdinal">
                      <el-form-item label="Type de Rendez-vous">
                        <el-radio-group v-model="formPersonalInfo.typeRequest">
                          <el-radio border label="o">Ordinaire</el-radio>
                          <el-radio border label="f">
                            Familiale
                          </el-radio>
                        </el-radio-group>
                      </el-form-item>
                    </el-col>

                  </el-row>
                </el-form>
              </el-col>
            </el-row>
          </div>
          <div class="app-w-100 app-d-flex app-d-flex app-justify-content-center">
            <el-row :gutter="24" class="app-w-50">

              <el-col :xs="24" :sm="12">
                <ButtonApp
                    button-title="Retour"
                    @click="prevStep"
                    :primary-btn="false"
                    block
                ></ButtonApp>
              </el-col>
              <el-col :xs="24" :sm="12">
                <ButtonApp
                    button-title="Suivant"
                    block
                    @click="nextFormInfo"
                ></ButtonApp>
              </el-col>
            </el-row>

          </div>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script lang="js" src="./_info-personal-appointment.js"></script>
<style lang="less" scoped src="./_info-personal-appointment.less"></style>
