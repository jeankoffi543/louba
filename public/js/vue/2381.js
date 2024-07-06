"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2381],{3994:(e,t,n)=>{n.d(t,{Z:()=>l});var r=n(3645),o=n.n(r)()((function(e){return e[1]}));o.push([e.id,".image[data-v-f595828a]{width:60%}",""]);const l=o},2381:(e,t,n)=>{n.r(t),n.d(t,{default:()=>S});var r=n(8222),o=function(e){return(0,r.dD)("data-v-f595828a"),e=e(),(0,r.Cn)(),e},l={class:"complaint-page"},a={class:"container"},u={class:"row py-5"},s=o((function(){return(0,r._)("div",{class:"d-no col-lg-7 text-center text-lg-start"},[(0,r._)("img",{class:"image",src:"/assets/vue/imgs/others/complaint.png",width:"350"}),(0,r._)("h1",{class:"fw-bold lh-1 mb-3"}," Tous vos reclamations sont bien prise en compte afin d'ameliorer la qualité de nos services ")],-1)})),i={class:"col-md-10 mx-auto col-lg-5"},m=o((function(){return(0,r._)("p",{class:"fs-3 fw-bold oni-color-secondary"},"Formulaire de reclamation",-1)})),c=o((function(){return(0,r._)("hr",{class:"my-4"},null,-1)})),f=o((function(){return(0,r._)("p",{class:"text-center text-muted"}," By Office National d'Identification © 2022 ",-1)}));var d=n(3907);function p(e){return p="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},p(e)}function b(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function g(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?b(Object(n),!0).forEach((function(t){y(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):b(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function y(e,t,n){return(t=function(e){var t=function(e,t){if("object"!==p(e)||null===e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var r=n.call(e,t||"default");if("object"!==p(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(e,"string");return"symbol"===p(t)?t:String(t)}(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const w={name:"ComplaintPage",components:{},mixins:[],props:{},data:function(){return{isLoading:!1,form:{fullname:"",phone:"",subject:"",email:"",type_request:"0",message:""},typeRequest:[{label:"Réclamations",value:"0"},{label:"Demande",value:"1"}]}},computed:g(g({},(0,d.nv)(["SEND_REQUEST"])),(0,d.Se)({isLoading:"IS_LOADING_REQUEST",responseMessage:"GET_RESPONSE"})),watch:{},created:function(){},methods:{resetForm:function(){this.form={fullname:"",phone:"",subject:"",email:"",type_request:"0",message:""}},onSendMessage:function(){var e={nom_prenom:this.form.fullname,email:this.form.email,telephone:this.form.phone,sujet:this.form.subject,message:this.form.message,type_request:this.form.type_request};this.$store.dispatch("SEND_REQUEST",e)}}};var h=n(3379),v=n.n(h),_=n(3994),j={insert:"head",singleton:!1};v()(_.Z,j);_.Z.locals;const S=(0,n(3744).Z)(w,[["render",function(e,t,n,o,d,p){var b=(0,r.up)("el-alert"),g=(0,r.up)("el-input"),y=(0,r.up)("el-form-item"),w=(0,r.up)("el-col"),h=(0,r.up)("el-option"),v=(0,r.up)("el-select"),_=(0,r.up)("el-row"),j=(0,r.up)("el-form"),S=(0,r.Q2)("loading");return(0,r.wg)(),(0,r.iD)("div",l,[e.responseMessage?((0,r.wg)(),(0,r.j4)(b,{key:0,onClose:e.resetForm,title:e.responseMessage,center:"",closable:"",effect:"light","show-icon":"",type:"info"},null,8,["onClose","title"])):(0,r.kq)("",!0),(0,r._)("div",a,[(0,r._)("div",u,[s,(0,r._)("div",i,[m,(0,r.Wm)(j,{model:e.form,class:"p-4 p-md-5 border rounded-3 bg-light","label-position":"top","label-width":"100px"},{default:(0,r.w5)((function(){return[(0,r.Wm)(_,{gutter:24,class:"app-ml-0 app-mr-0"},{default:(0,r.w5)((function(){return[(0,r.Wm)(w,{sm:24,xs:24,class:""},{default:(0,r.w5)((function(){return[(0,r.Wm)(y,{label:"Votre nom complet"},{default:(0,r.w5)((function(){return[(0,r.Wm)(g,{modelValue:e.form.fullname,"onUpdate:modelValue":t[0]||(t[0]=function(t){return e.form.fullname=t}),size:"default"},null,8,["modelValue"])]})),_:1})]})),_:1}),(0,r.Wm)(w,{sm:24,xs:24,class:""},{default:(0,r.w5)((function(){return[(0,r.Wm)(y,{label:"Votre numero de telephone"},{default:(0,r.w5)((function(){return[(0,r.Wm)(g,{modelValue:e.form.phone,"onUpdate:modelValue":t[1]||(t[1]=function(t){return e.form.phone=t}),size:"default"},null,8,["modelValue"])]})),_:1})]})),_:1}),(0,r.Wm)(w,{sm:24,xs:24,class:""},{default:(0,r.w5)((function(){return[(0,r.Wm)(y,{label:"Votre adresse email"},{default:(0,r.w5)((function(){return[(0,r.Wm)(g,{modelValue:e.form.email,"onUpdate:modelValue":t[2]||(t[2]=function(t){return e.form.email=t}),size:"default"},null,8,["modelValue"])]})),_:1})]})),_:1}),(0,r.Wm)(w,{sm:24,xs:24,class:""},{default:(0,r.w5)((function(){return[(0,r.Wm)(y,{label:"Votre sujet"},{default:(0,r.w5)((function(){return[(0,r.Wm)(g,{modelValue:e.form.subject,"onUpdate:modelValue":t[3]||(t[3]=function(t){return e.form.subject=t}),size:"default"},null,8,["modelValue"])]})),_:1})]})),_:1}),(0,r.Wm)(w,{sm:24,xs:24,class:""},{default:(0,r.w5)((function(){return[(0,r.Wm)(y,{label:"Selectionner vôtre type de reclamation"},{default:(0,r.w5)((function(){return[(0,r.Wm)(v,{modelValue:e.form.type_request,"onUpdate:modelValue":t[4]||(t[4]=function(t){return e.form.type_request=t}),class:"w-100"},{default:(0,r.w5)((function(){return[((0,r.wg)(!0),(0,r.iD)(r.HY,null,(0,r.Ko)(e.typeRequest,(function(e){return(0,r.wg)(),(0,r.j4)(h,{key:e.value,label:e.label,value:e.value},null,8,["label","value"])})),128))]})),_:1},8,["modelValue"])]})),_:1})]})),_:1}),(0,r.Wm)(w,{sm:24,xs:24,class:""},{default:(0,r.w5)((function(){return[(0,r.Wm)(y,{label:"Votre message"},{default:(0,r.w5)((function(){return[(0,r.Wm)(g,{modelValue:e.form.message,"onUpdate:modelValue":t[5]||(t[5]=function(t){return e.form.message=t}),size:"large",type:"textarea"},null,8,["modelValue"])]})),_:1})]})),_:1})]})),_:1}),(0,r.wy)(((0,r.wg)(),(0,r.iD)("button",{class:"w-100 btn btn-lg btn-primary bg-oni-primary",onClick:t[6]||(t[6]=function(){return e.onSendMessage&&e.onSendMessage.apply(e,arguments)})},[(0,r.Uk)(" Envoyer ")])),[[S,e.isLoading]]),c,f]})),_:1},8,["model"])])])])])}],["__scopeId","data-v-f595828a"]])}}]);
