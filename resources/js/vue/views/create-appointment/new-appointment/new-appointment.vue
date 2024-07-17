<template>
    <div class="container-new-appointment">
        <div v-if="$route.meta && $route.meta.titleSection"
             class="head-appointment app-title-section underline-title mt-5">
            <h3 class="app-text-uppercase fs-2 ">Formulaire {{ getSurfixForm }}</h3>
        </div>
        <div class="body-appointment">
            <router-view></router-view>

            <!--      <div class="container-appointment-dot">
                    <el-row
                        :gutter="12"
                        align="middle"
                        class="appointment-dot"
                        justify="center"
                    >
                      <el-col
                          v-for="(step, index) in appointmentStep"
                          :key="index"
                          :md="4"
                          :sm="4"
                          :xs="24"
                          class="content-dot"
                      >
                        <span
                            :class="{ dotActive: step.pathName === $route.name }"
                            class="dot"
                        ></span>
                      </el-col>
                    </el-row>
                  </div>-->
        </div>
    </div>
</template>

<script lang="js" src="./_new-appointment.js"></script>
<style lang="less" scoped src="./_new-appointment.less"></style>
