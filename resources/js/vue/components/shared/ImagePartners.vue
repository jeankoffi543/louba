<template>
  <div class="app-d-flex app-flex-d-column container-imagePartners app-cursor-pointer" @click="openLink">
    <div :style="{width: width }" class="container-img">
      <img
          :alt="logoName"
          :src="uriSrc"
          class="partenaireImg"
          srcset=""
      />
    </div>
    <div class="d-flex align-items-center justify-content-center text-center app-w-100 py-2">
      <span class="app-text-ellipsis"> {{ logoName }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "ImagePartners",
  props: {
    logoName: String,
    uriSrc: String,
    link: String,
    width: String,
  },
  methods:{
    openLink(){
      window.open(this.link, '_blank')
    }
  }
};
</script>

<style lang="less" scoped>
.container-imagePartners {
  align-items: center;
  padding: 1rem;
  border: 1px solid #EEEEEE;
  height: 100%;
  justify-content: center;

  span {
    font-weight: 600;
  }

  .container-img {

    width: 38%;
    height: 100%;
    margin-bottom: 1rem;

    img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }


}

.app-text-ellipsis {
  white-space: nowrap;
  overflow: hidden !important;
  text-overflow: ellipsis;
}


@media screen and (max-width: 500px) {
  .partenaireImg {

    width: 50px !important;
  }
}


</style>
