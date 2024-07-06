<template>
  <div class="list-center-visa">
		<SmallBanner :title=title />


    <div class="container pt-5">
      <div class="row mb-5">
        <h1 class="fw-bold fs-3 mb-3"> CENTRE D'ENROLEMENT ET DE RETRAIT</h1>
        <hr>
        <div class="col-8">
          <p class="fw-bold fs-5 mb-4"><i class="bi bi-geo-alt-fill oni-color-primary"></i> CENTRE D'ENROLEMENT</p>
          <div v-for="(item , index) in data_sites" :key="index">
            <br>

            <ItemListeApp :data=item />

          </div>


        </div>
        <div class="col-4 pt-3">
          <DownloadDf/>


        </div>
      </div>


    </div>

  </div>
</template>

<script src="./_list-center-visa.js" lang="js"></script>
<style src="./_list-center-visa.less" lang="less" scoped></style>
