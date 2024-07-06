<template>
    <div class="w-100 oni-font mt-4 p-4">
        <div class="overlay shadow"></div>
        <div class="container text-start p-3 text-light" data-aos="fade-down-right">
            <div class="row  d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-9 container-hearder">
                    <h1 class="fw-bold colors fs-1 ">
                        Statut de mon document
                    </h1>
                    <img src="/assets/vue/imgs/others/divider-red.png"/>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-9 ">
                    <el-form class="row g-3 needs-validation" label-position="top">
                        <div class="row d-flex justify-content-center" style="margin-top: 1rem;">
                            <div class="col-sm-12 col-item col-md-8" style=" ">
                                <el-form-item required>
                                    <el-input v-model="code"
                                              placeholder="Code Demande (reçu par sms ou par email)"
                                              size="large"/>
                                </el-form-item>
                            </div>

                            <div class="col-sm-12  btns col-md-4">
                                <button v-loading="isLoading" class="btn   bg-oni-primary text-light btn-lg"
                                        @click="searchDocument">
                                    Rechercher
                                </button>
                            </div>

                        </div>
                    </el-form>
                </div>
            </div>


        </div>
    </div>

</template>

<script>
import axios from "axios";
import {mapActions} from "vuex";

export default {
    name: "SearchStatus",

    data() {
        return {
            code: "",
            isLoading: false
        }
    },
    computed: {
        ...mapActions(['RESULT_DOCUMENT'])
    },

    mounted() {
    },

    methods: {
        searchDocument() {
            this.isLoading = true;

            axios.get(`/api/search-document/${this.code}`).then(responseAxios => {
                console.log("responseAxios.data", responseAxios.data)
                this.$store.dispatch('RESULT_DOCUMENT', responseAxios.data);
            }).catch((err) => {
                this.$store.dispatch('RESULT_DOCUMENT', null);
                console.log("err", err);
            }).finally(() => {
                this.isLoading = false;
                this.$router.push({name: "status-document"});
            });

        }
    }
};
</script>

<style scoped>
.el-form-item {
    margin-bottom: 0 !important;
    width: 100%;
}
.colors{
    color:#000;
}

.btns{
    display:block;
}

.col-item {
    align-items: center;
    display: flex;
    flex: 1;
    width: 100%;
}

.container-hearder {
    margin: auto auto 1rem;
    justify-content: center;
    align-items: center;
    display: flex;
    flex-direction: column;

}

.form-select:focus, .form-control:focus {
    color: #212529;
    background-color: #fff;
    border-color: var(--primaryColor);
    outline: 0;
    box-shadow: 0 0 0 0.25rem var(--primary300Color);
}

.overlay {
    position: absolute;
    background-image: url("/assets/vue/imgs/others/thinking-woman.png");
    filter: blur(1.5rem);
    background-size: cover;
    opacity: 98%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

@media screen and (max-width: 768px) {

.btns{
    margin-top:15px;
    display:block;
}

}


</style>
