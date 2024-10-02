<template>
    <el-container class="dash">
        <el-aside class="vert" width="250px">
            <el-container class="container-logo container-logo-aside app-ml-0">
                <LogoApp :show-name="false"></LogoApp>
            </el-container>

            <el-menu active-text-color="var(--gray400Color)" background-color="var(--gray400Color)" class="menu"
                text-color="#FFF">
                
                <el-menu-item index="1-3" @click="$router.push({ name: 'pre-demande' })">Mes pré demandes
                </el-menu-item>
                
                <el-menu-item index="1-1" @click="$router.push({ name: 'all-documents' })">Mes rendez-vous
                </el-menu-item>

                <el-menu-item index="1-2" @click="$router.push({ name: 'mon-brouillon' })">Mon brouillon
                </el-menu-item>
                <!-- <el-menu-item index="1-2" @click="$router.push({ name: 'appointment-start' })">Prendre rendez-vous
                </el-menu-item> -->


                <!--                <el-menu-item
                    index="1-3"
                    @click="$router.push({ name: 'downloadable' })"
                >Télécharger mes documents
                </el-menu-item>-->
                <!-- <el-menu-item index="1-4" @click="$router.push({ name: 'satutdocument' })">
                    Statut de mon document
                </el-menu-item> -->
                <!-- <el-menu-item index="1-3" @click="$router.push({ name: 'customer-home' })">
                    Retour vers le portail
                </el-menu-item> -->

            </el-menu>
            <el-container class="foot-aside">
                <div class="app-w-100 app-justify-content-center app-align-items-center app-d-flex">
                    <el-button class="app-w-100 text-white" type="text" v-on:click="logOut">
                        <i class="el-icon-switch-button colors"></i>
                        Déconnexion
                    </el-button>
                </div>

            </el-container>
        </el-aside>

        <el-container class="app-h-100vh">
            <el-header>

                <div class="app-d-flex app-align-items-center app-justify-content-flex-end w-75">
                    <el-row :align="'center'" :gutter="24" class="w-100 justify-content-end">
                        <!--                        <el-col :sm="5" :xs="24">
                                                    <el-badge :max="10" :value="numberAppointmentReserve" class="item">
                                                        <i class="el-icon-shopping-cart-2"></i>
                                                    </el-badge>
                                                </el-col>-->
                        <el-col :sm="8" :xs="24" class="d-flex align-items-center icon p-0">
                            <el-avatar :size="30" :src="circleUrl" class="taille"></el-avatar>
                        </el-col>
                        <el-col :sm="8" :xs="24" class="d-flex align-items-center fullname app-pl-0">
                            <h3 class="user-ref app-ml-1 app-m-0 app-text-primary">
                                <el-dropdown>
                                    <span class="">
                                        <b>{{ user?.nom_client }} {{ user?.prenom_client }}</b>
                                        <el-icon class="el-icon--right">
                                            <arrow-down />
                                        </el-icon>
                                    </span>
                                    <template #dropdown>
                                        <el-dropdown-menu>
                                            <el-dropdown-item @click="dialogFormVisible = true">Modifier mon mot de
                                                passe
                                            </el-dropdown-item>
                                        </el-dropdown-menu>
                                    </template>
                                </el-dropdown>
                            </h3>
                        </el-col>
                    </el-row>

                </div>


            </el-header>
            <section class="sidebar-wrapper" v-bind:class="sidebarFlag ? 'overlay' : ''">
                <div class="sidebar ">
                    <div class="sidebar-header">
                        <el-aside class="vert2" width="250px">

                            <button class="close" @click="sidebarFlag = !sidebarFlag">
                                <span>&times;</span>
                            </button>
                            <el-container class="container-logo app-ml-0">
                                <LogoApp :show-name="false"></LogoApp>
                            </el-container>
                            <el-menu active-text-color="var(--primaryColor)" background-color="var(--primaryColor)"
                                class="menu1" text-color="#FFF">
                                <el-menu-item index="1-1" @click="$router.push({ name: 'all-documents' })">Documents
                                </el-menu-item>
                                <!--                                <el-menu-item index="1-2" @click="$router.push({ name: 'downloadable' })">
                                                                    Télécharger mes documents
                                                                </el-menu-item>-->
                                <el-menu-item index="1-3" @click="$router.push({ name: 'login' })">
                                    Retour vers le portail
                                </el-menu-item>

                                <!--        <el-submenu index="1">
                                          <template v-slot:title>
                                            <i class="el-icon-date"></i>
                                            Mes rendez-vous
                                          </template>

                                        </el-submenu>-->
                            </el-menu>
                            <el-container class="foot-aside2">
                                <div class="app-w-100 app-justify-content-center app-align-items-center app-d-flex">
                                    <el-button class="app-w-100" type="text" v-on:click="logOut">
                                        <i class="el-icon-switch-button colors"></i>
                                        Déconnexion
                                    </el-button>
                                </div>
                            </el-container>
                        </el-aside>
                    </div>

                </div>
            </section>

            <el-container class="container-el-breadcrumb">
                <el-breadcrumb separator-class="el-icon-arrow-right">
                    <!--          <el-breadcrumb-item :to="{ path: '/' }"> Accueil</el-breadcrumb-item>-->
                    <el-breadcrumb-item v-for="(item, index) in breadcrumbItem" :key="index" @click="redirectTo(item)">
                        {{ item?.label }}
                    </el-breadcrumb-item>
                </el-breadcrumb>
            </el-container>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>

        <el-dialog v-model="dialogFormVisible" title="Modifier mon mot de passe">
            <el-form :model="form">
                <el-form-item label="Ancien Mot de Passe">
                    <el-input v-model="form.lastPassword" autocomplete="off" type="password" />
                </el-form-item>
                <el-form-item label="Nouveau Mot de Passe">
                    <el-input v-model="form.password" autocomplete="off" type="password" />
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button v-loading="isLoading" @click="closeModal">Annuler</el-button>
                    <el-button v-loading="isLoading" type="primary" @click="updatePassword">
                        Confirmer
                    </el-button>
                </span>
            </template>
        </el-dialog>

    </el-container>
