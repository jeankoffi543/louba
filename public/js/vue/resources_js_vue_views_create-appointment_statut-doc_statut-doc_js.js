"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_vue_views_create-appointment_statut-doc_statut-doc_js"],{

/***/ "./resources/js/vue/views/create-appointment/statut-doc/statut-doc.js":
/*!****************************************************************************!*\
  !*** ./resources/js/vue/views/create-appointment/statut-doc/_statut-doc.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_shared_ButtonApp_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/shared/ButtonApp.vue */ "./resources/js/vue/components/shared/ButtonApp.vue");
/* harmony import */ var _core_constants__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../core/constants */ "./resources/js/vue/core/constants.js");
// @vue/component



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'StatutDocument',
  components: {
    ButtonApp: _components_shared_ButtonApp_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  mixins: [],
  props: {},
  data: function data() {
    return {
      activeNames: ["1", "3", "4", "5"],
      disabledStep1: false,
      disabledStep2: true,
      disabledStep3: true,
      disabledStep4: true,
      typeDemand: "duplicata",
      formPersonalInfo: {
        firstname: "",
        lastname: "",
        email: "",
        gender: "H",
        phone: "",
        dateOfBirth: "",
        placeOfResidence: "",
        fileListPicture: [],
        fileListBirthCertificate: []
      },
      pickerOptions: {
        disabledDate: function disabledDate(time) {
          return time.getTime() > Date.now();
        }
      }
    };
  }
});

/***/ })

}]);
