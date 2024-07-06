import axios from "axios";
import utils from "../utils";

exports.interceptorsRequest = axios.interceptors.request.use(
    config => {
        config.headers.setAuthorization(`Bearer ${utils.getJwt()}`);
        return config;
    },
    error => {
        console.log("error [interceptors.request]", error);
        return error;
    }
);

exports.interceptorsResponse = axios.interceptors.response.use(
    config => {
        console.log(config)
        if (config.status == 401) {
            alert("Authorisation non accordéé")
            this.$router.push({name: 'login'})
        }
        return config;
    },
    error => {
        console.log("error [interceptors.response]", error);
        /*if (config.response?.status == 401) {
            alert("Authorisation non accordéé")
            this.$router.push({name: 'login'})
        }*/
        return error;
    }
);