</template>

<script>
import axios from "axios";
import { mapActions, mapGetters } from "vuex";
import LogoApp from "../components/shared/LogoApp";
import * as utils from "../core/utils";

export default {
    name: "DashboardLayout",
    components: {
        LogoApp
    },
    computed: {
        ...mapGetters({
            user: "GET_USER"
        }),
        ...mapActions(['FETCH_USER'])
    },
    data() {

        return {
            sidebarFlag: false,
            isLoading: false,
            dialogFormVisible: false,
            form: {
                lastPassword: '',
                password: ''
            },
            numberAppointmentReserve: 0,
            title: {
                type: String,
                default: "title"
            },
            Ur2:
                "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAATlBMVEXz9fQzMzP3+fi2t7YiIiIqKirk5uU/Pz+AgYHn6ej2+PdaWlpwcHAlJSUfHx8ZGBnc3t2UlpXu8O+jpKM2NjbMzMxVVVVOTk4vLi4TExOjM+vzAAABA0lEQVR4nO3bAXKCMBBA0UBrW1BEQRTvf9H2EtudWd67wZ8MhAnZ1gAAAAAAAAAAAAAAAAAAAAAASDD2scbsvrZ9xNpaauM4nD+jnYfMxPEyddGmS2bhcA0P7LrrkFk4/0PhnFnYnqfwwNMzM7Df9ukUa9q3PjXxdv+Jdb+lBsZv+PlbPgAAAFDFGCs7r/XLV6wl+yBqfX3Heq2py9iv8x58ILzPa+YqLo/owL/Ex5JYOLzDA7vunfnfov4a1n8O679LD7AftvrfNAAAAEAN5e+Xlr8jfIB73uXv6teft6g/M1N/7qn+7Fr9+cNWf4YUAAAAAAAAAAAAAAAAAAAAAOCgfgHY3y+u9Hc0OQAAAABJRU5ErkJggg==",
            circleUrl:
                "https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png",
            breadcrumbItem: []
        };

    },
    updated() {
        this.numberAppointmentReserve = localStorage.getItem("numberAppointmentReserve") ?? 0;
    },
    methods: {
        logOut() {
            utils.removeToken();
            //  this.$cookies.remove("infoUserClient");

            this.$router.push({ name: "login" });
        },
        closeModal() {
            // christdev19@gmail.com:
            this.dialogFormVisible = false;
            this.form = {
                lastPassword: '',
                password: ''
            }
        },
        updatePassword() {
            this.isLoading = true;
            this.dialogFormVisible = false;
            const data = {
                oldPassword: this.form.lastPassword,
                newPassword: this.form.password
            };
            axios.put(`/api/update-password`, data).then(responseAxios => {
                console.log("responseAxios", responseAxios)
                if (responseAxios.data.status == 200) {
                    this.$swal({
                        position: "center",
                        icon: "success",
                        title: responseAxios.data?.message ?? "Mot de passe mis à jour",
                        showConfirmButton: true,
                        confirmButtonText: 'Ok',

                    }).then((result) => {
                        this.$router.push({ name: "all-documents" })
                    })

                } else {
                    this.$swal({
                        position: "center",
                        icon: "warning",
                        title: responseAxios.data?.message ?? "",
                        showConfirmButton: false,

                    });
                }
            }).catch((err) => {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Echec de la mise jours",
                    showConfirmButton: false,

                });
                console.log("err", err);
            }).finally(() => {
                this.isLoading = false;
            });

        },
        redirectTo(breadcrumb) {
            if (breadcrumb && breadcrumb.pathName) {
                this.$router.push({ name: breadcrumb.pathName });
            } else {
                this.$router.push(breadcrumb.path);
            }
        },
        generateBreadcrumb() {
            this.breadcrumbItem = [];
            this.$route.matched.map((item) => {
                if (item.meta["breadcrumb"]) {
                    this.breadcrumbItem.push({
                        label: item.meta["breadcrumb"],
                        path: item.path,
                        pathName: item.redirect?.name ?? null
                    });
                }
            });
        }
    },
    watch: {
        $route() {
            this.generateBreadcrumb();
        }
    },
    mounted() {
        this.generateBreadcrumb();
        this.$store.dispatch("FETCH_USER");
    }
};
</script>

