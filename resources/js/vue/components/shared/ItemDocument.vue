<template>
    <div class="container-item">
        <el-card class="box-card" >
            <div class="box-card-body" v-on:click="detailsAppointment()">
                <div class="date-document d-flex justify-content-between align-center" style="font-size: 13px;">
                    <span>Date du rendez-vous : {{ dateRdv ??'' }}</span>
                    <span style="font-style: italic">{{ dataItem?.product?.nom }}</span>
                </div>
                <div class="name-document">
                    <h3 class="">{{ dataItem?.client?.prenom_client }} {{ dataItem?.client?.nom_client }} </h3>
                </div>
                <el-row :gutter="24" class="app-m-0 app-justify-content-space-between">
                    <el-col
                        :sm="24" :xs="24">
            <span class="user-name point-enrolment flew flex-row">
               <small>Point d'enrôlement : </small>
                {{ dataItem?.point_enrolement?.nom_pe }}
            </span>
                    </el-col>

                </el-row>
                <el-row
                    :gutter="24"
                    class="app-m-0 app-justify-content-space-between"
                    style="margin-bottom: 8px"
                >
                    <el-col :sm="12" :xs="24" class="date-appointment">
                        <el-button class="button-primary" type="success"
                        >{{ dataItem?.code_demande }}
                        </el-button>
                    </el-col>
                    <el-col :sm="12" :xs="24" class="status-appointment">
                        <el-button
                            class="button-primary app-d-flex app-justify-content-flex-end"
                            type="success"
                        >{{ status }}
                        </el-button>
                    </el-col>
                </el-row>
            </div>
            <el-row
                :gutter="24"
                class="app-ml-0 app-mr-0 app-justify-content-space-between"
            >
                <!--                <el-col v-if="dataItem?.paiement?.reference_pay == null" :sm="24" :xs="24" class="print-appointment">
                                    <el-button class="" @click.stop="buyMaDemande">
                                        Payer
                                    </el-button>
                                </el-col>-->

                <el-col :sm="12" :xs="24" class="print-appointment">
                    <el-button class="" @click.stop="detailsAppointment">
                        Détails
                    </el-button>
                </el-col>
                
                <el-col
                    v-if="dataItem?.predemande_step == 1"
                    :sm="12" :xs="24" class="reject-appointment">
                    <el-button class="text-danger"> Veuillez patienter...  </el-button>
                </el-col>

                <el-col
                v-else-if="dataItem?.predemande_step == 2"
                    :sm="12" :xs="24" class="reject-appointment">
                    <el-button class="" @click="takeRdv"> Prendre rendez-vous</el-button>
                </el-col>

                <el-col
                    v-else
                    :sm="12" :xs="24" class="reject-appointment">
                    <el-button class="" @click.stop="getRecu"> Télécharger le reçu</el-button>
                </el-col>

            </el-row>
        </el-card>
    </div>
</template>
<script>
export default {
    name: "ItemDocument",
    props: {
        indexBuild: {
            type: Number,
            default: 0
        },
        dataItem: {
            type: Object,
            default: null
        }
    },

    methods: {
        takeRdv() {
            this.$router.push({
                    name: "appointment-start",
                });
        },
        getRecu() {
            window.open(`/recuPdf/${this.dataItem?.code_demande}`)
        },
        buyMaDemande() {
            this.$router.push({
                name: "details-appointment", params: {
                    documentId: this.dataItem?.id
                }
            })
        },
        voirStatutDeMaDemande() {
            window.open(`/voirStatutDeMaDemande/${this.dataItem?.code_demande}`)
        },
        redirectTo() {

            if (this.isReportingAppointment) {
                this.$router.push({
                    name: "report-appointment",
                    params: {documentId: this.indexBuild + this.dataItem.refDoc}
                });
            } else {
                this.$router.push({
                    name: "pay-appointment",
                    params: {documentId: this.indexBuild + this.dataItem.refDoc}
                });
            }
        },

        detailsAppointment() {
            this.$router.push({
                name: "details-appointment", params: {
                    documentId: this.dataItem?.id
                }
            })
        }
    },

    computed: {
        action() {
            return this.isReportingAppointment
                ? {name: "Reporter", type: "danger"}
                : {name: "Payer", type: "warning"};
        },
        isReportingAppointment() {
            return this.indexBuild % 2 === 0;
        },

        dateRdv() {
           var d = this.dataItem?.date_rdv_demande ?  new Date(this.dataItem?.date_rdv_demande).toLocaleDateString(undefined, {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric"
            })
            : null

            return d
        },
        status() {
            if (this.dataItem?.predemande_step == 1) {
                return "En attente"
            }
            else if (this.dataItem?.status_demande == "PENDDING") {
                return "En cours"
            }
            else if (this.dataItem?.status_demande == "OPEN") {
                return "Ouvert"
            }
            else if (this.dataItem?.status_demande == "SUSPENDED") {
                return "Suspendue"
            } else if (this.dataItem?.status_demande == "RESETTED") {
                return "Réinitialisée"
            }
            else if (this.dataItem?.status_demande == "REJECTED") {
                return "Echec"
            } else if (this.dataItem?.status_demande == "NEW") {
                return "En attente"
            } else if (this.dataItem?.status_demande == "CLOSED") {
                return "Rendez-vous fait, maintenant en attente du retrait"
            } else if (this.dataItem?.status_demande == "PENDING_PAY") {
                return "en attente de paiement"
            } else {
                return "En attente"
            }

        },
    }
};
</script>

<style lang="less" scoped>
.container-item {
    width: 100%;
    cursor: pointer;


    .point-enrolment {
        display: flex;
        align-items: center;
        margin: 0.5rem 0;
    }

    .el-card {
        .el-card__body {
            padding: 0 !important;
        }
    }

    .box-card {
        border-radius: 13px;
        background: #2e3138; // var(--primaryColor);
        color: #ffffff;

        .box-card-body {
            padding: 0.7rem;

        }

        .date-document {
            font-size: 14px;
            font-weight: 900;
        }

        .name-document {
            h3 {
                font-size: 1.7rem;
                margin: 6px 0;
                font-weight: bold;
            }
        }

        .user-name,
        .user-phone {
            font-size: 18px;
        }

        .user-phone {
            text-align: end;
        }

        .button-primary {
            background: #4e7e74;
            border-radius: 8px;
            font-size: 11px;
            border: none !important;
        }

        .status-appointment {
            display: flex;
            justify-content: flex-end;

            .el-button {
                color: #FFF;
            }
        }
    }

    .reject-appointment {
        border-left: 0.2px solid #e3e3e3;
    }

    .print-appointment, .reject-appointment {
        .el-button {
            background: beige;
            color: #2e3138;
            font-weight: bolder;
            font-size: 15px;
        }
    }

    .print-appointment,
    .reject-appointment {
        padding: 0 !important;

        .el-button {
            width: 100%;
            padding: 24px;
            border: none;
            border-radius: 0 !important;
        }
    }
}
</style>
