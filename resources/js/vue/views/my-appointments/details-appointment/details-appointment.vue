<template>
    <el-row :loading="isLoading">

        <el-col v-if="appointment == null" :sm="24" :xs="24">
            <EmptyState @reload="fetchData"></EmptyState>
        </el-col>
        <el-col v-else :sm="24" :xs="24">
            <div class="details-appointment app-container-page">
                <el-row :gutter="24" class="container-row">
                    <el-col :sm="16" :xs="24" class="info-user">
                        <div class="head-card-user app-flex-d-column app-align-items-center">
                            <el-avatar :size="60" :src="circleUrl"></el-avatar>
                            <h4 class="app-m-0 name-user text-center">{{ demandeObj?.client?.nom_client }} {{
                                demandeObj?.client?.prenom_client
                                }}</h4>
                            <span class="app-opacity-5">{{ demandeObj?.client?.email_client }}</span>
                            <span class="app-opacity-5">
                                <a :href="'tel:' + demandeObj?.client?.telephone_client">{{
                                    demandeObj?.client?.telephone_client }}</a>
                            </span>
                            <div class="content-qr-code">
                                <img alt="QR CODE" height="50" src="/assets/vue/imgs/others/fake_qrcode.jpeg"
                                    width="50">

                            </div>
                        </div>
                        <div class="content-card-other-info-user app-mb-1">
                            <el-row :gutter="24" class="container-item">
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Genre</h5>
                                        <span class="value-item">{{ demandeObj?.client?.genre_client ?? '-' }}</span>
                                    </div>
                                </el-col>
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Date de naissance</h5>
                                        <span class="value-item">{{ dateNaiss }}</span>
                                    </div>
                                </el-col>
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Lieu de naissance</h5>
                                        <span class="value-item">{{ demandeObj?.client?.adresse_client ?? '-' }}</span>
                                    </div>
                                </el-col>
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Nationalité</h5>
                                        <span class="value-item">Guinéenne</span>
                                    </div>
                                </el-col>


                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Type de service</h5>
                                        <span class="value-item">{{ demandeObj?.service?.name ?? "-" }}</span>
                                    </div>
                                </el-col>
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Type de demande</h5>
                                        <span class="value-item">{{ demandeObj?.type_request ?? '-' }}</span>
                                    </div>
                                </el-col>
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Taille</h5>
                                        <span class="value-item"> {{ demandeObj?.height ?? '-' }} cm </span>
                                    </div>
                                </el-col>


                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Teint</h5>
                                        <span class="value-item"> {{ demandeObj?.complexion ?? '-' }} </span>
                                    </div>
                                </el-col>
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Couleur des cheveux</h5>
                                        <span class="value-item"> {{ demandeObj?.hair_color ?? '-' }} </span>
                                    </div>
                                </el-col>

                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Couleur des yeux</h5>
                                        <span class="value-item"> {{ demandeObj?.eye_color ?? '-' }} </span>
                                    </div>
                                </el-col>

                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Profession</h5>
                                        <span class="value-item"> {{ demandeObj?.profession ?? '-' }} </span>
                                    </div>
                                </el-col>



                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Nom & prénom du père</h5>
                                        <span class="value-item"> {{ (demandeObj?.father_last_name + ' ' +
                                            demandeObj?.father_first_name) ?? '-' }} </span>
                                    </div>
                                </el-col>

                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Nom & prénom mère</h5>
                                        <span class="value-item"> {{ (demandeObj?.mother_last_name + ' ' +
                                            demandeObj?.mother_first_name) ?? '-' }} </span>
                                    </div>
                                </el-col>

                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Nationalité d'origine</h5>
                                        <span class="value-item"> {{ demandeObj?.nationality ?? '-' }} </span>
                                    </div>
                                </el-col>
                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Statut nationnalité</h5>
                                        <span class="value-item"> {{ formatNationnality(demandeObj?.nationality_state)
                                            ?? '-' }} </span>
                                    </div>
                                </el-col>

                                <el-col :sm="8" :xs="24" class="">
                                    <div class="content-item">
                                        <h5 class="app-opacity-5 label-item">Profession</h5>
                                        <span class="value-item"> {{ demandeObj?.profession ?? '-' }} </span>
                                    </div>
                                </el-col>

                            </el-row>
                        </div>
                    </el-col>
                    <el-col :sm="8" :xs="24" class="container-card-other-info">
                        <div class="content-card-other-info  w-100 align-items-start">
                            <div class="appointment" v-if="demandeObj?.predemande_step > 2">
                                <h5 class="type-appointment">Rendez-vous : {{
                                    typeDocumentObj?.nom ?? '-'
                                    }}</h5>
                                <h4 class="amount-appointment type-appointment" v-if="demandeObj?.predemande_step > 2">
                                    Montant à payer : {{ typeDocumentObj?.prix ?? '-' }} GNF
                                </h4>
                                <h4 class="date-appointment">
                                    {{ formateDateAppointement(demandeObj?.date_rdv_demande ?? '-') }}
                                </h4>


                            </div>


                            <div class="app-d-flex app-justify-content-space-between app-align-items-center gap-2">
                                <span class="title-info">Reference</span>
                                <h5 class="app-m-0">{{ demandeObj?.code_demande ?? '-' }}</h5>
                            </div>
                            
                            <div class="app-d-flex app-justify-content-space-between app-align-items-center gap-2">
                                <span class="title-info">Numéro du reçu</span>
                                <h5 class="app-m-0">{{ demandeObj?.numero_recu ?? '-' }}</h5>
                            </div>

                            <div class="app-d-flex app-justify-content-space-between app-align-items-center" v-if="demandeObj?.predemande_step > 2">
                                <p class="description-info app-m-0">
                                    il est nécessaire de prendre tous vos précautions afin d’honorer
                                    votre rendez-vous pris pour le <span class="value-item" style="font-weight: bold;">{{
                                        demandeObj?.date_rdv_demande ?? '-' }}</span>
                                </p>
                            </div>

                            <div class="app-d-flex app-justify-content-space-between app-align-items-center" v-if="demandeObj?.predemande_step > 2">
                                <p>
                                    Point enrolement: <span class="value-item" style="font-weight: bold;"> {{ demandeObj?.point_enrolement?.nom_pe ?? '-' }}</span> 
                                </p>
                            </div>


                            <div class="app-mt-1">
                                <!--                                <ButtonApp
                                    v-if="appointment?.demande?.paiement==null || appointment?.demande?.paiement.reference_pay == null"
                                    :loading="isLoading"
                                    :primary-btn="false"
                                    block
                                    button-title="Payer"
                                    icon="el-icon-printer"
                                    @click="buyAppointment"
                                >
                                </ButtonApp>

                                <ButtonApp
                                    v-if="appointment?.demande?.paiement!=null && appointment?.demande?.paiement?.reference_pay != null"
                                    :loading="isLoading"
                                    :primary-btn="false"
                                    block
                                    button-title="Télécharger le reçu"
                                    icon="el-icon-printer"
                                    @click="printAppointment"
                                >
                                    <template v-slot:icon>
                                        <el-icon>
                                            <Printer/>
                                        </el-icon>
                                    </template>

