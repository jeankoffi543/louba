"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[557],{3848:(t,e,n)=>{n.d(e,{A:()=>i});var a=n(6314),o=n.n(a)()((function(t){return t[1]}));o.push([t.id,".container-item[data-v-fd2cac94]{cursor:pointer;width:100%}.container-item .point-enrolment[data-v-fd2cac94]{align-items:center;display:flex;margin:.5rem 0}.container-item .el-card .el-card__body[data-v-fd2cac94]{padding:0!important}.container-item .box-card[data-v-fd2cac94]{background:#2e3138;border-radius:13px;color:#fff}.container-item .box-card .box-card-body[data-v-fd2cac94]{padding:.7rem}.container-item .box-card .date-document[data-v-fd2cac94]{font-size:14px;font-weight:900}.container-item .box-card .name-document h3[data-v-fd2cac94]{font-size:1.7rem;font-weight:700;margin:6px 0}.container-item .box-card .user-name[data-v-fd2cac94],.container-item .box-card .user-phone[data-v-fd2cac94]{font-size:18px}.container-item .box-card .user-phone[data-v-fd2cac94]{text-align:end}.container-item .box-card .button-primary[data-v-fd2cac94]{background:#4e7e74;border:none!important;border-radius:8px;font-size:11px}.container-item .box-card .status-appointment[data-v-fd2cac94]{display:flex;justify-content:flex-end}.container-item .box-card .status-appointment .el-button[data-v-fd2cac94]{color:#fff}.container-item .reject-appointment[data-v-fd2cac94]{border-left:.2px solid #e3e3e3}.container-item .print-appointment .el-button[data-v-fd2cac94],.container-item .reject-appointment .el-button[data-v-fd2cac94]{background:beige;color:#2e3138;font-size:15px;font-weight:bolder}.container-item .print-appointment[data-v-fd2cac94],.container-item .reject-appointment[data-v-fd2cac94]{padding:0!important}.container-item .print-appointment .el-button[data-v-fd2cac94],.container-item .reject-appointment .el-button[data-v-fd2cac94]{border:none;border-radius:0!important;padding:24px;width:100%}",""]);const i=o},7390:(t,e,n)=>{n.d(e,{A:()=>i});var a=n(6314),o=n.n(a)()((function(t){return t[1]}));o.push([t.id,"@media (max-width:500px){.container-item-doc[data-v-ce1278cc]{justify-content:center}}",""]);const i=o},9287:(t,e,n)=>{n.d(e,{A:()=>b});var a=n(1431),o={class:"container-item"},i={class:"date-document d-flex justify-content-between align-center",style:{"font-size":"13px"}},r={style:{"font-style":"italic"}},d={class:"name-document"},c={class:""},u={class:"user-name point-enrolment flew flex-row"},s=function(t){return(0,a.Qi)("data-v-fd2cac94"),t=t(),(0,a.jt)(),t}((function(){return(0,a.Lk)("small",null,"Point d'enrôlement : ",-1)}));const l={name:"ItemDocument",props:{indexBuild:{type:Number,default:0},dataItem:{type:Object,default:null}},methods:{status:function(t){return 1==(null==t?void 0:t.predemande_step)?"En attente":"PENDDING"==(null==t?void 0:t.status_demande)?"En cours":"OPEN"==(null==t?void 0:t.status_demande)?"Ouvert":"SUSPENDED"==(null==t?void 0:t.status_demande)?"Suspendue":"RESETTED"==(null==t?void 0:t.status_demande)?"Réinitialisée":"REJECTED"==(null==t?void 0:t.status_demande)?"Echec":"NEW"==(null==t?void 0:t.status_demande)?"Nouveau":"CLOSED"==(null==t?void 0:t.status_demande)?"Rendez-vous fait, maintenant en attente du retrait":"PENDING_PAY"==(null==t?void 0:t.status_demande)?"en attente de paiement":"En attente"},getRecu:function(){var t;window.open("/recuPdf/".concat(null===(t=this.dataItem)||void 0===t?void 0:t.code_demande))},buyMaDemande:function(){var t;this.$router.push({name:"details-appointment",params:{documentId:null===(t=this.dataItem)||void 0===t?void 0:t.id}})},voirStatutDeMaDemande:function(){var t;window.open("/voirStatutDeMaDemande/".concat(null===(t=this.dataItem)||void 0===t?void 0:t.code_demande))},redirectTo:function(){this.isReportingAppointment?this.$router.push({name:"report-appointment",params:{documentId:this.indexBuild+this.dataItem.refDoc}}):this.$router.push({name:"pay-appointment",params:{documentId:this.indexBuild+this.dataItem.refDoc}})},detailsAppointment:function(){var t;this.$router.push({name:"details-appointment",params:{documentId:null===(t=this.dataItem)||void 0===t?void 0:t.id}})},takeRdv:function(){var t;this.$router.push({name:"appointment-start",params:{documentId:null===(t=this.dataItem)||void 0===t?void 0:t.id}})}},computed:{action:function(){return this.isReportingAppointment?{name:"Reporter",type:"danger"}:{name:"Payer",type:"warning"}},isReportingAppointment:function(){return this.indexBuild%2==0},dateRdv:function(){var t,e;return null!==(t=this.dataItem)&&void 0!==t&&t.date_rdv_demande?new Date(null===(e=this.dataItem)||void 0===e?void 0:e.date_rdv_demande).toLocaleDateString(void 0,{weekday:"long",day:"numeric",month:"long",year:"numeric"}):null}}};var p=n(5072),m=n.n(p),f=n(3848),v={insert:"head",singleton:!1};m()(f.A,v);f.A.locals;const b=(0,n(6262).A)(l,[["render",function(t,e,n,l,p,m){var f=(0,a.g2)("el-col"),v=(0,a.g2)("el-row"),b=(0,a.g2)("el-button"),y=(0,a.g2)("el-card");return(0,a.uX)(),(0,a.CE)("div",o,[(0,a.bF)(y,{class:"box-card"},{default:(0,a.k6)((function(){var t,o,l,p;return[(0,a.Lk)("div",{class:"box-card-body",onClick:e[0]||(e[0]=function(t){return m.detailsAppointment()})},[(0,a.Lk)("div",i,[(0,a.Lk)("span",null,"Date du rendez-vous : "+(0,a.v_)(null!==(t=m.dateRdv)&&void 0!==t?t:""),1),(0,a.Lk)("span",r,(0,a.v_)(null===(o=n.dataItem)||void 0===o||null===(o=o.product)||void 0===o?void 0:o.nom),1)]),(0,a.Lk)("div",d,[(0,a.Lk)("h3",c,(0,a.v_)(null===(l=n.dataItem)||void 0===l||null===(l=l.client)||void 0===l?void 0:l.prenom_client)+" "+(0,a.v_)(null===(p=n.dataItem)||void 0===p||null===(p=p.client)||void 0===p?void 0:p.nom_client),1)]),(0,a.bF)(v,{gutter:24,class:"app-m-0 app-justify-content-space-between"},{default:(0,a.k6)((function(){return[(0,a.bF)(f,{sm:24,xs:24},{default:(0,a.k6)((function(){var t;return[(0,a.Lk)("span",u,[s,(0,a.eW)(" "+(0,a.v_)(null===(t=n.dataItem)||void 0===t||null===(t=t.point_enrolement)||void 0===t?void 0:t.nom_pe),1)])]})),_:1})]})),_:1}),(0,a.bF)(v,{gutter:24,class:"app-m-0 app-justify-content-space-between",style:{"margin-bottom":"8px"}},{default:(0,a.k6)((function(){return[(0,a.bF)(f,{sm:12,xs:24,class:"date-appointment"},{default:(0,a.k6)((function(){return[(0,a.bF)(b,{class:"button-primary",type:"success"},{default:(0,a.k6)((function(){var t;return[(0,a.eW)("N° dossier : "+(0,a.v_)(null===(t=n.dataItem)||void 0===t?void 0:t.code_demande),1)]})),_:1})]})),_:1}),(0,a.bF)(f,{sm:12,xs:24,class:"status-appointment"},{default:(0,a.k6)((function(){return[(0,a.bF)(b,{class:"button-primary app-d-flex app-justify-content-flex-end",type:"success"},{default:(0,a.k6)((function(){return[(0,a.eW)((0,a.v_)(m.status(n.dataItem)),1)]})),_:1})]})),_:1})]})),_:1})]),(0,a.bF)(v,{gutter:24,class:"app-ml-0 app-mr-0 app-justify-content-space-between"},{default:(0,a.k6)((function(){var t,e;return[(0,a.bF)(f,{sm:12,xs:24,class:"print-appointment"},{default:(0,a.k6)((function(){return[(0,a.bF)(b,{class:"",onClick:(0,a.D$)(m.detailsAppointment,["stop"])},{default:(0,a.k6)((function(){return[(0,a.eW)(" Détails ")]})),_:1},8,["onClick"])]})),_:1}),1==(null===(t=n.dataItem)||void 0===t?void 0:t.predemande_step)?((0,a.uX)(),(0,a.Wv)(f,{key:0,sm:12,xs:24,class:"reject-appointment"},{default:(0,a.k6)((function(){return[(0,a.bF)(b,{class:"text-danger"},{default:(0,a.k6)((function(){return[(0,a.eW)(" Veuillez patienter... ")]})),_:1})]})),_:1})):2==(null===(e=n.dataItem)||void 0===e?void 0:e.predemande_step)?((0,a.uX)(),(0,a.Wv)(f,{key:1,sm:12,xs:24,class:"reject-appointment"},{default:(0,a.k6)((function(){return[(0,a.bF)(b,{class:"",onClick:m.takeRdv},{default:(0,a.k6)((function(){return[(0,a.eW)(" Prendre rendez-vous")]})),_:1},8,["onClick"])]})),_:1})):((0,a.uX)(),(0,a.Wv)(f,{key:2,sm:12,xs:24,class:"reject-appointment"},{default:(0,a.k6)((function(){return[(0,a.bF)(b,{class:"",onClick:(0,a.D$)(m.getRecu,["stop"])},{default:(0,a.k6)((function(){return[(0,a.eW)(" Télécharger le reçu")]})),_:1},8,["onClick"])]})),_:1}))]})),_:1})]})),_:1})])}],["__scopeId","data-v-fd2cac94"]])},5557:(t,e,n)=>{n.r(e),n.d(e,{default:()=>y});var a=n(1431),o={class:"list-document app-container-page"};var i=n(6278),r=n(7064),d=n(9287);function c(t){return c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},c(t)}function u(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function s(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?u(Object(n),!0).forEach((function(e){l(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):u(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function l(t,e,n){return(e=function(t){var e=function(t,e){if("object"!=c(t)||!t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var a=n.call(t,e||"default");if("object"!=c(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"==c(e)?e:e+""}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const p={name:"ListDocument",components:{EmptyState:r.A,ItemDocument:d.A},mixins:[],props:{},data:function(){return{}},computed:s(s({},(0,i.i0)(["FETCH_APPOINTMENT"])),(0,i.L8)({isLoading:"IS_LOADING_APPOINTMENT",documentsAppointment:"GET_APPOINTMENT"})),watch:{},created:function(){},mounted:function(){},beforeMount:function(){this.fetchData()},methods:{fetchData:function(){this.$store.dispatch("FETCH_APPOINTMENT")}}};var m=n(5072),f=n.n(m),v=n(7390),b={insert:"head",singleton:!1};f()(v.A,b);v.A.locals;const y=(0,n(6262).A)(p,[["render",function(t,e,n,i,r,d){var c=(0,a.g2)("EmptyState"),u=(0,a.g2)("el-col"),s=(0,a.g2)("ItemDocument"),l=(0,a.g2)("el-row"),p=(0,a.g2)("el-container"),m=(0,a.gN)("loading");return(0,a.uX)(),(0,a.CE)("div",o,[(0,a.bo)(((0,a.uX)(),(0,a.Wv)(p,{class:"container-item-doc"},{default:(0,a.k6)((function(){return[(0,a.bF)(l,{gutter:24,class:"app-w-100"},{default:(0,a.k6)((function(){return[0===t.documentsAppointment.length?((0,a.uX)(),(0,a.Wv)(u,{key:0,sm:24,xs:24},{default:(0,a.k6)((function(){return[(0,a.bF)(c,{onReload:t.fetchData},null,8,["onReload"])]})),_:1})):((0,a.uX)(!0),(0,a.CE)(a.FK,{key:1},(0,a.pI)(t.documentsAppointment,(function(t,e){return(0,a.uX)(),(0,a.Wv)(u,{key:e,sm:8,xs:24,class:"app-mb-1"},{default:(0,a.k6)((function(){return[((0,a.uX)(),(0,a.Wv)(s,{key:e,dataItem:t,"index-build":e},null,8,["dataItem","index-build"]))]})),_:2},1024)})),128))]})),_:1})]})),_:1})),[[m,t.isLoading]])])}],["__scopeId","data-v-ce1278cc"]])}}]);