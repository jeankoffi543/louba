"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[6785],{117:(t,e,n)=>{n.d(e,{Z:()=>r});var i=n(3645),a=n.n(i)()((function(t){return t[1]}));a.push([t.id,".cursor-pointer{cursor:pointer}",""]);const r=a},1512:(t,e,n)=>{n.d(e,{Z:()=>r});var i=n(3645),a=n.n(i)()((function(t){return t[1]}));a.push([t.id,'.bg-small-banner{background-image:url(/assets/imgs/others/passeport.png);background-size:cover;height:150px}.overlay{background-color:#000;background-size:cover;bottom:0;contain:"";left:0;opacity:50%;position:absolute;right:0;top:0;width:100%}',""]);const r=a},5393:(t,e,n)=>{n.d(e,{Z:()=>r});var i=n(3645),a=n.n(i)()((function(t){return t[1]}));a.push([t.id,"",""]);const r=a},8352:(t,e,n)=>{n.d(e,{Z:()=>o});var i=n(8222),a={class:"card rounded-0"},r=[(0,i.uE)('<div class="card-header text-center"> Fichier (*.pdf) </div><div class="card-body text-center"> - Title documents à fournir ... </div><div class="card-footer text-center"><button class="btn bg-oni-primary px-4 text-light"><i class="bi bi-file-earmark-arrow-down-fill"></i> Telecharger </button></div>',3)];const s={name:"DownloadDf"};const o=(0,n(3744).Z)(s,[["render",function(t,e,n,s,o,l){return(0,i.wg)(),(0,i.iD)("div",a,r)}]])},2366:(t,e,n)=>{n.d(e,{Z:()=>g});var i=n(8222),a={class:"container"},r={key:0,class:"border rounded-3"},s={class:"container"},o={class:"text-bold fs-4 mt-4 pb-4 border-bottom bg-light p-3"},l={class:"mx-5 text-center"},c={class:"row text-center"},d={class:"table"},u=(0,i._)("thead",null,[(0,i._)("tr",null,[(0,i._)("th",{scope:"col",class:"fw-bold"},"Localité"),(0,i._)("th",{scope:"col",class:"fw-bold"},"Localisation")])],-1),p={scope:"row"};const b={name:"ItemListeApp",props:{data:[]},data:function(){return{icon:"bi bi-plus-square-fill",view:!1}},methods:{toggle:function(){this.view=!this.view,this.icon=this.view?"bi bi-x-square-fill":"bi bi-plus-square-fill"}}};var f=n(3379),v=n.n(f),m=n(117),w={insert:"head",singleton:!1};v()(m.Z,w);m.Z.locals;const g=(0,n(3744).Z)(b,[["render",function(t,e,n,b,f,v){return(0,i.wg)(),(0,i.iD)("div",a,[(0,i._)("div",{class:"bg-oni-primary text-light rounded-3 p-3 cursor-pointer",onClick:e[0]||(e[0]=function(t){return v.toggle()})},[(0,i._)("i",{class:(0,i.C_)([f.icon,"me-3"])},null,2),(0,i.Uk)(" "+(0,i.zw)(n.data.name),1)]),f.view?((0,i.wg)(),(0,i.iD)("div",r,[(0,i._)("div",s,[(0,i._)("p",o,"Département de "+(0,i.zw)(n.data.name),1)]),(0,i._)("div",l,[(0,i._)("div",c,[(0,i._)("table",d,[u,(0,i._)("tbody",null,[((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(n.data.centres,(function(t,e){return(0,i.wg)(),(0,i.iD)("tr",{key:e},[(0,i._)("th",p,(0,i.zw)(t.localite),1),(0,i._)("td",null,(0,i.zw)(t.localisation),1)])})),128))])])])])])):(0,i.kq)("",!0)])}]])},3411:(t,e,n)=>{n.d(e,{Z:()=>f});var i=n(8222),a={class:"container-fluid bg-small-banner position-relative d-flex align-items-center"},r=(0,i._)("div",{class:"overlay"},null,-1),s={class:"container"},o={key:0,class:"fw-light text-white fs-4"},l={class:"fw-bolder oni-color-secondary fs-1 text-uppercase"};const c={name:"SmallBanner",props:{title:{type:String},sousTitre:{type:String}}};var d=n(3379),u=n.n(d),p=n(1512),b={insert:"head",singleton:!1};u()(p.Z,b);p.Z.locals;const f=(0,n(3744).Z)(c,[["render",function(t,e,n,c,d,u){return(0,i.wg)(),(0,i.iD)("div",a,[r,(0,i._)("div",s,[n.sousTitre?((0,i.wg)(),(0,i.iD)("p",o,(0,i.zw)(n.sousTitre),1)):(0,i.kq)("",!0),(0,i._)("p",l,(0,i.zw)(n.title.toLowerCase()),1)])])}]])},6785:(t,e,n)=>{n.r(e),n.d(e,{default:()=>E});var i=n(8222),a=function(t){return(0,i.dD)("data-v-503ba0d4"),t=t(),(0,i.Cn)(),t},r={class:"list-center-visa"},s={class:"container pt-5"},o={class:"row mb-5"},l=a((function(){return(0,i._)("h1",{class:"fw-bold fs-3 mb-3"}," CENTRE D'ENROLEMENT ET DE RETRAIT",-1)})),c=a((function(){return(0,i._)("hr",null,null,-1)})),d={class:"col-8"},u=a((function(){return(0,i._)("p",{class:"fw-bold fs-5 mb-4"},[(0,i._)("i",{class:"bi bi-geo-alt-fill oni-color-primary"}),(0,i.Uk)(" CENTRE D'ENROLEMENT")],-1)})),p=a((function(){return(0,i._)("br",null,null,-1)})),b={class:"col-4 pt-3"};var f=n(2366),v=n(8352),m=n(3411);const w={name:"ListCenterVisa",components:{ItemListeApp:f.Z,DownloadDf:v.Z,SmallBanner:m.Z},mixins:[],props:{},data:function(){return{title:"LISTE DES CENTRES D'ENROLEMENTS ET DE RETRAITS ( VISA)",sousTitre:"NOS PRODUITS",data_sites:[{name:"conakry",centres:[{localite:"Conakry",localisation:"coleah"}]},{name:"conakry",centres:[{localite:"conakry 2",localisation:"coleah 2"}]}]}},computed:{},watch:{},created:function(){},methods:{}};var g=n(3379),h=n.n(g),_=n(5393),D={insert:"head",singleton:!1};h()(_.Z,D);_.Z.locals;const E=(0,n(3744).Z)(w,[["render",function(t,e){var n=(0,i.up)("SmallBanner"),a=(0,i.up)("ItemListeApp"),f=(0,i.up)("DownloadDf");return(0,i.wg)(),(0,i.iD)("div",r,[(0,i.Wm)(n,{title:t.title},null,8,["title"]),(0,i._)("div",s,[(0,i._)("div",o,[l,c,(0,i._)("div",d,[u,((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(t.data_sites,(function(t,e){return(0,i.wg)(),(0,i.iD)("div",{key:e},[p,(0,i.Wm)(a,{data:t},null,8,["data"])])})),128))]),(0,i._)("div",b,[(0,i.Wm)(f)])])])])}],["__scopeId","data-v-503ba0d4"]])}}]);