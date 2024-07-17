<template>

  <div class="container">

    <div :class="['bg-oni-primary', 'text-light' ,'rounded-2', 'p-3', 'cursor-pointer', view? 'isCollapse': '']" @click="toggle()">
      <i :class="icon" class="me-3"></i>
      {{ data.title }}
    </div>
    <div v-if="view" class="border round">

      <div class="container">

        <ul class="list-unstyled">
          <li v-for="(doc,index) in data.documents" :key="index" class="mt-3">

            <i class="bi bi-check me-2 oni-color-secondary p-0"></i>
            <span class="fs-4 text-black">
              {{ doc }}
            </span>

          </li>

        </ul>
      </div>


    </div>

  </div>
</template>
<script>
export default {
  name: "ItemListDocument",
  props: {
    data: Array
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

.isCollapse {
  border-bottom-right-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
}

.round {

  border-bottom-right-radius: 20px;
  border-bottom-left-radius: 20px;

}
</style>
