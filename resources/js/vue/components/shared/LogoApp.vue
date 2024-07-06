<template>


  <div class="content-img" @click="redirectTo()" role="button">

    <img alt="Armoiries" src="/imgg/logo.png" class="app-logo " width="15px"/>

  </div>


</template>

<script>
export default {
  name: "LogoApp",
  props: {
    showName: Boolean,
  },
  methods: {
    redirectTo() {
      this.$router.push({name: 'customer-home'});
    },
  },
};
</script>

<style lang="less" scoped>
.app-logo {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  flex-direction: row;
  //height: 100%;
  z-index: 11;
  margin-right:10%;
  width: 160px !important;
  background: #FFF;
  //margin-bottom: 1rem;

  .content-img {
    min-width: 8%;
    height: 100%;
    padding: 0.4rem;
    width: 100%;
    max-width: 100%;

    img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }

  .name {
    color: var(--primaryColor);
    font-size: 3.4rem;
    font-weight: 900;
    text-align: start;
    width: auto;
    margin: 0 0 0 0.5rem;
  }
}

@media screen and (max-width: 768px) {
  .app-logo {

    width: 70px !important;
  }
}

@media screen and (max-width: 500px) {
  .app-logo {

    width: 70px !important;
  }
}
</style>
