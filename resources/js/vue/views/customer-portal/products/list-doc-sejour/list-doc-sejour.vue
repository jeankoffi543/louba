<template>
    <div class="list-doc-sejour">
        <SmallBanner :title=title></SmallBanner>

        <div class="container">
            <div class="row pt-5">
                <div class="col-8 center">
                    <div class="row app-m-0  ">
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
                <div class="col-6 center ">

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
</template>

<script src="./_list-doc-sejour.js"></script>
<style lang="less" scoped src="./_list-doc-sejour.less"></style>
