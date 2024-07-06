<template>
  <div class="row">
    <div class="col-sm-12 overflow-auto">
      <div class="item mb-3">
        <div class="card">

          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="group">
                <h1 class="fs-5 item-title">Type de demande</h1>
                <el-form-item>
                  <el-radio-group v-model="formPersonalInfo.motifRequest">
                    <el-radio border label="newAppointement">Nouvelles demande</el-radio>
                    <el-radio border label="Duplicata">Duplicata</el-radio>
                    <el-radio border label="Renouvellement">Renouvellement</el-radio>
                  </el-radio-group>
                </el-form-item>
              </div>

            </div>
            <div class="col-sm-12 col-md-12">
              <div class="group">
                <h1 class="fs-5 item-title">Genre</h1>
                <el-form-item>
                  <el-radio-group v-model="formPersonalInfo.gender">
                    <el-radio border label="H">Homme</el-radio>
                    <el-radio border label="F">Femme</el-radio>
                  </el-radio-group>
                </el-form-item>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="group">
                <h1 class="fs-5 item-title">Nom</h1>
                <el-form-item>
                  <el-input v-model="formPersonalInfo.firstName" placeholder="nom" size="large"></el-input>
                </el-form-item>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="group">
                <h1 class="fs-5 item-title">Prénom</h1>
                <el-form-item>
                  <el-input v-model="formPersonalInfo.lastName" placeholder="prénom" size="large"></el-input>
                </el-form-item>
              </div>

            </div>

            <div class="col-sm-12 col-md-6">
              <div class="group">
                <h1 class="fs-5 item-title">Email</h1>
                <el-form-item>
                  <el-input v-model="formPersonalInfo.email" placeholder="Email" size="large"
                            type="email"></el-input>
                </el-form-item>
              </div>

            </div>

            <div class="col-sm-12 col-md-6">
              <div class="group">
                <h1 class="fs-5 item-title">Date de naissance</h1>
                <el-form-item>
                  <el-date-picker
                      v-model="formPersonalInfo.dateOfBirth"
                      :disabled-date="pickerOptions.disabledDate"
                      class="w-100"
                      placeholder="Date de naissance"
                      size="large"
                      type="date"
                  />
                </el-form-item>
              </div>
            </div>
          </div>

          <div class="group">
            <h1 class="fs-5 item-title">Numéro de téléphone</h1>
            <el-form-item>
              <el-input v-model="formPersonalInfo.phone" placeholder="contact" size="large">
                  <template #prepend>+224</template>
              </el-input>
            </el-form-item>
          </div>

          <div class="group">
            <h1 class="fs-5 item-title">Lieu de résidence</h1>
            <el-form-item>
              <el-input v-model="formPersonalInfo.placeOfResidence" placeholder="Lieu de résidence"
                        size="large"></el-input>
            </el-form-item>
          </div>

          <div class="row">
            <div :class="hasMoreFile ? 'col-md-4': 'col-md-6'" class="col-sm-12">
              <el-upload ref="upload"
                         :auto-upload="false"
                         :limit="1"
                         :multiple="false"
                         :on-change="uploadBirthCertificate"
                         action="#"
                         class="upload-demo"
                         drag
                         list-type="picture-card">
                <img v-if="formPersonalInfo. fileListBirthCertificate.length>0"
                     :src="formPersonalInfo.fileListBirthCertificate[0]" class="avatar">
                <div v-else class="el-upload__text">Extrait de naissance</div>

              </el-upload>
            </div>
            <div :class="hasMoreFile ? 'col-md-4': 'col-md-6'" class="col-sm-12">
              <el-upload ref="upload"
                         :auto-upload="false"
                         :limit="1"
                         :multiple="false"
                         :on-change="uploadPicture"
                         action="#"
                         class="upload-demo"
                         drag
                         list-type="picture-card">
                <img v-if="formPersonalInfo.fileListPicture.length>0" :src="formPersonalInfo.fileListPicture[0]"
                     class="avatar">
                <div v-else class="el-upload__text">Déposer la photo ici</div>

              </el-upload>
            </div>
            <div v-if="hasMoreFile" :class="hasMoreFile ? 'col-md-4': 'col-md-6'" class="col-sm-12">

              <el-upload ref="upload"
                         :auto-upload="false"
                         :limit="1"
                         :multiple="false"
                         :on-change="uploadSupportDocument"
                         action="#"
                         class="upload-demo"
                         drag
                         list-type="picture-card">
                <img v-if="formPersonalInfo.fileListSupportDocument.length>0"
                     :src="formPersonalInfo.fileListSupportDocument[0]" class="avatar">
                <div v-else class="el-upload__text">Déposer la pièce justificatif ici</div>

              </el-upload>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from "vuex";
import ButtonApp from "../../components/shared/ButtonApp";
import {typePassport} from '../../core/constants';

export default {
  name: "CommonFormAppointment",
  data() {
    return {
      num: 1,
      typeRequestIsOrdinal: false,
      hasMoreFile: false,
      formPersonalInfo: {
        firstName: "",
        lastName: "",
        placeOfResidence: "",
        phone: "",
        dateOfBirth: "",
        gender: "H",
        fileListSupportDocument: [],
        fileListBirthCertificate: [],
        fileListPicture: [],
        motifRequest: "newAppointement",
      },
      pickerOptions: {
        disabledDate(time) {
          return time.getTime() > Date.now();
        },
      },
    };
  },

  components: {
    // eslint-disable-next-line vue/no-unused-components
    ButtonApp
  },
  computed: {
    ...mapGetters({
      objectAppointmentSelected: "GET_OBJECT_APPOINTMENT_SELECTED",
      typeRequestSelected: "GET_TYPE_APPOINTMENT_SELECTED",
    }),

  },

  beforeUnmount() {
    this.$emit('form-value', this.formPersonalInfo);
  },

  created() {
    this.typeRequestIsOrdinal = this.typeRequestSelected?.code === typePassport.ORDINANL;
    this.hasMoreFile = this.typeRequestSelected?.hasFile;
  },

  methods: {
    // eslint-disable-next-line no-unused-vars
    uploadBirthCertificate(file, fileList) {
      this.formPersonalInfo.fileListBirthCertificate = [];
      this.formPersonalInfo.fileListBirthCertificate.push(file.raw);
      // this.onSubmitImage();
    },
    // eslint-disable-next-line no-unused-vars
    uploadPicture(file, fileList) {
      this.formPersonalInfo.fileListPicture = [];
      this.formPersonalInfo.fileListPicture.push(file.raw);
    },

    // eslint-disable-next-line no-unused-vars
    uploadSupportDocument(file, fileList) {
      this.formPersonalInfo.fileListSupportDocument = [];
      this.formPersonalInfo.fileListSupportDocument.push(file.raw);
    },

  },
  watch: {},

  updated() {

  },

};
</script>

<style lang="scss" scoped>


.item {
  .card {
    border: 1px solid #dbd6d63b;
    background: #FFF !important;
    padding: 1.5rem;
    box-shadow: rgb(17 17 26 / 10%) 0px 0px 16px;

    .group {
      margin-bottom: 1.6rem;

      .item-title {
        font-size: 15px !important;
      }
    }
  }
}


.app-m-0 {
  margin: 0 !important;
}

/*
.avatar-uploader .el-upload.el-upload--picture-card {
    width: 100px !important;
    height: 100px !important;
    line-height: 100px !important;
}

.avatar-uploader .el-upload:hover {
    border-color: #409EFF;
}

.avatar-uploader {
    justify-content: flex-end;
    display: flex;
}

.avatar {
    width: 100%;
    height: 100%;
    display: block;
}*/

</style>
