<template>

  <div>
    <SmallBanner :title=title  />
    <div class="container mt-5">


      <div class="text-end">

        <button class="btn bg-oni-primary text-light">
          <i class="bi bi-download"></i> TELECHARGER
        </button>

      </div>

      <div class="row mb-5 ">
        <p class="fw-bold fs-5 mb-4"><i class="bi bi-geo-alt-fill oni-color-primary"></i>LISTES DE NOS AMBASSADES
        </p>
        <hr>


        <table class="table">
          <thead>
          <tr>
            <th scope="col" class="fw-bold">PAYS</th>
            <th scope="col" class="fw-bold">ADRESSE</th>
            <th scope="col" class="fw-bold">TELEPHONE / FAX</th>
            <th scope="col" class="fw-bold">EMAIL / WEBSITE</th>
          </tr>
          </thead>
          <tbody>

          <tr v-for="data in tableData" :key="data.id">
            <th scope="row">{{ data.pays }}</th>
            <td>{{ data.adresse }}</td>
            <td>{{ data.tel }}</td>
            <td>{{ data.lien }}</td>
          </tr>

          </tbody>
        </table>


      </div>


    </div>

  </div>
</template>

<script src="./_ambassade-view.js" lang="js"></script>
<style src="./_ambassade-view.less" lang="less" scoped></style>
