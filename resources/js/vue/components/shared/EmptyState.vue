<template>
  <div class="container app-cursor-pointer my-5" @click="this.$emit('reload')">
    <div class="row d-flex flex-column align-items-center justify-content-evenly">
      <div class="container-img">
        <img alt="Aucune donné" src="/assets/vue/illustration/empty-state.gif">
      </div>
      <h6 class="text-bold text-center pb-4 ">Aucune donnée disponible ...</h6>
    </div>
  </div>
</template>

<script>
export default {
  name: "EmptyState",

};
</script>

<style lang="less" scoped>
.container-img {
  width: 15%;
  margin: auto;

  img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
}
</style>
