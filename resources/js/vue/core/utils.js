exports.hasToken = () => {
    return localStorage.getItem("jwtLouba") != null;
}

exports.setJwt = (token) => {
    localStorage.setItem("jwtLouba", token);
};

exports.getJwt = () => localStorage.getItem("jwtLouba");


exports.removeToken = () => {
    localStorage.removeItem("jwtLouba");
};
