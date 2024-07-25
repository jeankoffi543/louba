<template>
   
    <div class="mt-5">
        <div v-loading="isLoading" class="container">
            <div class="row">
                <EmptyState v-if="content == null" class="col-sm-12 col-md-10" @reload="fetchContent"/>
                <template v-else>
                    <div class="col-sm-12 col-md-6">
                        <h2 class="fw-bold colors fs-3">
                            {{ content?.titre }}
                        </h2>
                        <div class="text-start space-bottom">
                            <img alt="" src="/assets/vue/imgs/others/divider-red.png" srcset=""/>
                        </div>
                        <div class="mb-1" v-html="content?.paragraphe1"></div>
                        <div class="mb-1" v-html="content?.paragraphe2"></div>
                       
                    </div>
                    <div class="col-sm-12 col-md-6">

                        <div class="d-flex flex-column align-center text-center">
                            <div class="container-image">
                                <img :src="content?.image" srcset="">
                            </div>
                            <p class="fw-bold text-muted">
                                <!--                            M. Bayla Ly-->
                            </p>
                        </div>
                    </div>
                </template>

            </div>

           <div class="separation"></div>

            <div class="conteu">

                <h2 class="fw-bold text-center colors fs-3" >
                           
                           Ce qui nous rend fiers
                 </h2>
                <div class="text-center space-bottom">
                <img alt="" src="/assets/vue/imgs/others/divider-red.png" srcset=""/>
                </div>

                 <div class="check">
                         <div class="section1">
                             <p  class=" text-black">
                              <a > <img alt="" class="mr" src="/assets/vue/imgs/others/check.png" srcset=""/> </a>
                                La qualité de nos documents est reconnue dans le monde entier.
                            </p>
                            <p  class=" text-black">
                               <a > <img alt="" class="mr" src="/assets/vue/imgs/others/check.png" srcset=""/> </a>
                                Nous assurons une sécurité accrue dans l'obtention des passeports pour les populations guinéennes.
                            </p>
                             <p  class=" text-black">
                              <a > <img alt="" class="mr" src="/assets/vue/imgs/others/check.png" srcset=""/>  </a>
                                  Nous continuons de faciliter l'obtention de visas pour les étrangers souhaitant venir en Guinée.
                            </p>
                            
                         </div>
                         <div class="section2">
                               <p class=" text-black">
                                <a > <img alt="" class="mr" src="/assets/vue/imgs/others/check.png" srcset=""/>  </a>
                               Nous donnons aux Guinéens de l'étranger la possibilité d'obtenir leurs passeports dans toutes les ambassades de Guinée sans avoir à se déplacer pour la Guinée.
                            </p>
                            <p class=" text-black">
                             <a > <img alt="" class="mr" src="/assets/vue/imgs/others/check.png" srcset=""/> </a>
                              Nous proposons un service Express pour fournir des documents biométriques en un temps record.
                            </p>
                            <p class=" text-black">
                             <a > <img alt="" class="mr" src="/assets/vue/imgs/others/check.png" srcset=""/> </a>
                              Nous avons relevé plusieurs défis qui nous ont permis de fournir de meilleurs services.
                            </p>
                         </div>
                 </div>

                  <div class="cardes">
                        <h1 class=" text-white">
                            OMNIFORM en chiffres
                         </h1>
                            
                        <div class="description">

                            <h2 class=" text-white">
                                1 000 000  <br>
                                 <span> passeports biométriques </span>
                             </h2>

                              <h2 class=" text-white">
                                 85 000  <br>
                                <span> Visas Electroniques </span>
                             </h2>

                              <h2 class=" text-white">
                                 56 000 <br>
                                 <span> Cartes de séjour </span>
                             </h2>

                        </div>

                  </div>

            </div>


        </div>
    </div>

</template>

<script lang="js" src="./_sentense-dg.js"></script>
<style lang="less" scoped src="./_sentense-dg.less"></style>
