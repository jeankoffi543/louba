<template>
    <div class="list-document app-container-page">
        <el-container v-loading="isLoading" class="container-item-doc">
            <el-row  :gutter="24" class="app-w-100">
                <el-col v-if="documentsAppointment.length===0"
                        :sm="24" :xs="24">
                    <EmptyState @reload="fetchData"></EmptyState>
                </el-col>
                <el-col
                    v-for="(item, index) in documentsAppointment"
                    v-else
                    :key="index"
                    :sm="8"
                    :xs="24"
                    class="app-mb-1"
                >
                    <ItemDocument
                        :key="index"
                        :dataItem="item"
                        :index-build="index"
                    ></ItemDocument>
                </el-col>
            </el-row>
        </el-container>

        <!--    <el-tabs type="card">
              <el-tab-pane label="VISA">

              </el-tab-pane>
              <el-tab-pane label="PASSEPORT">
                <el-container class="container-item-doc">
                  <el-row :gutter="24" class="app-w-100">
                    <el-col
                      v-for="(item, index) in documentsAppointmentPassport"
                      :key="index"
                      :sm="8"
                      :xs="24"
                      class="app-mb-1"
                    >
                      <ItemDocument
                        :key="index"
                        :dataItem="item"
                        :index-build="index"
                      ></ItemDocument>
                    </el-col>
                  </el-row>
                </el-container>
              </el-tab-pane>
              <el-tab-pane label="TITRE DE SEJOUR">
                <el-container class="container-item-doc">
                  <el-row :gutter="24" class="app-w-100">
                    <el-col
                      v-for="(item, index) in documentsAppointmentResidencePermit"
                      :key="index"
                      :sm="8"
                      :xs="24"
                      class="app-mb-1"
                    >
                      <ItemDocument
                        :key="index"
                        :dataItem="item"
                        :index-build="index"
                      ></ItemDocument>
                    </el-col>
                  </el-row>
                </el-container>
              </el-tab-pane>
            </el-tabs>-->

    </div>
</template>

<script lang="js" src="./_list-document.js"></script>
<style lang="less" scoped src="./_list-document.less"></style>
