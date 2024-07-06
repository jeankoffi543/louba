<template>
  <div class="additional-info-request">
    <div class="info-personal-title app-sub-title-section">
      <h3 class="app-m-0">Saisir les informations complémentaires</h3>
    </div>
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
                    <el-col :sm="8" :xs="24" class="">
                      <el-form-item label="Taille">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Taille (1m 50)"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="8" :xs="24" class="">
                      <el-form-item label="Signe particulier">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Signe particulier"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="8" :xs="24" class="">
                      <el-form-item label="Teint">
                        <el-select
                          v-model="formPersonalInfo.name"
                          placeholder="Teint"
                        >
                          <el-option
                            v-for="item in options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value"
                          >
                          </el-option>
                        </el-select>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Nom & prenom du père">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Nom & prenom du père"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="">
                      <el-form-item label="Nom & prenom mère">
                        <el-input
                          v-model="formPersonalInfo.name"
                          placeholder="Nom & prenom mère"
                          size="medium"
                        ></el-input>
                      </el-form-item>
                    </el-col>
                    <el-col :sm="24" :xs="24" class="" v-if="!objectTypeRequestAppointmentIsOrdinal">
                      <el-form-item
                          :label="!objectAppointmentIsPassport?'pièce d’identité du pays d\'origine': 'Document de justication (.pdf)'">
                        <el-upload
                            :file-list="fileList"
                            :on-preview="handlePreview"
                            :on-remove="handleRemove"
                            class="upload-demo app-w-100"
                            drag
                            multiple
                        >
                          <i class="el-icon-upload"></i>
                          <div class="el-upload__text">
                            Glisser et déposer un fichier ou cliquer pour
                            ajouter une pièce jointe
                          </div>
                        </el-upload>
                      </el-form-item>
                    </el-col>

                    <el-col :sm="24" :xs="24" class="" v-if="objectAppointmentIsPassport">
                      <el-form-item label="Extrait de naissance (.pdf)">
                        <el-upload
                            :file-list="fileList"
                            :on-preview="handlePreview"
                            :on-remove="handleRemove"
                            class="upload-demo app-w-100"
                            drag
                            multiple
                        >
                          <i class="el-icon-upload"></i>
                          <div class="el-upload__text">
                            Glisser et déposer un fichier ou cliquer pour
                            ajouter une pièce jointe
                          </div>
                        </el-upload>
                      </el-form-item>
                    </el-col>
                  </el-row>
                </el-form>
              </el-col>
            </el-row>
          </div>
          <div class="app-w-100 app-d-flex app-justify-content-center">
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
                    @click="nextPage"
                ></ButtonApp>
              </el-col>
            </el-row>
          </div>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script lang="js" src="./_additional-info-request.js"></script>
<style lang="less" scoped src="./_additional-info-request.less"></style>
