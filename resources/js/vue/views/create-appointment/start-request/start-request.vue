<template>
    <div class="start-request">
        <div class="demo-collapse">
            <strong>
                Pre-demande N°: {{ preDemande?.numero_pre_demande ?? "-" }}
            </strong>
            <el-collapse ref="collapse" v-model="activeNames" @change="handleChange">

                <div class="col-sm-12 col-md-12">
                    <el-form class="g-3 needs-validation" label-position="top">
                        <div class="row d-flex " style="margin-top: 1rem;">
                            <div class="col-sm-12 col-md-12" style=" ">
                                <el-form-item label="Choisir le point d'enrollement" required>

                                    <el-select v-model="formPersonalInfo.siteAppointmentId" class="w-100"
                                        @change="item => changeEnrolment(item)" required>
                                        <el-option v-for="item in enrolmentsPoint" :key="item.id_pe"
                                            :label="item.nom_pe" :value="item.id_pe">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                                <span v-if="!formPersonalInfo.siteAppointmentId && formError" class="error-message">Ce
                                    champs est obligatoire</span>
                            </div>
                        </div>
                    </el-form>
                </div>

                <div class="col-sm-12 col-md-12">
                    <el-form class="g-3 needs-validation" label-position="top">
                        <div class="row d-flex " style="margin-top: 1rem;">
                            <div class="col-sm-12 col-md-12" style=" ">
                                <el-form-item label="Selectionner le type de service" required>

                                    <el-select v-model="formPersonalInfo.serviceId" class="w-100"
                                        @change="item => changeEnrolment(item)">
                                        <el-option v-for="item in pointEnrolementServices" :key="item.id"
                                            :label="item.name" :value="item">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                                <span v-if="!formPersonalInfo.serviceId && formError" class="error-message">Ce champs
                                    est obligatoire</span>
                            </div>
                        </div>
                    </el-form>
                </div>

                <div class="service-appointment">
                    <div class="container-fluid">
                        <div class="row container-appointment-form-row">
                            <div v-for="(item, index) in formPersonalInfo.pointEnrolementServices" :key="index"
                                class="item-request-type col-sm-12 col-md-6  col-lg-3 mb-2"
                                @click="radioAppointmentChangeService(item, 3)">
                                <div :class="{ selected: item?.id == serviceSelected?.id }"
                                    class="card  shadow border-0 h-100">
                                    <div class="item-request-type-head mt-3 text-center border-0">
                                        <img :alt="item?.name" :src="item?.image" class=" border-0 img" />
                                    </div>
                                    <h6 class="my-0 fw-bold text-center" style="margin: 13px 0px !important;">
                                        {{ item?.name }}
                                    </h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-md-12">
                        <div class="group">
                            <h1 class="fs-5 item-title">Référence bordereau banque</h1>

                            <el-form-item>
                                <el-input v-model="formPersonalInfo.numero_recu" placeholder="Numéro du reçu"
                                    size="default"></el-input>
                            </el-form-item>
                            <span v-if="!formPersonalInfo.numero_recu && formError" class="error-message">Ce champs est
                                obligatoire</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="app-w-100 app-d-flex app-d-flex app-justify-content-center">
                        <el-row :gutter="24" class="app-w-50">
                            <el-col :sm="24" :xs="24" class="mt-3">
                                <ButtonApp block button-title="Suivant" @click="onSwitchPage">
                                </ButtonApp>
                            </el-col>
                        </el-row>

                    </div>
                </div>
            </el-collapse>
        </div>
    </div>
</template>

<script lang="js" src="./_start-request.js"></script>
<style lang="less" scoped src="./_start-request.less"></style>
