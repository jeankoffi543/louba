<template>

    <div class="container mt-5 col-lg-9">
        <div class="col-lg-7 text-light mt-5 mb-3">
            <h1 class="display-4 fw-bold colors fs-1">
                Nos Produits et Services
            </h1>
            <img alt="" src="/assets/vue/imgs/others/divider-red.png"/>
        </div>
        <div class="col-sm-12 col-lg-12">
            <div class="container ">
                <div v-loading="isLoadingS || isLoadingP"
                     class="row  d-flex flex-sm-column flex-md-row flex-lg-row containerCard ">
                    <EmptyState v-if="allProducts.length===0" @reload="onReloadData"></EmptyState>
                    <ProductAndServiceItem v-for="(product, index) in allProducts" v-else
                                           :key="index"
                                           :product="product"
                                           @click="go"/>


                </div>

            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import EmptyState from "../components/shared/EmptyState";
import ProductAndServiceItem from "./ProductAndServiceItem.vue";

export default {
    name: "ServiceApp",
    components: {ProductAndServiceItem, EmptyState},
    data() {
        return {};
    },
    computed: {
        ...mapActions(["FETCH_PRODUCTS", 'FETCH_SERVICES']),
        ...mapGetters({
            isLoadingP: "IS_LOADING_PRODUCTS",
            isLoadingS: "IS_LOADING_SERVICES",
            dataProducts: "GET_PRODUCTS",
            dataServices: "GET_SERVICES"
        }),
        allProducts: function () {
                let dataServices = this.dataServices.filter(value => value?.is_public)
            if (this.dataProducts) {
                return this.dataProducts.concat(...dataServices);
            }
            return [].concat(...dataServices);
        }
    },
    beforeMount() {
        this.fetchData();
    },
    mounted() {
    },
    methods: {
        fetchData() {
            this.$store.dispatch('FETCH_PRODUCTS');
            this.$store.dispatch('FETCH_SERVICES');
        },
        go: function () {
            // @Todo redirect to detail
            // this.$router.push({name: nameRoute});
        },

        onReloadData() {
            this.fetchData();
        }
    }

};
</script>

<style lang="less" scoped>

@media screen and (min-width: 768px) {

    .display-flex {

        display: flex;
    }

    .text-align {
        margin-right: 5px;
        margin-left: 5px;
    }
    .colors{
        color:black;
    }
    .cardes{
        background:#000;
    }

    .containerCard{

        color:white;
    }
      .trait{
        display:flex;
        justify-content:center;
        width:25px;
        height:3px;
        margin-left:auto;
        margin-right:auto;
        margin-bottom:15px;
        border-radius:5px;
        background:#00ccc2;
    }
}
@media screen and (max-width: 772px){
    .colors{
        color:black;
    }
}


</style>
