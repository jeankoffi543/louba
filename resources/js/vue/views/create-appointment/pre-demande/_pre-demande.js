// @vue/component
import { mapActions, mapGetters } from "vuex";
import ButtonApp from "../../../components/shared/ButtonApp.vue";
import { KEY_FORM_JSON } from "../../../core/constants";
import axios from "axios";
import { format } from "date-fns";

export default {
    name: "StartRequest",

    components: { ButtonApp },

    mixins: [],

    props: {},

    data() {
        return {
            fileList: [],
            fileList2: [],
            documentId: String,
            demandeType: String,
            maxFileSize: 5 * 1024 * 1024, // 5 Mo en octets
            isLoadingSaveAppointment: false,
            isLoadingSaveBrouillon: false,
            formError: false,
            documentPreview: {
                type: "",
                url: "",
            },
            picturePreview: {
                url: "",
                type: "",
            },
            activeNames: ["1", "2", "3", "4", "5"],
            disabledStep1: false,
            disabledStep2: false,
            disabledStep3: true,
            disabledStep4: true,
            typeDemand: "nouvelle_demande",
            titleDocumentUpload: "Extrait de naissance (PDF, JPEG, JPG, PNG)",
            titlePhotoUpload: "Photo d'identité (JPEG, JPG, PNG)",
            typeServiceSelected: null,
            formPersonalInfo: {
                firstname: "",
                lastname: "",
                numero_recu: "",
                numero_indentification_unique: "",
                nationality: "",
                nationality_state: "",
                profession: "",
                address: "",
                email: "",
                gender: "H",
                phone: "",
                dateOfBirth: "",
                // placeOfResidence: "",
                birth_address: "",
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
                father_nationality: "",
                mother_nationality: "",
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
        ]),
        ...mapGetters({
            products: "GET_PRODUCTS",
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

    beforeMount() {
        this.fetchDataProducts();
        this.fetchDataSerives();
        this.documentId = this.$route.params.documentId;
        this.demandeType = this.$route.params.demandeType;

        this.fetchPreDemandData();
    },
    created() {},

    methods: {
        async urlToFile(url) {
            const response = await axios.get(url, { responseType: "blob" });
            const blob = response.data;
            const fileName = url.split("/").pop();
            return new File([blob], fileName, { type: blob.type });
        },
        async fetchPreDemandData() {
            if (this.demandeType === "brouillon") {
                axios
                    .get("api/get-one-appointment-brouillon/" + this.documentId)
                    .then(async (response) => {
                        const demande = response.data?.demande;
                        console.log("demande", demande);

                        if (!demande) {
                            this.$router.push("/unauthorised-pre-demande");
                            return;
                        }
                        let type_request = "";
                        console.log(response.data);
                        if (demande?.type_request === "Extrait de naissance") {
                            type_request = "nouvelle_demande";
                        } else if (
                            demande?.type_request === "Déclaration de perte"
                        ) {
                            type_request = "duplicata";
                        } else if (
                            demande?.type_request ===
                            "Copie précédent passeport"
                        ) {
                            type_request = "renouvelement";
                        } else if (
                            demande?.type_request ===
                            "Copie extrait de naissance et copie extrait de naissance du parent"
                        ) {
                            type_request = "mineur";
                        } else if (
                            demande?.type_request ===
                            "Copie extrait de naissance et décesse du parent étranger"
                        ) {
                            type_request = "binationnaux";
                        } else {
                            type_request = "nouvelle_demande";
                        }
                        this.typeDemand = type_request;
                        this.formPersonalInfo.firstname =
                            demande?.client?.prenom_client ?? "";
                        this.formPersonalInfo.lastname =
                            demande?.client?.nom_client ?? "";
                        this.formPersonalInfo.numero_recu =
                            demande?.numero_recu ?? "";
                        this.formPersonalInfo.numero_indentification_unique =
                            demande?.numero_indentification_unique ?? "";
                        this.formPersonalInfo.nationality =
                            demande?.nationality ?? "";
                        this.formPersonalInfo.nationality_state =
                            demande?.nationality_state ?? "birth";
                        this.formPersonalInfo.profession =
                            demande?.profession ?? "";
                        this.formPersonalInfo.address = demande?.address ?? "";
                        this.formPersonalInfo.email =
                            demande?.client?.email_client ?? "";
                        this.formPersonalInfo.gender =
                            demande?.client?.genre_client === "Homme"
                                ? "H"
                                : "F";
                        this.formPersonalInfo.phone =
                            demande?.client?.telephone_client ?? "";
                        this.formPersonalInfo.dateOfBirth =
                            demande?.client?.date_naissance_client ?? "";
                        this.formPersonalInfo.birth_address =
                            demande?.birth_address ?? "";
                        this.signalement.height = demande?.height ?? "";
                        this.signalement.complexion = demande?.complexion ?? "";
                        this.signalement.hair_color = demande?.hair_color ?? "";
                        this.signalement.eye_color = demande?.eye_color ?? "";
                        this.ascendants.father_firstname =
                            demande?.father_first_name ?? "";
                        this.ascendants.father_lastname =
                            demande?.father_last_name ?? "";

                        this.ascendants.father_nationality =
                            demande?.father_nationality ?? "";

                        this.ascendants.mother_nationality =
                            demande?.mother_nationality ?? "";

                        this.ascendants.mother_firstname =
                            demande?.mother_first_name ?? "";
                        this.ascendants.mother_lastname =
                            demande?.mother_last_name ?? "";

                        if (demande.document_url) {
                            const urls = demande.document_url.split(",");
                            for (const url of urls) {
                                const file = await this.urlToFile(url);
                                this.fileList.push(file);
                                this.formPersonalInfo.fileListPicture.push(
                                    file
                                );
                            }
                        }

                        if (demande.avatar_url) {
                            const urls2 = demande.avatar_url.split(",");
                            for (const url2 of urls2) {
                                const file2 = await this.urlToFile(url2);
                                this.fileList2.push(file2);
                                this.formPersonalInfo.fileListBirthCertificate.push(
                                    file2
                                );
                            }
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Erreur lors de la récupération du numéro de reçu:",
                            error
                        );
                    });
            } else {
                axios
                    .get("api/get-one-appointment/" + this.documentId)
                    .then(async (response) => {
                        const demande = response.data?.demande;
                        if (
                            demande &&
                            demande.status_demande &&
                            demande.status_demande != "REJECTED"
                        ) {
                            this.$router.push("/unauthorised-pre-demande");
                            return;
                        }
                        let type_request = "";
                        console.log(response.data);
                        if (demande?.type_request === "Extrait de naissance") {
                            type_request = "nouvelle_demande";
                        } else if (
                            demande?.type_request === "Déclaration de perte"
                        ) {
                            type_request = "duplicata";
                        } else if (
                            demande?.type_request ===
                            "Copie précédent passeport"
                        ) {
                            type_request = "renouvelement";
                        } else if (
                            demande?.type_request ===
                            "Copie extrait de naissance et copie extrait de naissance du parent"
                        ) {
                            type_request = "mineur";
                        } else if (
                            demande?.type_request ===
                            "Copie extrait de naissance et décesse du parent étranger"
                        ) {
                            type_request = "binationnaux";
                        } else {
                            type_request = "nouvelle_demande";
                        }
                        this.typeDemand = type_request;
                        this.formPersonalInfo.firstname =
                            demande?.client?.prenom_client ?? "";
                        this.formPersonalInfo.lastname =
                            demande?.client?.nom_client ?? "";
                        this.formPersonalInfo.numero_recu =
                            demande?.numero_recu ?? "";
                        this.formPersonalInfo.numero_indentification_unique =
                            demande?.numero_indentification_unique ?? "";
                        this.formPersonalInfo.nationality =
                            demande?.nationality ?? "";
                        this.formPersonalInfo.nationality_state =
                            demande?.nationality_state ?? "birth";
                        this.formPersonalInfo.profession =
                            demande?.profession ?? "";
                        this.formPersonalInfo.address = demande?.address ?? "";
                        this.formPersonalInfo.email =
                            demande?.client?.email_client ?? "";
                        this.formPersonalInfo.gender =
                            demande?.client?.genre_client === "Homme"
                                ? "H"
                                : "F";
                        this.formPersonalInfo.phone =
                            demande?.client?.telephone_client ?? "";
                        this.formPersonalInfo.dateOfBirth =
                            demande?.client?.date_naissance_client ?? "";
                        this.formPersonalInfo.birth_address =
                            demande?.birth_address ?? "";
                        this.signalement.height = demande?.height ?? "";
                        this.signalement.complexion = demande?.complexion ?? "";
                        this.signalement.hair_color = demande?.hair_color ?? "";
                        this.signalement.eye_color = demande?.eye_color ?? "";
                        this.ascendants.father_firstname =
                            demande?.father_first_name ?? "";
                        this.ascendants.father_lastname =
                            demande?.father_last_name ?? "";

                        this.ascendants.father_nationality =
                            demande?.father_nationality ?? "";

                        this.ascendants.mother_nationality =
                            demande?.mother_nationality ?? "";

                        this.ascendants.mother_firstname =
                            demande?.mother_first_name ?? "";
                        this.ascendants.mother_lastname =
                            demande?.mother_last_name ?? "";

                        if (demande.document_url) {
                            const urls = demande.document_url.split(",");
                            for (const url of urls) {
                                const file = await this.urlToFile(url);
                                this.fileList.push(file);
                                this.formPersonalInfo.fileListPicture.push(
                                    file
                                );
                            }
                        }

                        if (demande.avatar_url) {
                            const urls2 = demande.avatar_url.split(",");
                            for (const url2 of urls2) {
                                const file2 = await this.urlToFile(url2);
                                this.fileList2.push(file2);
                                this.formPersonalInfo.fileListBirthCertificate.push(
                                    file2
                                );
                            }
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Erreur lors de la récupération du numéro de reçu:",
                            error
                        );
                    });
            }
        },
        beforeUpload(file) {
            const isLtMaxSize = file.size <= this.maxFileSize;
            if (!isLtMaxSize) {
                this.$message.error(
                    `Le fichier ${file.name} est trop grand. La taille maximale est de 5 Mo.`
                );
            }
            return isLtMaxSize;
        },
        triggerUpload() {
            // Accéder au composant el-upload via ref
            const uploadComponent = this.$refs.upload;

            if (uploadComponent) {
                // Vérifier si l'input file existe avant d'essayer de cliquer dessus
                const inputElement =
                    uploadComponent.$el.querySelector('input[type="file"]');
                if (inputElement) {
                    inputElement.click();
                } else {
                    console.error("Input file element not found");
                }
            } else {
                console.error("Upload component not found");
            }
        },
        triggerUpload2() {
            // Accéder au composant el-upload via ref
            const uploadComponent = this.$refs.upload2;

            if (uploadComponent) {
                // Vérifier si l'input file existe avant d'essayer de cliquer dessus
                const inputElement =
                    uploadComponent.$el.querySelector('input[type="file"]');
                if (inputElement) {
                    inputElement.click();
                } else {
                    console.error("Input file element not found");
                }
            } else {
                console.error("Upload component not found");
            }
        },
        sendPredemande: function () {
            this.formError = false;
            this.isLoadingSaveAppointment = true;
            if (
                Object.values(this.formPersonalInfo).some((item) => item === "")
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Toutes les informations personnelles sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });

                if (this.isLoadingSaveAppointment) {
                    setTimeout(() => {
                        this.isLoadingSaveAppointment = false;
                    }, 3000);
                }

            } else if (
                Object.values(this.signalement).some((item) => item === "")
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Tous les champs du signalement sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
                if (this.isLoadingSaveAppointment) {
                    setTimeout(() => {
                        this.isLoadingSaveAppointment = false;
                    }, 3000);
                }

            } else if (
                Object.values(this.ascendants).some((item) => item === "")
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Tous les champs Ascendants sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
                if (this.isLoadingSaveAppointment) {
                    setTimeout(() => {
                        this.isLoadingSaveAppointment = false;
                    }, 3000);
                }
               
            } else if (
                this.formPersonalInfo.fileListBirthCertificate.length == 0 ||
                this.formPersonalInfo.fileListPicture.length == 0
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Les documents sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
                if (this.isLoadingSaveAppointment) {
                    setTimeout(() => {
                        this.isLoadingSaveAppointment = false;
                    }, 3000);
                }
            } else {
                this.formError = false;

                const formData = new FormData();
                let demande_id = this.demande_id;
                let brouillonId = null;
                if (this.demandeType == "brouillon") {
                    demande_id = this.demandeType;
                    brouillonId = this.documentId;
                } else {
                    demande_id = this.documentId ?? null;
                }

                formData.append("demande_id", demande_id);

                formData.append("brouillonId", brouillonId);

                this.formPersonalInfo.fileListPicture.forEach((file) => {
                    formData.append("document1[]", file);
                });

                formData.append(
                    "document2",
                    this.formPersonalInfo?.fileListBirthCertificate[0]
                );

                formData.append("gender", this.formPersonalInfo?.gender);
                formData.append("nom", this.formPersonalInfo?.lastname);
                formData.append("prenom", this.formPersonalInfo?.firstname);
                formData.append("email", this.formPersonalInfo?.email);
                formData.append("telephone", this.formPersonalInfo?.phone);
                formData.append(
                    "nationality",
                    this.formPersonalInfo?.nationality
                );
                formData.append(
                    "nationality_state",
                    this.formPersonalInfo?.nationality_state
                );
                formData.append(
                    "profession",
                    this.formPersonalInfo?.profession
                );

                formData.append("address", this.formPersonalInfo?.address);

                formData.append("height", this.signalement?.height);
                formData.append("complexion", this.signalement?.complexion);
                formData.append("hair_color", this.signalement?.hair_color);
                formData.append("eye_color", this.signalement?.eye_color);
                formData.append(
                    "date_naissance",
                    format(
                        new Date(this.formPersonalInfo?.dateOfBirth),
                        "yyyy-MM-dd"
                    )
                );

                formData.append(
                    "lieu_de_residence",
                    this.formPersonalInfo?.placeOfResidence
                );
                formData.append(
                    "birth_address",
                    this.formPersonalInfo?.birth_address
                );

                formData.append("type_request", this.typeDemand);
                formData.append(
                    "father_first_name",
                    this.ascendants?.father_firstname
                );

                formData.append(
                    "mother_nationality",
                    this.ascendants?.mother_nationality
                );

                formData.append(
                    "mother_nationality",
                    this.ascendants?.father_nationality
                );

                formData.append(
                    "father_last_name",
                    this.ascendants?.father_lastname
                );
                formData.append(
                    "mother_first_name",
                    this.ascendants?.mother_firstname
                );
                formData.append(
                    "mother_last_name",
                    this.ascendants?.mother_lastname
                );
                formData.append(
                    "numero_recu",
                    this.formPersonalInfo?.numero_recu
                );
                formData.append(
                    "numero_indentification_unique",
                    this.formPersonalInfo?.numero_indentification_unique
                );

                axios
                    .post(`/api/save-pre-demande`, formData)
                    .then((responseAxios) => {
                        console.log("responseAxios", responseAxios);
                        if (!responseAxios.data.demande) {
                            this.$swal({
                                position: "center",
                                icon: "warning",
                                title: responseAxios.data?.message ?? "",
                                showConfirmButton: false,
                                timer: 4500,
                            });
                            return;
                        }

                        if (responseAxios.data.status == 200) {
                            this.$swal({
                                position: "center",
                                icon: "success",
                                title:
                                    responseAxios.data?.message ??
                                    "Pré-demande enregistré",
                                showConfirmButton: true,
                                confirmButtonText: "Ok",
                                timer: 4500,
                            }).then((result) => {
                                this.$router.push({
                                    name: "all-documents",
                                    params: {
                                        documentId:
                                            responseAxios.data.demande?.id,
                                    },
                                });
                            });
                        }
                    })
                    .catch((err) => {
                        this.$swal({
                            position: "center",
                            icon: "warning",
                            title: "Echèc de l'enregistrement",
                            showConfirmButton: false,
                            timer: 4500,
                        });
                        console.log("err", err);
                    })
                    .finally(() => {});
            }
        },
        sendPredemandeBrouillon: function () {
            this.formError = false;
            this.isLoadingSaveBrouillon = true;
            if (
                Object.values(this.formPersonalInfo).some((item) => item === "")
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Toutes les informations personnelles sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });

              

                if (this.isLoadingSaveBrouillon) {
                    setTimeout(() => {
                        this.isLoadingSaveBrouillon = false;
                    }, 3000);
                }
            } else if (
                Object.values(this.signalement).some((item) => item === "")
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Tous les champs du signalement sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
             

                if (this.isLoadingSaveBrouillon) {
                    setTimeout(() => {
                        this.isLoadingSaveBrouillon = false;
                    }, 3000);
                }
            } else if (
                Object.values(this.ascendants).some((item) => item === "")
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Tous les champs Ascendants sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
               

                if (this.isLoadingSaveBrouillon) {
                    setTimeout(() => {
                        this.isLoadingSaveBrouillon = false;
                    }, 3000);
                }
            } else if (
                this.formPersonalInfo.fileListBirthCertificate.length == 0 ||
                this.formPersonalInfo.fileListPicture.length == 0
            ) {
                this.formError = true;
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Les documents sont obligatoire",
                    showConfirmButton: false,
                    timer: 4500,
                });
                

                if (this.isLoadingSaveBrouillon) {
                    setTimeout(() => {
                        this.isLoadingSaveBrouillon = false;
                    }, 3000);
                }
            } else {
                this.formError = false;

                const formData = new FormData();
                formData.append("demande_id", this.documentId ?? null);

                this.formPersonalInfo.fileListPicture.forEach((file) => {
                    formData.append("document1[]", file);
                });

                formData.append(
                    "document2",
                    this.formPersonalInfo?.fileListBirthCertificate[0]
                );

                formData.append("gender", this.formPersonalInfo?.gender);
                formData.append("nom", this.formPersonalInfo?.lastname);
                formData.append("prenom", this.formPersonalInfo?.firstname);
                formData.append("email", this.formPersonalInfo?.email);
                formData.append("telephone", this.formPersonalInfo?.phone);
                formData.append(
                    "nationality",
                    this.formPersonalInfo?.nationality
                );
                formData.append(
                    "nationality_state",
                    this.formPersonalInfo?.nationality_state
                );
                formData.append(
                    "profession",
                    this.formPersonalInfo?.profession
                );

                formData.append("address", this.formPersonalInfo?.address);

                formData.append("height", this.signalement?.height);
                formData.append("complexion", this.signalement?.complexion);
                formData.append("hair_color", this.signalement?.hair_color);
                formData.append("eye_color", this.signalement?.eye_color);
                formData.append(
                    "date_naissance",
                    format(
                        new Date(this.formPersonalInfo?.dateOfBirth),
                        "yyyy-MM-dd"
                    )
                );

                formData.append(
                    "lieu_de_residence",
                    this.formPersonalInfo?.placeOfResidence
                );
                formData.append(
                    "birth_address",
                    this.formPersonalInfo?.birth_address
                );

                formData.append("type_request", this.typeDemand);
                formData.append(
                    "father_first_name",
                    this.ascendants?.father_firstname
                );

                formData.append(
                    "mother_nationality",
                    this.ascendants?.mother_nationality
                );

                formData.append(
                    "father_nationality",
                    this.ascendants?.father_nationality
                );

                formData.append(
                    "father_last_name",
                    this.ascendants?.father_lastname
                );
                formData.append(
                    "mother_first_name",
                    this.ascendants?.mother_firstname
                );
                formData.append(
                    "mother_last_name",
                    this.ascendants?.mother_lastname
                );
                formData.append(
                    "numero_recu",
                    this.formPersonalInfo?.numero_recu
                );
                formData.append(
                    "numero_indentification_unique",
                    this.formPersonalInfo?.numero_indentification_unique
                );

                axios
                    .post(`/api/save-pre-demande-brouillon`, formData)
                    .then((responseAxios) => {
                        console.log("responseAxios", responseAxios);
                        if (!responseAxios.data.demande) {
                            this.$swal({
                                position: "center",
                                icon: "warning",
                                title: responseAxios.data?.message ?? "",
                                showConfirmButton: false,
                                timer: 4500,
                            });
                            return;
                        }

                        if (responseAxios.data.status == 200) {
                            this.$swal({
                                position: "center",
                                icon: "success",
                                title:
                                    responseAxios.data?.message ??
                                    "Brouillon enregistré",
                                showConfirmButton: true,
                                confirmButtonText: "Ok",
                                timer: 4500,
                            }).then((result) => {
                                this.$router.push({
                                    name: "mon-brouillon",
                                    params: {
                                        documentId:
                                            responseAxios.data.demande?.id,
                                    },
                                });
                            });
                        }
                    })
                    .catch((err) => {
                        this.$swal({
                            position: "center",
                            icon: "warning",
                            title: "Echèc de l'enregistrement",
                            showConfirmButton: false,
                            timer: 4500,
                        });
                        console.log("err", err);
                    })
                    .finally(() => {});
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
            this.picturePreview.type = "image";
            // this.onSubmitImage();
        },
        onRemoveBirthCertificate(file, fileList) {
            this.formPersonalInfo.fileListBirthCertificate = [];
            this.picturePreview.type = "";
        },

        uploadPicture(file, fileList) {
            // this.formPersonalInfo.fileListPicture = [];
            this.formPersonalInfo.fileListPicture.push(file.raw);
            console.log("fileList", fileList);
            // this.formPersonalInfo.fileListPicture = fileList.map((f) => f.raw);
        },
        onRemovePicture(file, fileList) {
            console.log("fileList removed", fileList);
            // Met à jour fileListPicture avec la liste des fichiers restants
            // this.formPersonalInfo.fileListPicture = fileList;
            this.formPersonalInfo.fileListPicture = fileList;

            // Si la liste des fichiers est vide, réinitialise documentPreview.type
            if (fileList.length === 0) {
                this.documentPreview.type = "";
            }
        },

        /*END STEP 4*/

        /*STEP 3*/
        onChangTypeDemande(nameNextStep) {
            this.$store.dispatch("FORM_DATA_REQUEST", {
                key: [KEY_FORM_JSON.TYPE_REQUEST],
                data: this.typeDemand,
            });
            // this.disabledStep4 = false;
            console.log("this.typeDemand", this.typeDemand);
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
