<template>
    <div class="object-appointment">
        <div class="appointment-title text-center">
            <h3 class="app-m-0 fs-3">Quel est l’objet de votre rendez-vous ?</h3>
        </div>
        <div class="container-fluid">
            <div class="row container-appointment-form-row">

                <div v-for="(item, index) in products"
                     :key="index"
                     class="item-request-type col-sm-12 col-md-6 col-lg-3 mb-2"
                     @click="radioAppointmentChange(item)">
                    <div :class="{selected : item?.id_type_document == objectAppointmentSelected?.id }"
                         class="card rounded-3 shadow border-0 h-100">
                        <div class="item-request-type-head mt-3 text-center border-0">
                            <img :src="item?.image_type_document" class="rounded-circle border-3 border-primary img"
                            ></div>
                        <h4 class="my-0 fw-bold text-center" style="margin: 13px 0px !important;">
                            {{ item?.nom_type_document }}
                        </h4>
                        <div class="card-body bg-light">
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

<script lang="js" src="./_object-appointment.js"></script>
<style lang="less" scoped src="./_object-appointment.less"></style>