<style lang="less" scoped>
.container-logo-aside {
    margin: 0 0 1rem !important;
    width: 100% !important;
    background: #FFF;

    .content-img {
        display: flex;
        align-items: center;
    }
}

.dialog-footer button:first-child {
    margin-right: 10px;
}

.el-badge.item {
    font-size: 1.5rem;
    padding: 0 1.6rem;
}

::v-deep .el-dialog__body {
    border: 1px solid #EEE;
}

.icon {
    width: auto;
    flex: none;
}

.fullname {
    width: auto;
    flex: none;
}

.colors {
    color: white;
}

.sidebar-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 0;
    height: 100vh;
    background-color: white;
    overflow-x: hidden;
    transition: all 0.3s;
    z-index: 20;

    .close {
        border-radius: 20px;
        height: 30px;
        width: 30px;
        border: 1px solid #448a79;
        position: absolute;
        top: 0;
        right: 5rem;
    }
}

.sidebar-header {
    display: flex;
    width: 200px;
}

.sidebar {
    width: auto;
    position: relative;


}

.overlay {
    width: 200px;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 8px 24px;
}

.hamburger {
    display: none;
}

.main-navlinks {
    display: none;
}

@media (max-width: 550px) {
    .container-navlinks {
        visibility: visible;
    }
}

