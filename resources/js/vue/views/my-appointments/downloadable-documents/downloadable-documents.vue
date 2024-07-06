<template>
  <div class="downloadable-documents app-container-page">
    <el-row :gutter="24" class="container-row">
      <el-col
          :sm="24"
          :xs="24"
          class="title-card app-title-section underline-title"
      >
        <h3>Gérer mes documents d’identité</h3>
        <el-radio-group v-model="displayMode" size="small">
          <el-radio-button :label="1">
            <i class="el-icon-menu"></i>
          </el-radio-button>
          <el-radio-button :label="2">
            <i class="el-icon-s-operation"></i>
          </el-radio-button>
        </el-radio-group>
      </el-col>

      <el-col :xs="24" class="app-pr-0 app-pl-0">
        <el-row :gutter="24" class="app-ml-0 app-mr-0">
          <el-container v-if="displayMode === 1">
            <el-col
                v-for="(item, index) in downloadableDocuments"
                :key="index"
                :md="6"
                :sm="8"
                :xs="24"
                class=""
            >
              <div class="item app-d-flex app-align-items-center app-justify-content-center " id="flex">
                <div class="app-flex-auto file">
                  <i class="el-icon-document"></i>
                </div>
                <div class="name">
                  <span class="app-flex-1 app-text-center">{{
                      item?.documentName
                    }}</span>
                </div>
                <el-button circle class="" type="success">
                  <el-icon>
                    <Download/>
                  </el-icon>
                </el-button>
              </div>
            </el-col>
          </el-container>

          <div v-if="displayMode === 2" class="box-shadow">
            <el-table
                :data="downloadableDocuments"
                border
                stripe
                style="width: 100%"
            >
              <el-table-column label="Date du rendez-vous" prop="date">
              </el-table-column>
              <el-table-column label="Nom du document" prop="documentName">
              </el-table-column>
              <el-table-column label="Type du document" prop="typeDocument">
                <template v-slot:scope="scope">
                  <el-tag>{{ scope.typeDocument }}</el-tag>
                </template>
              </el-table-column>
            </el-table>
          </div>
        </el-row>
      </el-col>
    </el-row>
  </div>
</template>

<script lang="js" src="./_downloadable-documents.js"></script>
<style lang="less" scoped src="./_downloadable-documents.less"></style>
