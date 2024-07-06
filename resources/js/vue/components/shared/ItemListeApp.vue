<template>

  <div class="container">

    <div class="bg-oni-primary text-light rounded-3 p-3 cursor-pointer" @click="toggle()">
      <i :class="icon" class="me-3"></i> {{data.name}} 
    </div>
    <div v-if="view" class="border rounded-3">


      <div class="container">

        <p class="text-bold fs-4 mt-4  pb-4 border-bottom bg-light p-3">Département de {{data.name}}</p>
      </div>

      <div class=" mx-5 text-center">
        <div class="row text-center">


          <!-- <el-table :data="tableData" style="width: 100%">
                  <el-table-column prop="localite" label="Localité" width="180" style="background-color: blue" />
                  <el-table-column prop="localisation" label="Localisation" width="180" />

              </el-table> -->

          <table class="table">
            <thead>
            <tr>
              <th scope="col" class="fw-bold">Localité</th>
              <th scope="col" class="fw-bold">Localisation</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="(item , index) in data.centres" :key="index">
              <th scope="row">{{item.localite}}</th>
              <td>{{item.localisation}}</td>

            </tr>
            </tbody>
          </table>
        </div>

      </div>

    </div>


  </div>


</template>
<script>
export default {
  name: "ItemListeApp",
  props: {
    data: []

  },
  data() {

    return {

      icon: "bi bi-plus-square-fill",
      view: false,
     
    }

  },
  methods: {

    toggle() {

      this.view = !this.view;
      this.icon = this.view ? "bi bi-x-square-fill" : "bi bi-plus-square-fill"


    }
  }
}
</script>
<style>
.cursor-pointer {

  cursor: pointer;
}
</style>
