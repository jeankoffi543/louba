<template>
    <CarousselApp/>
    <el-row>
        <!-- <ItemListeApp /> -->

        <!--       <FootApp/>-->

        <!-- <SearchStatus/> -->
        <ServiceApp/>

        <ActualityApp/>

        <PartnersApp/>

    </el-row>


</template>

<script>
import ActualityApp from '../../components/ActualityApp.vue';
import CarousselApp from '../../components/CarousselApp.vue';
import PartnersApp from "../../components/PartnersApp.vue";
import ProcedureApp from '../../components/ProcedureApp.vue';
import SearchStatus from "../../components/SearchStatus";
import ServiceApp from '../../components/ServiceApp.vue';


export default {
    name: "HomeCustomer",
    components: {PartnersApp, SearchStatus, CarousselApp, ProcedureApp, ServiceApp, ActualityApp}
}


</script>

<style scoped>
main {
    color: var(--primaryColor);
    /*background: var(--color-background);*/
}

.d-actu {

    display: visible;
}

el-row {

    overflow-x: hidden;
}
</style>
