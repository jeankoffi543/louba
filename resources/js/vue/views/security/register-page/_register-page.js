// @vue/component

import axios from "axios";
import {mapActions, mapGetters} from "vuex";
import ButtonApp from "../../../components/shared/ButtonApp";
import utils from "../../../core/utils";

export default {
    name: "RegisterPage",

    components: {ButtonApp},

    mixins: [],

    props: {},

    data() {
        return {
            form: {
                firstName: "",
                lastname: "",
                email: "",
                phone: ""
            }
        }
    },

    computed: {
        ...mapActions(["REGISTER_USER"]),
        ...mapGetters({
            isLoading: "IS_LOADING_SECURITY",
            user: "USER_REGISTER",
            status_message: "STATUS_MESSAGE"
        })
    },

    watch: {},

    created() {
    },

    methods: {
        async onSumbitForm() {
            if (this.form.email.trim().length == 0) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Email invalid",
                    showConfirmButton: false,
                    timer: 4500

                });
                return;
            }
            if (this.form.firstName.trim().length == 0) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Votre prénom est obligatoire",
                    showConfirmButton: false,
                    timer: 4500
                });
                return;
            }
            if (this.form.lastname.trim().length == 0) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Votre nom est obligatoire",
                    showConfirmButton: false,
                    timer: 4500

                });
                return;
            }
            if (this.form.phone.trim().length == 0) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Votre numéro de téléphone est obligatoire",
                    showConfirmButton: false,
                    timer: 4500

                });
                return;
            }
            const dataSend = {
                email: this.form.email,
                prenom: this.form.firstName,
                nom: this.form.lastname,
                telephone: this.form.phone
            }
            // "passGKXm39BA48"
            this.isLoading= true;
            axios.post(`/api/register_client`, dataSend)
                .then(responseAxios => {
                    const response = responseAxios.data;
                    this.$store.dispatch("USER", {client: response?.client});
                    if (response.client == null) {
                        this.$swal({
                            position: "center",
                            icon: "error",
                            text: response.message ?? "L email ou le téléphone existe deja",
                            title: "Echèc de création de votre compte",
                            showConfirmButton: true
                        });
                    } else {
                        utils.setJwt(response?.token);
                        //this.$cookies.set("infoUserClient", response?.client);
                        this.$router.push({name: "appointment-start"});
                    }
                })
                .catch((err) => {
                    console.log("err", err)
                    this.$store.dispatch("USER", {client: null});
                    let message = err?.response?.data?.message;
                    if (Object.values(err?.response?.data?.errors).length != 0) {
                        message = Object.values(err?.response?.data?.errors)[0][0] ?? "Veuillez réesayer plutard";
                    }
                    // message
                    this.$swal({
                        position: "center",
                        icon: "error",
                        text: message,
                        title: "Echèc de création de votre compte",
                        showConfirmButton: true
                    });
                }).finally(() => {
               this.isLoading= false
            });

            console.log("this.user", this.user)

        }
    }
}
