import {createRouter, createWebHashHistory} from "vue-router";
import AuthGaurd from "../core/helpers/AuthGaurd";
import * as utils from "../core/utils";
import AppointmentLayout from "../layouts/AppointmentLayout.vue";
import DashboardLayout from "../layouts/DashboardLayout";
import HomeCustomerLayout from "../layouts/HomeCustomerLayout";
import SecurityLayout from "../layouts/SecurityLayout.vue";
import IndexMyAppointment from "../views/my-appointments/index-my-appointment";
import FotgetPassword from "../views/security/fotgetPassword/fotgetPassword.vue";
import RegisterPage from "../views/security/register-page/register-page.vue";
import SignIn from "../views/security/signIn/signIn.vue";

const routes = [
    {
        path: "/",
        name: "index",
        redirect: {name: "customer-home"},
        component: HomeCustomerLayout,
        children: [
            {
                path: "home",
                name: "customer-home",
                component: () => import("../views/customer-portal/home-customer.vue")
            },
            {
                path: "empty-page",
                name: "empty-page",
                component: () => import("../components/shared/EmptyPage.vue")
            },
            {
                path: "page/:title?",
                name: "work-page",
                component: () => import("../views/fake-page.vue")
            },

            {
                path: "contact",
                name: "contact",
                component: () =>
                    import("../views/customer-portal/contact-view/contact-view.vue")
            },
            {
                path: "useful",
                name: "utiles",
                component: () =>
                    import("../views/customer-portal/liens-utiles/liens-utiles.vue")
            },

            {
                path: "actuality",
                children: [
                    {
                        path: "list",
                        name: "actualities",
                        component: () =>
                            import("../views/customer-portal/actualities/ListActualities.vue")
                    },
                    {
                        path: "details/:id",
                        name: "actuality-details",
                        component: () =>
                            import(
                                "../views/customer-portal/actualities/actuality-details/actuality-details.vue"
                                )
                    }
                ]
            },

            {
                path: "about-us", // qui-nous-sommes
                name: "about-us",
                children: [
                    {
                        path: "oni",
                        name: "presentation-oni",
                        component: () =>
                            import(
                                "../views/customer-portal/about-us/presentation-oni-view/presentation-oni-view.vue"
                                )
                    },
                    {
                        path: "dg",
                        name: "sentense-dg",
                        component: () =>
                            import(
                                "../views/customer-portal/about-us/sentense-dg/sentense-dg.vue"
                                )
                    },
                    {
                        path: "team",
                        name: "team-page",
                        component: () =>
                            import("../views/customer-portal/about-us/teamView/teamView.vue")
                    },
                    {
                        path: "oni-figure",
                        name: "oni-figure",
                        component: () =>
                            import("../views/customer-portal/about-us/oni-figure/oni-figure.vue")
                    },
                    {
                        path: "ambassadors",
                        name: "list-ambassade",
                        component: () =>
                            import(
                                "../views/customer-portal/about-us/ambassade-view/ambassade-view.vue"
                                )
                    },
                    {
                        path: "enrolment-centres",
                        name: "list-of-enrolment-centres",
                        component: () => import("../components/shared/EmptyPage.vue")
                    }
                ]
            },
            {
                path: "our-products",
                name: "our-products",
                children: [
                    {
                        path: "passeport",
                        name: "passport",
                        component: () =>
                            import(
                                "../views/customer-portal/products/ordinary-passport-view/ordinary-passport-view.vue"
                                )
                    },

                    {
                        path: "visa-list-docs",
                        name: "list-docs-visa",
                        component: () =>
                            import(
                                "../views/customer-portal/products/list-doc-visa/list-doc-visa.vue"
                                )
                    },
                    {
                        path: "residency-permit",
                        name: "titre-sejour",
                        component: () =>
                            import(
                                "../views/customer-portal/products/list-doc-sejour/list-doc-sejour.vue"
                                )
                    },
                    {
                        path: "cni-list-docs",
                        name: "cni-list-docs",
                        component: () =>
                            import(
                                "../views/customer-portal/products/cni-list-doc/cni-list-doc.vue"
                                )
                    },

                    /*./USE */

                    // procedure-d-urgence
                    {
                        path: "services",
                        name: "product-services",
                        component: () =>
                            import(
                                "../views/customer-portal/products/service-view/service-view.vue"
                                )
                    },

                    {
                        path: "passeport-diplomatique",
                        name: "passeport-diplomatique",
                        component: () =>
                            import(
                                "../views/customer-portal/products/official-passport-view/official-passport-view.vue"
                                )
                    },

                    {
                        path: "evacuation-sanitaire",
                        name: "sanitary-evacuation",
                        component: () =>
                            import(
                                "../views/customer-portal/products/sanitary-evacuation-view/sanitary-evacuation-view.vue"
                                )
                    },

                    {
                        path: "visa-centres",
                        name: "visa-centers",
                        component: () =>
                            import(
                                "../views/customer-portal/products/list-center-visa/list-center-visa.vue"
                                )
                    },

                    {
                        path: "titre-sejour-centres",
                        name: "titre-sejour-centres",
                        component: () =>
                            import(
                                "../views/customer-portal/products/list-center-sejour/list-center-sejour.vue"
                                )
                    },


                    {
                        path: "cni-vip-service",
                        name: "cni-vip-service",
                        component: () =>
                            import(
                                "../views/customer-portal/products/list-center-cni/list-center-cni.vue"
                                )
                    }
                ]
            },
            {
                path: "nos-services",
                name: "our-services",
                children: [
                    {
                        path: "service-vip",
                        name: "service-vip",
                        component: () =>
                            import(
                                "../views/customer-portal/services/service-vip-view/service-vip-view.vue"
                                )
                    },

                    {
                        path: "urgency-procedure",
                        name: "procedure-urgence",
                        component: () =>
                            import(
                                "../views/customer-portal/services/urgency-procedure/urgency-procedure.vue"
                                )
                    },
                    {
                        path: "status-document",
                        name: "status-document",
                        component: () =>
                            import(
                                "../views/customer-portal/services/status-document/status-document.vue"
                                )
                    },
                    {
                        path: "list-center",
                        name: "search-center",
                        component: () => import("../views/customer-portal/services/search-center/search-center.vue")
                    },

                    /*USE*/

                    {
                        path: "service-list-docs",
                        name: "service-list-docs",
                        component: () => import("../components/shared/EmptyPage.vue")
                    },
                    {
                        path: "prorogation",
                        name: "prorogation",
                        component: () => import("../components/shared/EmptyPage.vue")
                    },
                    {
                        path: "on-site-enrolment",
                        name: "on-site-enrolment",
                        component: () =>
                            import(
                                "../views/customer-portal/services/on-site-enrolment-view/on-site-enrolment-view.vue"
                                )
                    },
                    {
                        path: "evacuation-sanitary",
                        name: "process-evacuation-sanitary",
                        component: () =>
                            import(
                                "../views/customer-portal/services/evacuation-sanitary-view/evacuation-sanitary-view.vue"
                                )
                    },
                    {
                        path: "procedure-student",
                        name: "process-student",
                        component: () =>
                            import(
                                "../views/customer-portal/services/process-student-view/process-student-view.vue"
                                )
                    },
                    {
                        path: "service-reclamation",
                        name: "reclamation",
                        component: () =>
                            import("../views/customer-portal/complaint-page/complaint-page.vue")
                    },
                    {
                        path: "service-pelerinage",
                        name: "pilgrimage",
                        component: () =>
                            import(
                                "../views/customer-portal/services/pilgrimage-view/pilgrimage-view.vue"
                                )
                    }
                ]
            },
            {
                path: "divers",
                name: "divers",
                children: [
                    {
                        path: "documentation",
                        name: "documentation",
                        component: () => import("../components/shared/EmptyPage.vue")
                    },
                    {
                        path: "mediatheque",
                        name: "mediatheque",
                        component: () => import("../components/shared/EmptyPage.vue")
                    },
                    {
                        path: "gallery",
                        name: "gallery",
                        component: () => import("../components/shared/EmptyPage.vue")
                    },
                    {
                        path: "video",
                        name: "video",
                        component: () => import("../components/shared/EmptyPage.vue")
                    }
                ]
            },
            {
                path: "liste-centres-retrait",
                component: () => import("../components/shared/EmptyPage.vue")
            },
            {
                path: "process-evac-sanitaire",
                name: "process-evac-sanitaire",
                component: () => import("../components/shared/EmptyPage.vue")
            },
            {
                path: "list-docs",
                name: "list-docs",
                component: () => import("../components/shared/EmptyPage.vue")
            }
        ]
    },
    /*{
        path: "/appointment",
        redirect: {name: "home-page"},
        component: AppointmentLayout,
        children: [
            {
                path: "",
                name: "home-page",
                component: () => import("../views/home-view/home-view.vue")
            },
            {
                path: "login-page",
                name: "login-page",
                component: () => import("../views/home-view/home-view.vue")
            }
        ]
    },*/
    {
        path: "/personal-space",
        component: DashboardLayout,
        meta: {breadcrumb: "Accueil"},
        redirect: {name: "my-appointment"},
        children: [
            {
                path: "my-appointments",
                name: "my-appointment",
                meta: {breadcrumb: "Mes rendez-vous"},
                redirect: {name: "all-documents"},
                component: IndexMyAppointment,
                children: [
                    {
                        path: "documents",
                        name: "all-documents",
                        meta: {
                            breadcrumb: "Documents"
                        },
                        component: () =>
                            import("../views/my-appointments/list-document/list-document.vue")
                    },

                    {
                        path: "download",
                        name: "downloadable",
                        meta: {
                            breadcrumb: "Téléchargement"
                        },
                        component: () =>
                            import(
                                "../views/my-appointments/downloadable-documents/downloadable-documents.vue"
                                )
                    },
                    {
                        path: "report/:documentId",
                        name: "report-appointment",
                        meta: {
                            breadcrumb: "Reporter un rendez-vous"
                        },
                        component: () =>
                            import(
                                "../views/my-appointments/report-appointement/report-appointement.vue"
                                )
                    },
                    {
                        path: "pay/:documentId?",
                        name: "pay-appointment",
                        meta: {
                            breadcrumb: "Paiement"
                        },
                        component: () =>
                            import(
                                "../views/my-appointments/pay-appointment/pay-appointment.vue"
                                )
                    },
                    {
                        path: "details/:documentId",
                        name: "details-appointment",
                        meta: {
                            breadcrumb: "Details du rendez-vous"
                        },
                        component: () =>
                            import(
                                "../views/my-appointments/details-appointment/details-appointment.vue"
                                )
                    }
                ]
            },
            {
                path: "appointment",
                name: "index-page-appointment",
                before: AuthGaurd,
                meta: {breadcrumb: "Prendre un rendez-vous"},
                component: () => import("../views/create-appointment/new-appointment/new-appointment.vue"),
                children: [
                    {
                        path: "start",
                        name: "appointment-start",
                        component: () =>
                            import(
                                "../views/create-appointment/start-request/start-request.vue"
                                )
                    },
                    {
                        path: "satut-doc",
                        name: "satutdocument",
                        meta: {
                            breadcrumb: "Statut-document"
                        },
                        component: () =>
                            import("../views/create-appointment/statut-doc/statut-doc.vue")
                    },
                    {
                        path: "end",
                        name: "appointment-end",
                        component: () =>
                            import(
                                "../views/create-appointment/end-request/end-request.vue"
                                )
                    },
                    {
                        path: "object",
                        name: "appointment-step-one",
                        component: () =>
                            import(
                                "../views/create-appointment/object-appointment/object-appointment.vue"
                                )
                    },
                    {
                        path: "type-rdv",
                        name: "appointment-step-first",
                        component: () =>
                            import(
                                "../views/create-appointment/type-rdv-appointment/type-rdv-appointment.vue"
                                )
                    },
                    {
                        path: "element-request",
                        name: "appointment-step-two",
                        component: () =>
                            import(
                                "../views/create-appointment/element-request/element-request.vue"
                                )

                    },
                    {
                        path: "form-request",
                        name: "appointment-step-three",
                        component: () =>
                            import("../views/create-appointment/form-demande/form-demande.vue"),
                        meta: {
                            titleSection: "Demande de passeport"
                        }
                    },
                    {
                        path: "other-info-request",
                        redirect: {
                            name: "appointment-step-three"
                        }
                        // name: "appointment-step-foor",
                        // component: () =>
                        //     import(
                        //         "../views/create-appointment/additional-info-request/additional-info-request"
                        //         ),
                        // meta: {
                        //     titleSection: "Demande de passeport",
                        // },
                    },
                    {
                        path: "site-rdv",
                        name: "appointment-step-site",

                        component: () =>
                            import(
                                "../views/create-appointment/site-rdv-appointment/site-rdv-appointment.vue"
                                ),
                        meta: {
                            titleSection: ""
                        }
                    },
                    {
                        path: "choice-date",
                        name: "appointment-step-five",
                        component: () =>
                            import(
                                "../views/create-appointment/choice-date-appointment/choice-date-appointment.vue"
                                ),
                        meta: {
                            titleSection: "Demande de passeport"
                        }
                    }
                ]
            }
        ]
    },

    {
        path: "/auth",
        component: SecurityLayout,
        redirect: {name: "login"},
        children: [
            {
                path: "login",
                name: "login",
                component: SignIn
            },
            {
                path: "register",
                name: "register",
                component: RegisterPage
            },
            {
                path: "fotget-password",
                name: "resetPassword",
                component: FotgetPassword
            }
        ]
    },

    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        component: () => import("../views/customer-portal/home-customer.vue")
    }
];

const router = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes,
    linkActiveClass: "router-link-active",
    linkExactActiveClass: "router-link-exact-active",
    // eslint-disable-next-line no-unused-vars
    scrollBehavior(to, from, savedPosition) {
        return {top: 0};
    }
});

router.beforeEach((to, from) => {
    if (to.name == "appointment-start") {
        if (utils.hasToken()) {
            return true;
        }
        return {name: "login"};
    }
    return true;
});

export default router;