</ButtonApp>-->
                                <ButtonApp :loading="isLoading" :primary-btn="false" block
                                    v-if="demandeObj?.predemande_step > 2"
                                    button-title="Télécharger le reçu" icon="el-icon-printer" @click="printAppointment">
                                    <template v-slot:icon>
                                        <el-icon>
                                            <Printer />
                                        </el-icon>
                                    </template>

                                </ButtonApp>
                            </div>
                            <div>
                                <div class="qr-code">

                                </div>
                            </div>
                        </div>
                    </el-col>
                </el-row>


                <el-row :gutter="24" class="container-row">
                    <el-col :sm="attachedFile ? 16 : 24" :xs="24">
                        <div class="container-timeline">
                            <el-timeline>
                                <el-timeline-item v-for="(item, index) in timelineItem" :timestamp="item?.date"
                                    placement="top">
                                    <el-card>
                                        <h4>{{ item?.action }}</h4>
                                    </el-card>
                                </el-timeline-item>
                                <!--            <el-timeline-item
                                                placement="top"
                                                timestamp="14 Novembre 2022 11:50"
                                            >
                                              <el-card>
                                                <h4>Paiement</h4>
                                                <p>Commit de Tom le 2018/4/3 20:46</p>
                                              </el-card>
                                            </el-timeline-item>
                                            <el-timeline-item
                                                placement="top"
                                                timestamp="13 Novembre 2022 11:50"
                                            >
                                              <el-card>
                                                <h4>Enregistrement</h4>
                                                <p>Commit de Tom le 2018/4/2 20:46</p>
                                              </el-card>
                                            </el-timeline-item>-->
                            </el-timeline>
                        </div>
                    </el-col>
                    <el-col v-if="attachedFile" :sm="8" :xs="24">

                    </el-col>
                </el-row>
            </div>
        </el-col>
    </el-row>
</template>

<script lang="js" src="./_details-appointment.js"></script>
<style lang="less" scoped src="./_details-appointment.less"></style>
