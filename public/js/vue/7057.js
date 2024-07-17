"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[7057],{117:(t,n,e)=>{e.d(n,{Z:()=>a});var i=e(3645),r=e.n(i)()((function(t){return t[1]}));r.push([t.id,".cursor-pointer{cursor:pointer}",""]);const a=r},1512:(t,n,e)=>{e.d(n,{Z:()=>a});var i=e(3645),r=e.n(i)()((function(t){return t[1]}));r.push([t.id,'.bg-small-banner{background-image:url(/assets/imgs/others/passeport.png);background-size:cover;height:150px}.overlay{background-color:#000;background-size:cover;bottom:0;contain:"";left:0;opacity:50%;position:absolute;right:0;top:0;width:100%}',""]);const a=r},7838:(t,n,e)=>{e.d(n,{Z:()=>a});var i=e(3645),r=e.n(i)()((function(t){return t[1]}));r.push([t.id,"",""]);const a=r},8352:(t,n,e)=>{e.d(n,{Z:()=>s});var i=e(8222),r={class:"card rounded-0"},a=[(0,i.uE)('<div class="card-header text-center"> Fichier (*.pdf) </div><div class="card-body text-center"> - Title documents à fournir ... </div><div class="card-footer text-center"><button class="btn bg-oni-primary px-4 text-light"><i class="bi bi-file-earmark-arrow-down-fill"></i> Telecharger </button></div>',3)];const o={name:"DownloadDf"};const s=(0,e(3744).Z)(o,[["render",function(t,n,e,o,s,l){return(0,i.wg)(),(0,i.iD)("div",r,a)}]])},2366:(t,n,e)=>{e.d(n,{Z:()=>g});var i=e(8222),r={class:"container"},a={key:0,class:"border rounded-3"},o={class:"container"},s={class:"text-bold fs-4 mt-4 pb-4 border-bottom bg-light p-3"},l={class:"mx-5 text-center"},c={class:"row text-center"},d={class:"table"},u=(0,i._)("thead",null,[(0,i._)("tr",null,[(0,i._)("th",{scope:"col",class:"fw-bold"},"Localité"),(0,i._)("th",{scope:"col",class:"fw-bold"},"Localisation")])],-1),p={scope:"row"};const f={name:"ItemListeApp",props:{data:[]},data:function(){return{icon:"bi bi-plus-square-fill",view:!1}},methods:{toggle:function(){this.view=!this.view,this.icon=this.view?"bi bi-x-square-fill":"bi bi-plus-square-fill"}}};var b=e(3379),v=e.n(b),m=e(117),w={insert:"head",singleton:!1};v()(m.Z,w);m.Z.locals;const g=(0,e(3744).Z)(f,[["render",function(t,n,e,f,b,v){return(0,i.wg)(),(0,i.iD)("div",r,[(0,i._)("div",{class:"bg-oni-primary text-light rounded-3 p-3 cursor-pointer",onClick:n[0]||(n[0]=function(t){return v.toggle()})},[(0,i._)("i",{class:(0,i.C_)([b.icon,"me-3"])},null,2),(0,i.Uk)(" "+(0,i.zw)(e.data.name),1)]),b.view?((0,i.wg)(),(0,i.iD)("div",a,[(0,i._)("div",o,[(0,i._)("p",s,"Département de "+(0,i.zw)(e.data.name),1)]),(0,i._)("div",l,[(0,i._)("div",c,[(0,i._)("table",d,[u,(0,i._)("tbody",null,[((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(e.data.centres,(function(t,n){return(0,i.wg)(),(0,i.iD)("tr",{key:n},[(0,i._)("th",p,(0,i.zw)(t.localite),1),(0,i._)("td",null,(0,i.zw)(t.localisation),1)])})),128))])])])])])):(0,i.kq)("",!0)])}]])},3411:(t,n,e)=>{e.d(n,{Z:()=>b});var i=e(8222),r={class:"container-fluid bg-small-banner position-relative d-flex align-items-center"},a=(0,i._)("div",{class:"overlay"},null,-1),o={class:"container"},s={key:0,class:"fw-light text-white fs-4"},l={class:"fw-bolder oni-color-secondary fs-1 text-uppercase"};const c={name:"SmallBanner",props:{title:{type:String},sousTitre:{type:String}}};var d=e(3379),u=e.n(d),p=e(1512),f={insert:"head",singleton:!1};u()(p.Z,f);p.Z.locals;const b=(0,e(3744).Z)(c,[["render",function(t,n,e,c,d,u){return(0,i.wg)(),(0,i.iD)("div",r,[a,(0,i._)("div",o,[e.sousTitre?((0,i.wg)(),(0,i.iD)("p",s,(0,i.zw)(e.sousTitre),1)):(0,i.kq)("",!0),(0,i._)("p",l,(0,i.zw)(e.title.toLowerCase()),1)])])}]])},7057:(t,n,e)=>{e.r(n),e.d(n,{default:()=>E});var i=e(8222),r=function(t){return(0,i.dD)("data-v-41381d11"),t=t(),(0,i.Cn)(),t},a={class:"list-center-cni"},o={class:"container pt-5"},s={class:"row mb-5"},l=r((function(){return(0,i._)("h1",{class:"fw-bold fs-3 mb-3"}," CENTRE D'ENROLEMENT ET DE RETRAIT",-1)})),c=r((function(){return(0,i._)("hr",null,null,-1)})),d={class:"col-8"},u=r((function(){return(0,i._)("p",{class:"fw-bold fs-5 mb-4"},[(0,i._)("i",{class:"bi bi-geo-alt-fill oni-color-primary"}),(0,i.Uk)(" CENTRE D'ENROLEMENT")],-1)})),p=r((function(){return(0,i._)("br",null,null,-1)})),f={class:"col-4 pt-3"};var b=e(2366),v=e(8352),m=e(3411);const w={name:"ListCenterCni",components:{ItemListeApp:b.Z,DownloadDf:v.Z,SmallBanner:m.Z},mixins:[],props:{},data:function(){return{title:"LISTE DES CENTRES D'ENROLEMENTS ET DE RETRAITS (CNI) ",data_sites:[{name:"conakry",centres:[{localite:"Conakry",localisation:"coleah"}]},{name:"conakry",centres:[{localite:"conakry 2",localisation:"coleah 2"}]}]}},computed:{},watch:{},created:function(){},methods:{}};var g=e(3379),h=e.n(g),_=e(7838),D={insert:"head",singleton:!1};h()(_.Z,D);_.Z.locals;const E=(0,e(3744).Z)(w,[["render",function(t,n,e,r,b,v){var m=(0,i.up)("SmallBanner"),w=(0,i.up)("ItemListeApp"),g=(0,i.up)("DownloadDf");return(0,i.wg)(),(0,i.iD)("div",a,[(0,i.Wm)(m,{title:t.title},null,8,["title"]),(0,i._)("div",o,[(0,i._)("div",s,[l,c,(0,i._)("div",d,[u,((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(t.data_sites,(function(t,n){return(0,i.wg)(),(0,i.iD)("div",{key:n},[p,(0,i.Wm)(w,{data:t},null,8,["data"])])})),128))]),(0,i._)("div",f,[(0,i.Wm)(g)])])])])}],["__scopeId","data-v-41381d11"]])}}]);