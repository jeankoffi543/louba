

<template>
    <div class="list-doc-sejour">
        <SmallBanner :title=title></SmallBanner>

        <div class="container content">
            <div class=" pt-5">
                <div class="col-8 center">
                    <div class=" app-m-0 mr-8" v-for="(item, index) in urgencyProcedure" :key="index">
                        <h4 class="fw-bold oni-color-primary fs-4 mb-4">
                            {{ item?.name}}
                        </h4>
                        <div class="ms-lg-3">
                            {{ item.description }}

                        <!--                            <ul class="liste-unstyled">
                                <li   class="mb-3">
                                    <span class="number-count">{{ index + 1 }}</span>
                                    <p class="m-0 text-jutify">
                                        {{ data.title }}
                                    </p>
                                </li>
                            </ul>-->
                        </div>

                    </div>

                </div>
                
            </div>

            
         <div class="col-5 impression center ">

                    <div class="row mt-3 app-m-0 app-mt-1">
                        <h4 class="fw-bold oni-color-primary fs-4 mb-4">

                            Formulaire de demande
                        </h4>
                        <p class="fw-light text-start">
                            Telecharger , imprimer et remplir au manuscrit le formulaire
                        </p>
                        <button class="btn btn-lg bg-oni-primary text-light">
                            <i class="bi bi-download"></i> TELECHARGER
                        </button>

                    </div>
</div>
           
        </div>

    </div>

</template>

<script src="./_urgency-procedure.js" lang="js"></script>
<style src="./_urgency-procedure.less" lang="less" scoped></style>

