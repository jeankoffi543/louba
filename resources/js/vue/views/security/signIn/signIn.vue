<template>

    <div class="register-page col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
            <a class="logo d-flex align-items-center " href="#">
                <img alt="" src="/imgg/logo.png">
            </a>
        </div><!-- End Logo -->

        <div class="card mb-3">

            <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4 app-text-primary fw-bold">Se connecter</h5>
                    <p class="text-center">Entrez vos accès</p>
                </div>

                <el-form label-position="top" class="row g-3 needs-validation">

                    <div class="col-12">
                        <el-form-item label="Email" required>
                            <el-input v-model="form.email" placeholder="votre email" size="large" type="email"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-12">
                        <el-form-item label="Numéro de téléphone" required >
                            <el-input v-model="form.password" placeholder="votre mot de passe" size="large" type="password">
                                <template #prepend>+224</template>
                            </el-input>
                        </el-form-item>
                    </div>

                    <div class="col-12">
                        <ButtonApp :primary-btn="true" block button-title="Se connecter" :loading="isLoading" @click="onSumbitForm"></ButtonApp>
                    </div>

                </el-form>

            </div>
        </div>

        <div class="credits">
            <router-link :to="{name: 'register'}">S'inscrire</router-link>
        </div>

    </div>


 </template>

<script lang="js" src="./_signIn.js"></script>
<style lang="less" scoped src="./_signIn.less"></style>
