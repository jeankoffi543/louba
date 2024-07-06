<template>
  <div class="dashboard-view">
    <el-tabs type="card">
      <el-tab-pane label="VISA">
        <el-container class="container-item-doc">
          <el-row :gutter="24" class="app-w-100">
            <el-col
              v-for="(item, index) in documentsAppointment"
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
      <el-tab-pane >
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
    </el-tabs>
  </div>
</template>

<script lang="js" src="./_dashboard-view.js"></script>
<style lang="less" scoped src="./_dashboard-view.less"></style>
