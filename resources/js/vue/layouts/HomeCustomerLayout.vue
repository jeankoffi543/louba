<template>


    <HeaderApp/>


    <router-view></router-view>


    <FooterApp/>


    <div class="floating-btn bg-oni-primary" @click="startAppointment">
        <span class="oni-color-secondary">Prendre rendez-vous</span>
    </div>

</template>

<script>
import PartnersApp from "../components/PartnersApp";
import FooterApp from "../components/shared/FooterApp";
import HeaderApp from "../components/shared/HeaderApp.vue";


export default {
    name: "HomeCustomerLayout",
    components: {
        FooterApp,
        PartnersApp,
        HeaderApp
    },
    methods:{
        startAppointment() {
            this.$router.push({name: "login"});
        },
    }
};
</script>

<style lang="less" scoped>
main {
    color: var(--primaryColor);
    /*background: var(--color-background);*/
}

.floating-btn {
    position: fixed;
    bottom: 1rem;
    right: 1rem;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    border-radius: 10px;
    padding: 1rem;
    width: fit-content;
    margin-left: auto;
    z-index: 10;
    cursor: pointer;
    span {
        font-weight: 500;
    }
}

</style>
