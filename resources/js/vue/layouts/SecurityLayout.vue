<template>

  <div class="container-fluid SecurityLayout">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <router-view></router-view>
        </div>
      </div>

    </section>

  </div>

</template>

<script>
export default {
  name: "SecurityLayout"
};
</script>

<style lang="less" >
.SecurityLayout {
  background: #f6f9ff;
}

.card {
  border: none !important;
}

.card-body {
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0 30px rgb(1 41 112 / 10%);
}

.logo {
  width: 50% !important;

  img {
    width: 100%;
    height: 100%;
  }
}
</style>
