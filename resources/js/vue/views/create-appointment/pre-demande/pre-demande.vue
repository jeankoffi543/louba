<template>
    <div class="start-request">
        <div class="demo-collapse">
            <el-collapse ref="collapse" v-model="activeNames" @change="handleChange">
                <el-collapse-item name="3" title="1- TYPE DE DEMANDE">
                    <div class="type-demande">
                        <div class="group">
                            <el-form-item>
                                <el-radio-group v-model="typeDemand" @change="onChangTypeDemande(4)">
                                    <!--  Extrait de naissance, Déclaration de perte, Copie précédent passeport-->
                                    <el-radio border label="nouvelle_demande" model-value="nouvelle_demande">Nouvelle
                                        demande</el-radio>
                                    <el-radio border label="duplicata" model-value="duplicata">Duplicata</el-radio>
                                    <el-radio border label="renouvelement" model-value="renouvelement">Renouvelement
                                    </el-radio>
                                    <el-radio border label="mineur" model-value="mineur">Mineur
                                    </el-radio>
                                    <el-radio border label="binationnaux" model-value="binationnaux">binationnaux
                                    </el-radio>
                                </el-radio-group>
                            </el-form-item>
                        </div>
                    </div>
                </el-collapse-item>

                <el-collapse-item name="4" title="2- Informations personnelle">
                    <div class="information-personne container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Référence bordereau banque <strong
                                            style="color: red;">*</strong></h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.numero_recu" placeholder="Numéro du reçu"
                                            size="default"></el-input>
                                    </el-form-item>
                                    <span v-if="(!formPersonalInfo.numero_recu) && formError" class="error-message">Ce
                                        champs est obligatoire</span>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Numéro d'identification unique <strong
                                            style="color: red;">*</strong></h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.numero_indentification_unique"
                                            placeholder="Numéro d'identification unique" size="default"></el-input>
                                    </el-form-item>
                                    <span v-if="(!formPersonalInfo.numero_indentification_unique) && formError"
                                        class="error-message">Ce champs est obligatoire</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Nom</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.lastname" placeholder="nom" size="default"
                                            required></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.lastname && formError" class="error-message">Ce champs
                                        est obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Prénom</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.firstname" placeholder="prénom"
                                            size="default" required></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.firstname && formError" class="error-message">Ce
                                        champs est obligatoire</span>
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
                                    <span v-if="!formPersonalInfo.gender && formError" class="error-message">Ce champs
                                        est obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-9">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Nationalité d'origine</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.nationality"
                                            placeholder="Nationalité d'origine" size="default"></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.nationality && formError" class="error-message">Ce
                                        champs est obligatoire</span>
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
                                    <span v-if="!formPersonalInfo.nationality_state && formError"
                                        class="error-message">Ce champs est obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Profession</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.profession" placeholder="Profession"
                                            size="default" type="text"></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.profession && formError" class="error-message">Ce
                                        champs est obligatoire</span>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Adresse</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.address" placeholder="Adresse"
                                            size="default" type="text"></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.address && formError" class="error-message">Ce champs
                                        est obligatoire</span>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Email</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.email" placeholder="Email" size="default"
                                            type="email"></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.email && formError" class="error-message">Ce champs
                                        est obligatoire</span>
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
                                    <span v-if="!formPersonalInfo.dateOfBirth && formError" class="error-message">Ce
                                        champs est obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Numéro de téléphone</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.phone" placeholder="contact"
                                            size="default"><template #prepend>+224</template></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.phone && formError" class="error-message">Ce champs
                                        est obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Lieu de Naissance</h1>
                                    <el-form-item>
                                        <el-input v-model="formPersonalInfo.birth_address"
                                            placeholder="Lieu de Naissance" size="default"></el-input>
                                    </el-form-item>
                                    <span v-if="!formPersonalInfo.birth_address && formError" class="error-message">Ce
                                        champs est obligatoire</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </el-collapse-item>

                <el-collapse-item name="5" title="3- Signalement">
                    <div class="information-personne container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Taille (cm)</h1>
                                    <el-form-item>
                                        <el-input v-model="signalement.height" placeholder="Height"></el-input>
                                    </el-form-item>
                                    <span v-if="!signalement.height && formError" class="error-message">Ce champs est
                                        obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Teint</h1>
                                    <el-form-item>
                                        <el-input v-model="signalement.complexion" placeholder="Teint"
                                            size="default"></el-input>
                                    </el-form-item>
                                    <span v-if="!signalement.complexion && formError" class="error-message">Ce champs
                                        est
                                        obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Couleur des cheveux</h1>
                                    <el-form-item>
                                        <el-input v-model="signalement.hair_color" placeholder="Couleur des cheveux"
                                            size="default"></el-input>
                                    </el-form-item>
                                    <span v-if="!signalement.hair_color && formError" class="error-message">Ce champs
                                        est
                                        obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Couleur des yeux</h1>
                                    <el-form-item>
                                        <el-input v-model="signalement.eye_color" placeholder="Couleur des yeux"
                                            size="default"></el-input>
                                    </el-form-item>
                                    <span v-if="!signalement.eye_color && formError" class="error-message">Ce champs est
                                        obligatoire</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </el-collapse-item>

                <el-collapse-item name="5" title="4- Information ascendants">
                    <div class="information-personne container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Père</h1>
                                    <el-form-item>
                                        <el-input v-model="ascendants.father_firstname" placeholder="Prénom"></el-input>
                                    </el-form-item>

                                    <el-form-item>
                                        <el-input v-model="ascendants.father_lastname" placeholder="Nom"></el-input>
                                    </el-form-item>

                                    <el-form-item>
                                        <el-input v-model="ascendants.father_nationality"
                                            placeholder="Nationnalité"></el-input>
                                    </el-form-item>
                                    <span
                                        v-if="(!ascendants.father_firstname || !ascendants.father_lastname || !ascendants.father_nationality) && formError"
                                        class="error-message">Ces champs sont obligatoire</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="group">
                                    <h1 class="fs-5 item-title">Mère</h1>
                                    <el-form-item>
                                        <el-input v-model="ascendants.mother_firstname" placeholder="Prénom"></el-input>
                                    </el-form-item>

                                    <el-form-item>
                                        <el-input v-model="ascendants.mother_lastname" placeholder="Nom"></el-input>
                                    </el-form-item>

                                    <el-form-item>
                                        <el-input v-model="ascendants.mother_nationality"
                                            placeholder="Nationnalité"></el-input>
                                    </el-form-item>
                                    <span
                                        v-if="(!ascendants.mother_lastname || !ascendants.mother_firstname || !ascendants.mother_nationality) && formError"
                                        class="error-message">Ces champs sont obligatoire</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </el-collapse-item>

                <el-collapse-item name="5" title="5- Charger des documents">
                    <div class="document-upload container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">

                                <!-- <el-upload ref="upload" :auto-upload="false" :limit="1" :multiple="true"
                                :on-change="uploadPicture" action="#" :on-remove="onRemovePicture"
                                accept="application/pdf, image/jpg, image/jpeg, image/png" class="upload-demo" drag
                                :list-type="'text'" show-file-list="false">
                                <div v-if="documentPreview?.type == ''" class="el-upload__text">{{ titleDocumentUpload }}</div>
                            </el-upload> -->

                                <div class="d-flex flex-row justify-content-start align-items-center gap-4">
                                    <el-button type="primary" @click="triggerUpload">Charger des fichiers</el-button>

                                    <el-upload ref="upload" :auto-upload="false" :limit="5" :multiple="true"
                                        :before-upload="beforeUpload" :on-change="uploadPicture"
                                        :on-remove="onRemovePicture" action="#"
                                        accept="application/pdf, image/jpg, image/jpeg, image/png" class="upload-demo"
                                        :file-list="fileList" :list-type="'text'">
                                        <div v-if="documentPreview?.type === ''" class="el-upload__text">{{
                                            titleDocumentUpload }}</div>
                                    </el-upload>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 mt-2">

                                <div class="d-flex flex-row justify-content-start align-items-center gap-4">
                                    <el-button type="primary" @click="triggerUpload2">Charger une photo</el-button>

                                    <el-upload ref="upload2" :auto-upload="false" :limit="1" :multiple="false"
                                        :before-upload="beforeUpload" :on-change="uploadBirthCertificate"
                                        :on-remove="onRemoveBirthCertificate" action="#" :file-list="fileList2"
                                        accept="image/jpg, image/jpeg, image/png" class="upload-demo"
                                        :list-type="'text'">
                                        <div v-if="picturePreview?.type === ''" class="el-upload__text">{{
                                            titlePhotoUpload }}</div>
                                    </el-upload>
                                </div>


                                <!-- <el-upload ref="upload2" :auto-upload="false" :limit="1" :multiple="false"
                                    accept="image/jpg, image/jpeg, image/png" :on-change="uploadBirthCertificate"
                                    action="#" :on-remove="onRemoveBirthCertificate" class="upload-demo" drag
                                    list-type="picture-card">
                                    <img v-if="formPersonalInfo.fileListBirthCertificate?.length > 0" :src="picturePreview[0]?.url" class="avatar"> 

                                    <div v-if="picturePreview?.type == ''" class="el-upload__text">Déposer la photo ici
                                        (JPEG, JPG, PNG)
                                    </div>
                                    <div id="pageContainer">
                                        <div id="viewer" class="pdfViewer"></div>
                                    </div>
                                </el-upload> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="app-w-100 app-d-flex app-d-flex app-justify-content-center">
                                <el-row :gutter="24" class="app-w-50">

                                    <el-col :sm="12" :xs="24" class="mt-3">
                                        <ButtonApp style="width: fit-content;" v-loading="isLoadingSaveBrouillon"
                                            button-title="Enregistrer le brouillon" class="space"
                                            @click="sendPredemandeBrouillon"></ButtonApp>
                                    </el-col>

                                    <el-col :sm="12" :xs="12" class="mt-3">
                                        <ButtonApp v-loading="isLoadingSaveAppointment" button-title="Valider"
                                            class="space" @click="sendPredemande"></ButtonApp>
                                    </el-col>
                                </el-row>

                            </div>
                        </div>
                    </div>

                </el-collapse-item>
            </el-collapse>
        </div>
    </div>
</template>

<script lang="js" src="./_pre-demande.js"></script>
<style lang="less" scoped src="./_pre-demande.less"></style>
