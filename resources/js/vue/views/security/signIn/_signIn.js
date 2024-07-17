// @vue/component
import axios from "axios";
import {mapActions, mapGetters} from "vuex";
import ButtonApp from "../../../components/shared/ButtonApp.vue";
import utils from "../../../core/utils";

export default {
    name: 'SignIn',

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
            if (this.form.email?.trim().length == 0) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Email invalid",
                    showConfirmButton: false,
                    timer: 4500

                });
                return;
            }
            if (this.form.password?.trim().length == 0) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Votre mot de passe est obligatoire",
                    showConfirmButton: false,
                    timer: 4500
                });
                return;
            }
            const dataSend = {
                email: this.form.email,
                password: this.form.password,
            }

            // "passGKXm39BA48"
            this.isLoading = true; 
            axios.post(`/api/login_client`, dataSend)
                .then(responseAxios => {

                    const response = responseAxios.data;
                
                    this.$store.dispatch("USER", {client: response?.client});
                    utils.setJwt(response?.token);

                    // console.log("response.client ",response.client )
                    if (response.client == null) {
                        this.$swal({
                            position: "center",
                            icon: "error",
                            text: response.message ?? "L email ou le téléphone incorect",
                            title: "Echèc de connexion à votre compte",
                            showConfirmButton: true
                        });
                    } else {
                        utils.setJwt(response?.token);
                       // this.$cookies.set("infoUserClient2", response?.client);
                        this.$router.push({name: "all-documents"});
                    }
                })
                .catch((err) => {
                    console.log("err", err)
                    this.$store.dispatch("USER", {client: null});
                    this.$swal({
                        position: "center",
                        icon: "error",
                        text: err?.response?.data?.message ?? "Veuillez réesayer plutard",
                        title: "Echèc de connexion à votre compte",
                        showConfirmButton: true
                    });
                }).finally(() => {
                this.isLoading = false
            });

            console.log("this.user", this.user)

        }
    }
};
