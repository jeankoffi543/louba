<template>
    <div class="complaint-page">
        <!--<el-alert @close="resetForm" v-if="responseMessage"  :title="responseMessage" center closable effect="light" show-icon type="info"></el-alert>-->

        <div class="container">
            <div class="row  py-5">
                <div class="d-no col-lg-7 text-center text-lg-start">
                    <img class="image" src="/assets/vue/imgs/others/complaint.gif" >
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <p class="fs-3 fw-bold oni-color-secondary">Formulaire de reclamation</p>
                    <el-form
                        :model="form"
                        class="p-4 p-md-5 border rounded-3 bg-light"
                        label-position="top"
                        label-width="100px"
                    >
                        <el-row :gutter="24" class="app-ml-0 app-mr-0">
                            <el-col :sm="24" :xs="24" class="">
                                <el-form-item label="Votre nom complet">
                                    <el-input
                                        v-model="form.fullname"
                                        size="default"
                                    ></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :sm="24" :xs="24" class="">
                                <el-form-item label="Votre numero de telephone">
                                    <el-input
                                        v-model="form.phone"
                                        size="default"
                                    ></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :sm="24" :xs="24" class="">
                                <el-form-item label="Votre adresse email">
                                    <el-input
                                        v-model="form.email"
                                        size="default"
                                    ></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :sm="24" :xs="24" class="">
                                <el-form-item label="Votre sujet">
                                    <el-input
                                        v-model="form.subject"
                                        size="default"
                                    ></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :sm="24" :xs="24" class="">
                                <el-form-item label="Selectionner votre type de demande">
                                    <el-select
                                        v-model="form.type_request"
                                        class="w-100"
                                    >
                                        <el-option
                                            v-for="item in typeRequest"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value"
                                        >
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :sm="24" :xs="24" class="">
                                <el-form-item label="Votre message">
                                    <el-input
                                        v-model="form.message"
                                        size="large"
                                        type="textarea"
                                    ></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <button v-loading="isLoading" class="w-100 btn btn-lg btn-primary bg-oni-primary"
                                @click="onSendMessage">
                            Envoyer
                        </button>
                        <hr class="my-4">
                        <p class="text-center text-muted">
                            © Copyright 2023 Develop. by Radian
                        </p>
                    </el-form>

                    <!--                    <form class="p-4 p-md-5 border rounded-3 bg-light">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="name">
                                                <label for="name">Votre nom complet</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="numero">
                                                <label for="numero">Votre numero de telephone</label>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Selectionner vôtre type de reclamation</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                    style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">Tapez votre message ...</label>
                                            </div>
                                            <button class="w-100 btn btn-lg btn-primary bg-oni-primary" type="submit">je pose ma reclamation
                                                </button>
                                            <hr class="my-4">
                                            <p class="text-center text-muted">
                                                By OMNIFORM © 2022
                                            </p>

                                        </form>-->

                </div>
            </div>

        </div>
    </div>
</template>

<script src="./_complaint-page.js"></script>
<style lang="less" scoped src="./_complaint-page.less"></style>
