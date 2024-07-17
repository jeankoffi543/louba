<template>
    <TopHeader/>
    <el-menu
        :default-active="activeIndex"
        class="el-menu-demo shadow"
        mode="horizontal"
        @select="handleSelect"
    >
        <el-menu-item index="0">
            <LogoApp></LogoApp>
        </el-menu-item>

        <el-menu-item index="1">
            <router-link :to="{name: 'customer-home'}">
                ACCUEIL
            </router-link>
        </el-menu-item>
         <el-menu-item index="2">
            <router-link :to="{name: 'sentense-dg'}">
                A propos de nous
            </router-link>
        </el-menu-item>

        <el-sub-menu index="4">
            <template #title> NOS SERVICES</template>
            <el-menu-item index="4-1">
                <router-link :to="{name: 'service-vip'}" class="">
                    Service VIP
                </router-link>
            </el-menu-item>
            <el-menu-item index="4-2">
                <router-link :to="{name: 'procedure-urgence'}" class="">
                    Procédure d'urgence
                </router-link>
            </el-menu-item>
        </el-sub-menu>

        <el-sub-menu index="3">
            <template #title>Demandes</template>
            <el-menu-item index="3-1">
                <router-link :to="{name: 'passport'}" class="">
                    Passeport
                </router-link>
            </el-menu-item>
            <el-menu-item index="3-2" @click="openWindow()">
                <router-link :to="{name: 'list-docs-visa'}" class="">
                    Visa
                </router-link>
            </el-menu-item>
            <el-menu-item index="3-3">
                <router-link :to="{name: 'titre-sejour'}" class="">
                    Titre de séjour
                </router-link>
            </el-menu-item>
        </el-sub-menu>

        <el-menu-item index="5">
            <router-link :to="{name: 'reclamation', params:{title: 'Réclamations et Contentieux'}}"
                         class="dropdown-item">
                Nous contactez
            </router-link>
        </el-menu-item>
    </el-menu>
</template>

<script>


import LogoApp from "../../components/shared/LogoApp";
import TopHeader from "../../components/shared/TopHeader";

export default {
    name: 'HeaderApp',
    components: {
        TopHeader,
        LogoApp
    },
    data() {
        return {
            activeIndex: "1",
            activeIndex2: "1"
        };
    },
    methods: {
        openWindow() {
            window.open("https://www.paf.gov.gn/visa", "_blank");
        },
        startAppointment() {
            this.$router.push({name: "appointment-start"});
        },
        handleSelect(key, keyPath) {
           // console.log(key, keyPath);
        }
    }


};
</script>
<style lang="less" scoped>

.el-menu--horizontal .el-menu-item:not(.is-disabled):focus, .el-menu--horizontal .el-menu-item:not(.is-disabled):hover {
    color: inherit;
    background-color: inherit;
}

.el-sub-menu,
.el-menu-item {
    font-weight: 600 !important;
    //font-size: 14px !important;
    //color: var(--primaryColor) !important;

    a {
        color: var(--primaryColor) !important;
    }

    .color-white {
        color: white !important;
    }

    .el-sub-menu__title, * {
        //font-size: 12px !important;
    }

    &.is-active {
        border-bottom: 2px solid var(--secondaryColor) !important;
        //color: var(--el-menu-active-color) !important;
        //background-color: #e1f2c963;
    }

    a {
        text-decoration: none;
        color: var(--bs-dropdown-link-color);
        font-weight: 600;
    }
}

::v-deep .el-sub-menu .el-sub-menu__icon-arrow{
    right: -3px;
}
.btn-oni :hover {
    background-color: #033a2b !important;
    font-size: 20px;
}

.dropdown-header {
    color: #edb222;
}

.el-menu-demo {
    align-items: center;
    justify-content: center;
}

.nav-link {
    color: #008F5D;
    text-transform: uppercase;
    font-size: 14px;
    padding: initial;
    background: #777 !important;
}

.nav-link:hover {
    background: #1131ce !important;
}


.icon-color {
    color: #033a2b;
}

.flex-grow {
    flex-grow: .2;
}

@media screen and (max-width: 768px) {
    .d-no {
        display: none;
    }

    .dropdown-menu {
        width: 400px !important;
    }

    .el-row.app-logo {
        width: 20%;
    }
}

/* ============ desktop view ============ */
@media all and (min-width: 992px) {
}

/* ============ desktop view .end// ============ */

/* ============ mobile view ============ */
@media (max-width: 991px) {
}


/* ============ mobile view .end// ============ */

</style>
