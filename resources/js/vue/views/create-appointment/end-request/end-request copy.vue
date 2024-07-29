<template>
    <div class="end-request">


        <div class="card padding-1">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="col-sm-12 col-md-12">
                        <el-form class="g-3 needs-validation" label-position="top">
                            <div class="row d-flex " style="margin-top: 1rem;">
                                <div class="col-sm-12 col-item col-md-8" style=" ">
                                    <el-form-item label="Choisir le point d'enrollement" required>

                                        <el-select v-model="siteAppointmentId" class="w-100">
                                            <el-option
                                                v-for="item in enrolmentsPoint"
                                                :key="item.id_pe"
                                                :label="item.nom_pe"
                                                :value="item.id_pe"
                                            >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </div>
                            </div>
                        </el-form>
                    </div> -->

                    <div class="col-sm-12 col-md-10">

                        <!-- <FullCalendar :events="calendarEvents" :options="calendarOptions" class="calendar-container" /> -->
                        <FullCalendar :events="calendarEvents" :options="calendarOptions" ref="fullCalendar" />
                        <!-- <div class="content-info-personal-appointment mt-0">
                                    <el-calendar ref="calendar" v-model="dateAppointment">
                                        <template #date-cell="{ data }">
                                            <p :class="data.isSelected ? 'is-selected' : ''" class="cell">
                                                {{ numberDay(data) }}
                                                {{ data.isSelected ? '✔️' : '' }}
                                                <el-tag v-if="hasFerry(data)" class="" style="width: auto;"
                                                        type="danger">
                                                    férié
                                                </el-tag>
                                                <el-tag v-else class="" style="width: auto;" type="info">
                                                    ouvrable
                                                </el-tag>

                                            </p>
                                        </template>
</el-calendar>
</div> -->

                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="d-flex flex-column">
                            <div class="col-sm-12 col-md-12 mb-1">
                                <b>Légende</b>
                            </div>
                            <div class="col-sm-12 col-md-12 mb-1">
                                <el-tag class="" style="width: auto; margin-right: 10px;" type="danger">
                                    Jour férié
                                </el-tag>
                                <el-tag class="" style="width: auto;  margin-right: 10px;" type="info">
                                    jour ouvrable
                                </el-tag>
                            </div>
                            <div class="col-sm-12 col-md-12 mb-1" style="margin-top: 1.5rem;">
                                <b>Horaire</b>
                            </div>
                            <div class="col-sm-12 col-md-12 d-flex ">
                                <div class="item-time  text-center w-100 rounded-2 w-auto">
                                    <span class="">Matin 8h30-12h30</span>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6  w-auto mr-1 ml-1"> / </div>
                                <div class="item-time  text-center w-100 rounded-2 w-auto">
                                    <span class="">Soir 13h30-17h00</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-row justify-content-start gap-2">

                            <ButtonApp v-loading="isLoading" :primary-btn="false" button-title="Retour" class="space1"
                                @click="onReturn">
                            </ButtonApp>

                            <ButtonApp v-loading="isLoadingSaveAppointment" button-title="Enregistré" class="space"
                                @click="onSaveAppointment">
                            </ButtonApp>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js" src="./_end-request.js"></script>
<style lang="less" scoped src="./_end-request.less"></style>
