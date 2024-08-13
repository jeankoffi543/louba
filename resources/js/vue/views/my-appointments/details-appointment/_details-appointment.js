// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";
import {mapActions, mapGetters} from "vuex";
import EmptyState from "../../../components/shared/EmptyState.vue";
import {format} from "date-fns";

export default {
    name: "DetailsAppointment",

    components: {
        EmptyState,
        ButtonApp,
    },

    mixins: [],

    props: {},

    data() {
        return {
            documentId: String,
            isLoading: false,
            attachedFile: false,
            circleUrl:
                "https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png",

        };

    },

    computed: {
        ...mapActions(["FETCH_ONE_APPOINTMENT"]),
        ...mapGetters({
            isLoading: "IS_LOADING_APPOINTMENT",
            appointment: "GET_ONE_APPOINTMENT",
            initPayData: "GET_INIT_RESPONSE_PAYMENT",
        }),

        demandeObj() {
            console.log("this.demandeObj", this.appointment);
            return this.appointment?.demande ?? null;
        },
        documentUrls() {
            if (!this.appointment?.demande?.document_url) {
                return [];
              }
        
              return this.appointment?.demande?.document_url.split(',').map(url => {
                const filename = url.split('/').pop();
                return { url, filename };
              });
          },
        dateNaiss() {
            return this.appointment?.demande == null ? "-": new Date(this.appointment?.demande?.client?.date_naissance_client).toLocaleDateString(undefined, {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric",
            });
        },
        clientObj() {
            return this.appointment?.demande?.client;
        },

        typeDocumentObj() {
            return this.appointment?.demande?.product;
        },

        paiementObj() {
            return this.appointment?.demande?.paiement;
        },

        timelineItem() {
            let timeList = [];
            timeList.unshift({
                date: this.formateDateAppointement(this.demandeObj?.created_at),
                action: "Enregistrement de la demande"
            })
            if (this.appointment?.demande?.paiement != null && this.appointment?.demande?.paiement?.reference_pay != null) {
                timeList.unshift({
                    date: this.formateDateAppointement(this.appointment?.demande?.paiement?.date_pay),
                    action: "Paiement de la demande"
                })
            }

            return timeList;
        },
        historiques(){
            return this.appointment?.historiques
        },

        // formattedTimestamp(date) {
        //     // return format(date, 'dd MMMM yyyy HH:mm');
        //     return "dd MMMM yyyy HH:mm";
        //   },
    },

    watch: {
        initPayData() {
            console.log("initPayData", this.initPayData.data);
            this.checkout();
        }
    },

    created() {
    },

    mounted() {
    },

    beforeMount() {
        this.documentId = this.$route?.params?.documentId;
        this.fetchData()
    },

    methods: {
        fetchData() {
            this.$store.dispatch("FETCH_ONE_APPOINTMENT", this.documentId);
        },

        formatNationnality(input) {
            let nationnality = '';
            if(input === "birth") nationnality = "Naissance";
            else if(input === "mariage") nationnality = "Mariage";
            else if(input === "naturalization") nationnality = "Naturalisation";
            else nationnality = null;
            return nationnality
        },
        formateDateAppointement(date) {
            return new Date(date).toLocaleDateString('fr-FR', {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric",
            })
        },
        
        formateDateAppointement2(date) {
            return new Date(date).toLocaleDateString('fr-FR', {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric",
                hour: "numeric",
                minute: "numeric",
                second: "numeric" 
            })
        },
        printAppointment() {
            window.open(`/recuPdf/${this.demandeObj?.code_demande}`)
        },

        buyAppointment() {
            this.$store.dispatch("INIT_PAYEMENT", this.documentId);
        },
        checkout() {
            this.isLoading = true;

            CinetPay.setConfig({
                ...this.initPayData.data.config
            });
            CinetPay.getCheckout({
                ...this.initPayData.data.params,
            });
            CinetPay.waitResponse((data) => {
                this.isLoading = true;
                console.log("waitResponse", data);

                if (data.status == "REFUSED") {
                    alert("Votre paiement a échoué");
                } else if (data.status == "ACCEPTED") {
                    alert("Votre paiement a été effectué avec succès");
                }
                window.location.reload();
                this.isLoading = false;
            });
            CinetPay.onError((data) => {
                console.log("onError ", data);
                alert("Votre paiement a échoué");
                window.location.reload();
                this.isLoading = false;
                /* this.$swal({
                     position: "center",
                     icon: "warning",
                     title: "Votre paiement a échoué",
                     showConfirmButton: false,
                     confirmButtonText: 'Ok',
                     timer: 4500
                 })*/
                // window.location.reload();
            });
        }
    },

    filters: {},
};
