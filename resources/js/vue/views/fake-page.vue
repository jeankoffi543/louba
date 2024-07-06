<template>
  <div class="ordinary-passport-view">
    <SmallBanner :title="title"></SmallBanner>
  </div>
  <div class="mt-5">
    <ProductDocu/>
  </div>
</template>

<script>
import SmallBanner from "../components/shared/SmallBanner.vue";
import ProductDocu from "../components/shared/ProductDocu.vue";

export default {
  name: "FakePage",
  components: {ProductDocu, SmallBanner},
  beforeMount() {
    this.title = this.$route.params.title;
    // console.log("beforeMount this.documentId", this.documentId);
  },
  watch: {
    $route() {
      this.title = this.$route.params.title;
    },
  },
  data() {
    return {
      title: ""
    };
  }
};
</script>

<style scoped>

</style>