.navlinks-container a {
    margin: 0 10px;
    font-size: 16px;
    font-weight: 500;
    text-decoration: none;
    color: #414141;
    display: inline-block;
    position: relative;
}

.navlinks-container a::after {
    content: "";
    display: block;
    position: absolute;
    bottom: -3px;
    width: 100%;
    height: 1px;
    transform: scaleX(0);
    transform-origin: left;
    background: #333;
    transition: transform 0.3s ease-out;
}

.navlinks-container a:hover::after {
    transform: scaleX(1)
}

.nav-authentication {
    margin-left: auto;
}

.el-header {
    background-color: #fff;
    color: #333;
    line-height: 60px !important;
    box-shadow: rgba(17, 17, 26, 0.1) 0 0 16px;
    height: 60px;
    text-align: right;
    font-size: 12px;
    position: sticky;
    top: 0;
    z-index: 1;
    display: flex;
    justify-content: flex-end;
}

.amberger {
    display: none;
}

.fermer {
    margin-right: 13px;
    display: none;
}

.vert1 {
    visibility: visible;
    margin-top: 40px;
    width: 100vw;
    height: 100vh;
}

.el-aside {
    height: 100vh;
}

@media (max-width: 550px) {
    .container-navlinks {
        display: block;
    }

    .amberger {
        display: block;
        margin-right: 40%;
    }

    .foot-aside {
        visibility: hidden;
    }

    .foot-aside2 {
        visibility: visible;
    }

    .menu {
        visibility: hidden;
    }

    .menu1 {
        visibility: visible;
    }

    .dash {
        display: block;
    }

    .dash2 {
        visibility: visible;
    }

    .taille {
        font-size: 30px;
    }

    .el-container {
        display: block;
    }

    .close {
        margin-left: 72%;
        margin-top: 20px;
        height: 30px;
        width: 30px;
        background-color: white;
    }

    .vert {
        visibility: hidden;
        height: 0vh;
    }

    .amberger {
        display: block;
        margin-right: 170px;
    }

    .fermer {
        display: block;
    }
}


.el-aside {
    background: var(--primaryColor);

    overflow: hidden;
    box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;
    z-index: 3;
    display: flex;
    flex-direction: column;

    .el-menu-item.is-active {
        background: var(--secondaryColor) !important;
        color: var(--primaryColor);
    }

    .el-menu-item {
        &:hover {
            background: var(--secondaryColor) !important;
            color: var(--vt-c-white-soft);
        }
    }
}

.el-main {
    background-color: #94a9bf21;
    //background-color: #f5f5f5;
    padding: 0 !important;
}

.el-menu {
    border-right: none;
    flex: 1;
    overflow: auto;
}

.user-ref {
    font-size: 17px;
}

.container-logo {
    width: 44%;
    margin: 1rem 1rem 0 20px;
    flex: 0.1;
}

.container-el-breadcrumb {
    padding: 0.5rem;
    border-bottom: 1px dashed #bfaca43b;
    flex: initial;
}

.foot-aside {
    flex: inherit;
    padding: 0.6rem 20px;
    background: var(--secondaryColor);
    //border-top: 1px solid #e3e3dc;
    box-shadow: rgba(14, 30, 37, 0.12) 0 2px 4px 0,
        rgba(14, 30, 37, 0.32) 0 2px 16px 0;

    .el-button {
        font-size: 1.1rem;
        text-align: start;
        color: var(--primaryColor);
    }
}

.foot-aside2 {
    flex: inherit;
    padding: 0.6rem 20px;
    background: var(--secondaryColor);
    //border-top: 1px solid #e3e3dc;
    box-shadow: rgba(14, 30, 37, 0.12) 0 2px 4px 0,
        rgba(14, 30, 37, 0.32) 0 2px 16px 0;

    .el-button {
        font-size: 1.1rem;
        text-align: start;
        color: var(--primaryColor);
    }
}
</style>
