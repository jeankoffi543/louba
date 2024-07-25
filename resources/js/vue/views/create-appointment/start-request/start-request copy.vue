<template>
    <div class="start-request">
        <div class="demo-collapse">
            <el-collapse ref="collapse" v-model="activeNames" @change="handleChange">
                <el-collapse-item v-loading="isLoading" name="1" title="Sélectionner le type de document">
                    <div class="object-appointment">
                        <div class="container-fluid">
                            <div class="row container-appointment-form-row ">
                                <div v-for="(item, index) in products" :key="index"
                                    class="item-request-type  col-sm-12 col-md-6 col-lg-3 mb-2"
                                    @click="radioAppointmentChangeProduct(item, 2)">
                                    <div :class="{ selected: item?.id == productSelected?.id, disabled: !item?.flow_enable }"
                                        class=" cartes shadow h-100">
                                        <div class="item-request-type-head mt-3 text-center border-0">
                                            <img :alt="item?.nom" :src="item?.image" class="" />
                                        </div>
                                        <h6 class="my-0 fw-bold colors text-center"
                                            style="margin: 13px 0px !important;">
                                            {{ item?.nom }}
                                        </h6>

                                        <div class="trait"></div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-100" v-if="demandeType == 'passport' || demandeType == null">
                        <el-collapse-item id="typeServiceRef" ref="typeServiceRef" name="2"
                            title="Selectionner le type de service">
                            <div class="service-appointment">
                                <div class="container-fluid">
                                    <div class="row container-appointment-form-row">
                                        <div v-for="(item, index) in servivesAvailable" :key="index"
                                            class="item-request-type col-sm-12 col-md-6  col-lg-3 mb-2"
                                            @click="radioAppointmentChangeService(item, 3)">
                                            <div :class="{ selected: item?.id == serviceSelected?.id }"
                                                class="card  shadow border-0 h-100">
                                                <div class="item-request-type-head mt-3 text-center border-0">
                                                    <img :alt="item?.name" :src="item?.image" class=" border-0 img" />
                                                </div>
                                                <h6 class="my-0 fw-bold text-center"
                                                    style="margin: 13px 0px !important;">
                                                    {{ item?.name }}
                                                </h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </el-collapse-item>
                        <el-collapse-item name="3" title="TYPE DE DEMANDE">
                            <div class="type-demande">
                                <div class="group">
                                    <el-form-item>
                                        <el-radio-group v-model="typeDemand" @change="onChangTypeDemande(4)">
                                            <!--  Extrait de naissance, Déclaration de perte, Copie précédent passeport-->
                                            <el-radio border label="nouvelle_demande"
                                                model-value="nouvelle_demande">Nouvelle
                                                demande</el-radio>
                                            <el-radio border label="duplicata"
                                                model-value="duplicata">Duplicata</el-radio>
                                            <el-radio border label="renouvelement"
                                                model-value="renouvelement">Renouvelement
                                            </el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                </div>
                            </div>
                        </el-collapse-item>
                        <el-collapse-item name="4" title="Informations personnelle">
                            <div class="information-personne container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Numéro reçu</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.numero_recu" placeholder="Numéro du reçu"
                                                    size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Nom</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.lastname" placeholder="nom"
                                                    size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Prénom</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.firstname" placeholder="prénom"
                                                    size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Genre</h1>
                                            <el-form-item>
                                                <el-radio-group v-model="formPersonalInfo.gender">
                                                    <el-radio border label="H">Homme</el-radio>
                                                    <el-radio border label="F">Femme</el-radio>
                                                </el-radio-group>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-9">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Nationalité d'origine</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.nationality"
                                                    placeholder="Nationalité d'origine" size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Statut nationnalité</h1>
                                            <el-form-item>
                                                <el-radio-group v-model="formPersonalInfo.nationality_state">
                                                    <el-radio border label="birth">Naissance</el-radio>
                                                    <el-radio border label="naturalization">Naturalisation</el-radio>
                                                    <el-radio border label="mariage">Mariage</el-radio>
                                                </el-radio-group>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Profession</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.profession" placeholder="Profession"
                                                    size="default" type="text"></el-input>
                                            </el-form-item>
                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Email</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.email" placeholder="Email"
                                                    size="default" type="email"></el-input>
                                            </el-form-item>
                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Date de naissance</h1>
                                            <el-form-item>
                                                <el-date-picker v-model="formPersonalInfo.dateOfBirth"
                                                    :disabled-date="pickerOptions.disabledDate" class="w-100"
                                                    placeholder="Date de naissance" size="default" type="date" />
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Numéro de téléphone</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.phone" placeholder="contact"
                                                    size="default"><template #prepend>+224</template></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Lieu de résidence</h1>
                                            <el-form-item>
                                                <el-input v-model="formPersonalInfo.placeOfResidence"
                                                    placeholder="Lieu de résidence" size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </el-collapse-item>

                        <el-collapse-item name="5" title="Signalement">
                            <div class="information-personne container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Taille (cm)</h1>
                                            <el-form-item>
                                                <el-input v-model="signalement.height"
                                                    placeholder="Height"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Teint</h1>
                                            <el-form-item>
                                                <el-input v-model="signalement.complexion" placeholder="Teint"
                                                    size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Couleur des cheveux</h1>
                                            <el-form-item>
                                                <el-input v-model="signalement.hair_color"
                                                    placeholder="Couleur des cheveux" size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Couleur des yeux</h1>
                                            <el-form-item>
                                                <el-input v-model="signalement.eye_color"
                                                    placeholder="Couleur des yeux" size="default"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </el-collapse-item>

                        <el-collapse-item name="5" title="Information ascendants">
                            <div class="information-personne container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Père</h1>
                                            <el-form-item>
                                                <el-input v-model="ascendants.father_firstname"
                                                    placeholder="Prénom"></el-input>
                                            </el-form-item>

                                            <el-form-item>
                                                <el-input v-model="ascendants.father_lastname"
                                                    placeholder="Nom"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="group">
                                            <h1 class="fs-5 item-title">Mère</h1>
                                            <el-form-item>
                                                <el-input v-model="ascendants.mother_firstname"
                                                    placeholder="Prénom"></el-input>
                                            </el-form-item>

                                            <el-form-item>
                                                <el-input v-model="ascendants.mother_lastname"
                                                    placeholder="Nom"></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </el-collapse-item>

                        <el-collapse-item name="6" title="Documents à charger">
                            <div class="document-upload container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <el-upload ref="upload" :auto-upload="false" :limit="1" :multiple="false"
                                            :on-change="uploadPicture" action="#" :on-remove="onRemovePicture"
                                            class="upload-demo" drag list-type="picture-card">
                                            <img v-if="formPersonalInfo.fileListBirthCertificate?.length > 0"
                                                :src="formPersonalInfo.fileListBirthCertificate[0]" class="avatar">
                                            <div v-else class="el-upload__text">{{ titleDocumentUpload }}</div>

                                        </el-upload>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mt-2">
                                        <el-upload ref="upload" :auto-upload="false" :limit="1" :multiple="false"
                                            :on-change="uploadBirthCertificate" action="#"
                                            :on-remove="onRemoveBirthCertificate" class="upload-demo" drag
                                            list-type="picture-card">
                                            <img v-if="formPersonalInfo.fileListPicture?.length > 0"
                                                :src="formPersonalInfo.fileListPicture[0]" class="avatar">
                                            <div v-else class="el-upload__text">Déposer la photo ici</div>

                                        </el-upload>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="app-w-100 app-d-flex app-d-flex app-justify-content-center">
                                        <el-row :gutter="24" class="app-w-50">
                                            <el-col :sm="24" :xs="24" class="mt-3">
                                                <ButtonApp block button-title="Valider" @click="onSwitchPage">
                                                </ButtonApp>
                                            </el-col>
                                        </el-row>

                                    </div>
                                </div>
                            </div>
                        </el-collapse-item>
                    </div>
                </el-collapse-item>

            </el-collapse>
        </div>
    </div>
</template>

<script lang="js" src="./_start-request.js"></script>
<style lang="less" scoped src="./_start-request.less"></style>
