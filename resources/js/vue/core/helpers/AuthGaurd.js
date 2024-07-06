const {hasToken} = require("../../core/utils");

exports.AuthGaurd = (to, from) => {
    if (hasToken) {
        return true;
    }
    return {name: "login"};
}
