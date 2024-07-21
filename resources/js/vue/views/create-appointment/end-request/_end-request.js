// @vue/component
import axios from "axios";
import {ElCalendar} from "element-plus";
import {ref} from "vue";
import {mapActions, mapGetters} from "vuex";
import ButtonApp from "../../../components/shared/ButtonApp.vue";
import {KEY_FORM_JSON} from "../../../core/constants";
import utils from "../../../core/utils";
import {format} from "date-fns";

export default {
    name: 'EndRequest',

    components: {ButtonApp, ElCalendar},

    mixins: [],

    props: {},

    data() {
        return {
            dateAppointment: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate(), new Date().getHours() + 24),
            siteAppointmentId: "",
            isLoadingSaveAppointment: false,
            times: [
                {
                    label: "Matin 8h30-12h30",
                    id: 1,
                    checked: true
                },
                {
                    label: "Soir 13h30-17h00",
                    id: 2,
                    checked: false
                }
            ],
            calendar: ref()
        }
    },

    computed: {
        ...mapActions(['FETCH_ENROLMENTS_POINTS', "FORM_DATA_REQUEST", 'FETCH_FERRY_DAY', 'SAVE_APPOINTMENT']),
        ...mapGetters({
            enrolmentsPoint: "GET_ENROLMENTS_POINTS",
            isLoading: "IS_LOADING_LOCATIONS_ENROLMENTS",
            ferry_days: "GET_FERRY_DAY",
            formDataRequest: "GET_FORM_DATA_REQUEST", 
            statusResponse: "GET_STATUS_RESPONSE",
            statusMessage: "GET_MESSAGE_APPOINTMENT"
        })


    },
    watch: {

    },

    created() {
        this.$store.dispatch("FETCH_ENROLMENTS_POINTS");
        this.$store.dispatch("FETCH_FERRY_DAY");
    },

    methods: {
        onDateChange: (data) => {
            const payload = {
                key: [KEY_FORM_JSON.DATE_APPOINTMENT],
                data: this.dateAppointment
            };
            this.$store.dispatch('FORM_DATA_REQUEST', payload);
        },
        hasFerry: function (data) {
            return this.ferry_days.find(date => new Date(data.day).getTime() == new Date(date.date_jfpe).getTime()) != undefined;
        },
        onReturn: function () {
            this.$router.push({name: "appointment-start", params: {documentId: this.formDataRequest?.user?.documentId}})
        },
        onSaveAppointment: async function () {
            this.isLoadingSaveAppointment = true;
            console.log("this.formDataRequest =====", this.formDataRequest)
            console.log('date de rdv ', new Date(this.dateAppointment).getTime())
            // if (this.siteAppointmentId == "" || this.siteAppointmentId == null) {
            //     this.$swal({
            //         position: "center",
            //         icon: "warning",
            //         title: "Le site du rendez-vous est boligatoire",
            //         showConfirmButton: false,
            //         timer: 4500

            //     });
            //     return
            // }

            if (this.dateAppointment == "" || new Date(this.dateAppointment).getTime() <= new Date().getTime()) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "La date de rendez-vous est invalid",
                    showConfirmButton: false,
                    timer: 4500

                });
                return
            }
            const payload = {
                key: [KEY_FORM_JSON.DATE_APPOINTMENT],
                data: this.dateAppointment
            };
            this.$store.dispatch('FORM_DATA_REQUEST', payload);
            const formData = new FormData();
         
            formData.append(
                "date_rdv_demande",
                format(new Date(this.dateAppointment), "yyyy-MM-dd")
            );

            formData.append(
                "numero_recu",
               this.formDataRequest?.user?.numero_recu
            );

            // formData.append(
            //     "id_type_document",
            //     this.formDataRequest?.product?.id
            // );
            
             formData.append(
                "id_demande",
                this.formDataRequest?.user?.documentId
            );

            formData.append("type_service_passport", null);
            formData.append(
                "id_type_service",
                this.formDataRequest?.user?.serviceId.id ?? null
            );
            formData.append("id_point_enrolement", this.formDataRequest?.user?.siteAppointmentId?.id_pe);
         

            // await this.$store.dispatch("SAVE_APPOINTMENT", formData)
            axios.post(`/api/save-appointment`, formData).then(responseAxios => {
                this.isLoadingSaveAppointment = false;
                console.log("responseAxios", responseAxios)
                if (!responseAxios.data.demande) {
                    this.$swal({
                        position: "center",
                        icon: "warning",
                        title: responseAxios.data?.message ?? "",
                        showConfirmButton: false,
                        timer: 4500

                    });
                    return;
                }

                if (responseAxios.data.status == 200) {
                    this.$swal({
                        position: "center",
                        icon: "success",
                        title: responseAxios.data?.message ?? "Demande enregistré",
                        showConfirmButton: true,
                        confirmButtonText: 'Ok',
                        timer: 4500
                    }).then((result) => {
                        this.$router.push({
                            name: "details-appointment", params: {
                                documentId: responseAxios.data.demande?.id
                            }
                        })
                    })

                }
            }).catch((err) => {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Echèc de l'enregistrement",
                    showConfirmButton: false,
                    timer: 4500
                });
                console.log("err", err);
                this.isLoadingSaveAppointment = false;
            }).finally(() => {

            });
        },
        numberDay: function (data) {
            return data?.day?.split('-').slice(1).join('-').split('-').slice(1).join();
        },
        nextPage() {
            const payload = {
                key: [KEY_FORM_JSON.DATE_APPOINTMENT],
                data: {
                    date: this.dateAppointment,
                    time: this.times.find((it) => it.checked)
                }
            };
            this.$store.dispatch("FORM_DATA_REQUEST", payload);
        },
        chooseTime(item) {
            // console.log("this.value", this.value);
            this.times = this.times.map((it) => {
                return {
                    ...it,
                    checked: it.id == item.id
                };
            });
        }
    }
}
