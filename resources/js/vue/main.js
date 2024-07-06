import utils from "./core/utils";

require('../bootstrap');

// ..
import * as ElementPlusIconsVue from "@element-plus/icons-vue";
import * as leaflet from "@vue-leaflet/vue-leaflet"; //  {LCircleMarker, LMap, LMarker, LTileLayer}
import AOS from "aos";

import "aos/dist/aos.css"; // You can also use <link> for styles
import "bootstrap-icons/font/bootstrap-icons.css";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.js";
import ElementPlus from "element-plus";
import "element-plus/dist/index.css";
import fr from "element-plus/dist/locale/fr.mjs";
import "leaflet/dist/leaflet.css";
import 'sweetalert2/dist/sweetalert2.min.css';
import {createApp} from "vue";
import VueSweetalert2 from 'vue-sweetalert2';
import "../vue/assets/theme/styles.less";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";

AOS.init();

// baseUrlApi
// axios.defaults.baseURL = "http://onign-api.poc-demo.com";


axios.interceptors.request.use(
    config => {
        config.headers.setAuthorization(`Bearer ${utils.getJwt()}`);
        return config;
    },
    error => {
        console.log("error [interceptors.request]", error);
        return error;
    }
);

axios.interceptors.response.use(
    config => {
        return config;
    },
    error => {
        console.log("error [interceptors.response]", error);
        if (error.response?.status == 401 || error.response?.data?.status_code == 401) {
            alert("Authorisation non accordéé")
            window.location.href = `${window.location.origin}${window.location.pathname}#/auth`
            // this.$router.push({name: 'login'})
        }
        return error;
    }
);

const app = createApp(App);
for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    app.component(key, component);
}
for (const [key, component] of Object.entries(leaflet)) {
    app.component(key, component);
}

// app.component('l-map', LMap);
// app.component('l-tile-layer', LTileLayer);
// app.component('l-marker', LMarker);
// app.component('l-circle-marker', LCircleMarker);

app.use(ElementPlus, {locale: fr})
    .use(VueSweetalert2, {})
    .use(store)
    .use(router);
app.mount("#app");
