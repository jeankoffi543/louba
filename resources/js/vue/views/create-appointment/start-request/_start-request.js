// @vue/component
import { mapActions, mapGetters } from "vuex";
import ButtonApp from "../../../components/shared/ButtonApp.vue";
import { KEY_FORM_JSON } from "../../../core/constants";

export default {
    name: "StartRequest",

    components: { ButtonApp },

    mixins: [],

    props: {},

    data() {
        return {
            preDemande: null,
            formError: false,
            activeNames: ["1", "2", "3", "4", "5"],
            disabledStep1: false,
            disabledStep2: false,
            disabledStep3: true,
            disabledStep4: true,
            typeDemand: "nouvelle_demande",
            titleDocumentUpload: "Extrait de naissance",
            typeServiceSelected: null,
            pointEnrolementServices: [],
            formPersonalInfo: {
                firstname: "",
                lastname: "",
                numero_recu: "",
                documentId: String,
                siteAppointmentId: "",
                serviceId: "",
                nationality: "",
                nationality_state: "",
                profession: "",
                email: "",
                gender: "H",
                phone: "",
                dateOfBirth: "",
                placeOfResidence: "",
                fileListPicture: [],
                fileListBirthCertificate: [],
            },
            signalement: {
                height: 0,
                complexion: "",
                hair_color: "",
                eye_color: "",
            },
            ascendants: {
                father_firstname: "",
                father_lastname: "",
                mother_firstname: "",
                mother_lastname: "",
            },
            demandeType: null,
            pickerOptions: {
                disabledDate(time) {
                    return time.getTime() > Date.now();
                },
            },
        };
    },

    computed: {
        ...mapActions([
            "FORM_DATA_REQUEST",
            "FETCH_PRODUCTS",
            "FETCH_SERVICES",
            "FETCH_SELECT_SERVICE",
            "FETCH_ENROLMENTS_POINTS",
        ]),
        ...mapGetters({
            products: "GET_PRODUCTS",
            enrolmentsPoint: "GET_ENROLMENTS_POINTS",
            isLoading:
                "IS_LOADING_APPOINTMENT" ||
                "IS_LOADING_PRODUCTS" ||
                "IS_LOADING_PRODUCTS",
            productSelected: "GET_PRODUCT_SELECTED",
            serviceSelected: "GET_SERVICE_SELECTED",
            selectService: "GET_SELECT_SERVICE",
            services: "GET_SERVICES",
            formRequestData: "GET_FORM_DATA_REQUEST",
        }),

        servivesAvailable() {
            return (this.services || []).filter(
                (value) => value.visible_in_flow
            );
        },
    },

    watch: {
        products() {
            this.productSelected = this.products[0];
            this.radioAppointmentChangeProduct(this.products[0], 2);
        },
    },

    mounted() {
        const id = this.$route.params.documentId; // This will give you the value "1"
        this.fetchPreDemandData(id); // Now you can use this id in a request
    },

    beforeMount() {
        this.fetchDataProducts();
        this.fetchDataSerives();
        this.formPersonalInfo.documentId = this.$route.params.documentId;
    },
    created() {
        this.$store.dispatch("FETCH_ENROLMENTS_POINTS");
    },

    methods: {
        async fetchPreDemandData(id) {
            axios
                .get("api/get-one-appointment-2/" + id)
                .then(async (response) => {
                    const demande = response.data?.demande;
                    this.preDemande = demande;
                });
        },
        changeEnrolment: function (item) {
            const pointEnrol = this.enrolmentsPoint?.find(
                (enrolment) => enrolment.id_pe == item
            );
            this.pointEnrolementServices = pointEnrol?.services;
        },
        onSwitchPage: function () {
            this.formError = false;
            if (
                !this.formPersonalInfo.serviceId ||
                this.formPersonalInfo.serviceId == null ||
                this.formPersonalInfo.serviceId == ""
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Le type de service est obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
                return;
            } else if (
                this.formPersonalInfo.numero_recu === "" ||
                this.formPersonalInfo.numero_recu === null ||
                this.formPersonalInfo.numero_recu === undefined ||
                this.formPersonalInfo.numero_recu === "" ||
                this.formPersonalInfo.siteAppointmentId === null ||
                this.formPersonalInfo.siteAppointmentId == ""
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Le numéro du récu est obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
                return;
            } else {
                this.formError = false;
                const payload = {
                    key: [KEY_FORM_JSON.FORM_INFO_USER],
                    data: {
                        ...this.formPersonalInfo,
                        ...this.signalement,
                        ...this.ascendants,
                    },
                };
                this.$store.dispatch("FORM_DATA_REQUEST", payload);
                this.$router.push({ name: "appointment-end" });
            }
        },
        handleChange: function (val) {
            // console.log("handleChange val", val)
            this.activeNames.push(val);
        },

        /*STEP 4*/

        // eslint-disable-next-line no-unused-vars
        uploadBirthCertificate(file, fileList) {
            this.formPersonalInfo.fileListBirthCertificate = [];
            this.formPersonalInfo.fileListBirthCertificate.push(file.raw);
            // this.onSubmitImage();
        },
        onRemoveBirthCertificate(file, fileList) {
            this.formPersonalInfo.fileListBirthCertificate = [];
        },

        uploadPicture(file, fileList) {
            this.formPersonalInfo.fileListPicture = [];
            this.formPersonalInfo.fileListPicture.push(file.raw);
        },
        onRemovePicture(file, fileList) {
            this.formPersonalInfo.fileListPicture = [];
        },

        /*END STEP 4*/

        /*STEP 3*/
        onChangTypeDemande(nameNextStep) {
            this.$store.dispatch("FORM_DATA_REQUEST", {
                key: [KEY_FORM_JSON.TYPE_REQUEST],
                data: this.typeDemand,
            });
            // this.disabledStep4 = false;

            if (this.typeDemand === "nouvelle_demande") {
                this.titleDocumentUpload = "Extrait de naissance";
            } else if (this.typeDemand === "duplicata") {
                this.titleDocumentUpload = "Déclaration de perte";
            } else if (this.typeDemand === "renouvelement") {
                this.titleDocumentUpload = "Copie précédent passeport";
            } else if (this.typeDemand === "mineur") {
                this.titleDocumentUpload =
                    "Copie extrait de naissance et copie extrait de naissance du parent";
            } else if (this.typeDemand === "binationnaux") {
                this.titleDocumentUpload =
                    "Copie extrait de naissance et pièce d'identité du parent étranger";
            }

            this.onNextStep(nameNextStep);
        },
        /*END STEP 3*/

        /*STEP 2*/
        fetchDataSerives() {
            this.$store.dispatch("FETCH_SERVICES");
        },
        radioAppointmentChangeService(item, nameNextStep) {
            this.$store.dispatch("SERVICE_SELECTED", item);
            this.typeServiceSelected = item;
            this.$store.dispatch("FORM_DATA_REQUEST", {
                key: [KEY_FORM_JSON.SERVICE],
                data: item,
            });
            this.onNextStep(nameNextStep);
        },

        /*END STEP 2*/

        /*STEP 1*/
        fetchDataProducts() {
            this.$store.dispatch("FETCH_PRODUCTS");
        },

        onNextStep: function (name) {
            this.activeNames.push(name);
        },
        radioAppointmentChangeProduct(item, nameNextStep) {
            if (!item?.flow_enable) {
                return;
            }
            this.demandeType = item.form_type;
            this.$store.dispatch("PRODUCT_SELECTED", item);
            this.$store.dispatch("FORM_DATA_REQUEST", {
                key: [KEY_FORM_JSON.PRODUCT],
                data: item,
            });

            if (!item?.select_service_is_required) {
                // this.disabledStep2 = true;
                // this.disabledStep3 = false;
                this.activeNames = this.activeNames.filter(
                    (it) => it != nameNextStep
                );
                this.$store.dispatch("FORM_DATA_REQUEST", {
                    key: [KEY_FORM_JSON.SERVICE],
                    data: null,
                });
                this.onNextStep(3);
            } else {
                // this.disabledStep2 = false;
                this.onNextStep(nameNextStep);
            }
        },
        /*END STEP 1*/
    },
};
