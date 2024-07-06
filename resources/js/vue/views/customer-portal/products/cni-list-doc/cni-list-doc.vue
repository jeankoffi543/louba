<template>

    <div class="cni-list-doc">
        <SmallBanner :title=title></SmallBanner>

        <div class="container">
            <div class="row pt-5">
                <div class="col-7 border-end">
                    <div class="row app-m-0 mr-8">
                        <h4 class="fw-bold oni-color-primary fs-4 mb-4">
                            Documents a fournir
                        </h4>
                        <div class="ms-lg-3">
                            <ul class="liste-unstyled">
                                <li v-for="(data, index) in requestFolder" :key="index" class="mb-3">
                                    <span class="number-count">{{ index + 1 }}</span>
                                    <p class="m-0 text-jutify">
                                        {{ data.title }}
                                    </p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row app-m-0 ">
                        <h4 class="fw-bold oni-color-primary fs-4 mb-4">
                            Procédure
                        </h4>

                        <div class="ms-lg-4">
                            <ul class="liste-unstyled">
                                <li v-for="(data, index) in processFolder" :key="index" class="mb-3">
                                    <span class="number-count">{{ index + 1 }}</span>
                                    <p class="m-0">
                                        {{ data.title }}
                                    </p>
                                </li>
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-5 ">

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

    </div>

<!--        <div class="container pt-5">
            <div class="row mb-5">
                <div class="col-12">
                    <h1 class="fw-bold fs-3 mb-3">
                        DOCUMENTS A FOURNIR CONCERNANT LA CARTE D'IDENTITE NATIONAL
                    </h1>
                    <hr>
                </div>
                <div class="col-8">
                    <div v-for="(item , index ) in  data " :key="index" class="app-mb-1">
                        <ItemListDocument :data="item"></ItemListDocument>
                    </div>
                </div>
                <div class="col-4 app-pt-0">
                    <DownloadDf/>
                </div>
            </div>
        </div>-->
</template>

<script src="./_cni-list-doc.js"></script>
<style lang="less" scoped src="./_cni-list-doc.less"></style>
