import {createStore} from "vuex";
import actuality from "../store/modules/actuality.store";
import appointment from "../store/modules/appointment.store";
import locationEnrolment from "../store/modules/locationEnrolment.store";
import other from "../store/modules/other.store";
import partners from "../store/modules/partners.store";
import products from "../store/modules/products.store";
import request from "../store/modules/request.store";
import searchDocument from "../store/modules/searchDocument.store";
import security from "../store/modules/security.store";
import services from "../store/modules/services.store";
import sliders from "../store/modules/sliders.store";
import teams from "../store/modules/teams.store";
import user from "../store/modules/user.store";
import socials from "../store/modules/socials.store";

export default createStore({
    modules: {
        APPOINTMENT: appointment,
        ACTUALITIES: actuality,
        PARTNERS: partners,
        PRODUCTS: products,
        SERVICES: services,
        LOCATIONS_ENROLMENTS: locationEnrolment,
        SECURITY: security,
        SLIDERS: sliders,
        TEAMS: teams,
        REQUEST: request,
        OTHER: other,
        SEARCH_DOCUMENT: searchDocument,
        USER: user,
        SOCIALS: socials,
    }
});

