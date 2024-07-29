<template>
  <div
      :class="{
      'btn-full-w': block,
      'app-btn-primary': primaryBtn,
      'app-btn-secondary': !primaryBtn,
    }"
      class="btn-start"
  >

    <!-- <el-button  @click="next" v-if="icon || loading" circle type="success">
        <template v-if="loading">
          <i :class="{ 'el-icon-loading': loading }"></i>
        </template>
        <template v-else>
         <span class="icon">
          <i :class="icon2"></i>
         </span>
        </template>
      </el-button> -->
    <span class="label-btn">{{ buttonTitle }}</span>

    <el-button :loading="loading" circle type="success" v-if="loading" :disabled="disabled">
       <span class="icon" v-if="!loading">
         <slot name="icon"></slot>
       </span>
    </el-button>
  </div>
</template>

<script>
export default {
  name: "ButtonApp",
  props: {
    type: String,
    icon: String,
    icon2: String,
    primaryBtn: {type: Boolean, default: true},
    buttonTitle: {type: String, default: "Suivant"},
    loading: {type: Boolean, default: false},
    block: {type: Boolean, default: false},
    disabled: {type: Boolean, default: false},
  },

  methods: {
    next() {
      // @Todo control
      this.$router.push({name: "appointment-step-three"});
    },
  },
};
</script>

<style lang="less" scoped>
.btn-full-w {
  width: auto !important;
}

.btn-start {
  width: 50%;
}

@media (max-width: 500px) {
  .btn-start {
    width: 80%;
  }
}


.btn-start {
  border-radius: var(--radius-btn);
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-items: center;

  //padding: 0.3rem 18px;
  padding: 1.6em 21px;

  cursor: pointer;

  height: 40px;


  .label-btn {
    flex: 1;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    color: #fff;
    margin-right: 8px;
    //font-size: 22px;
    font-size: inherit;
  }

  .el-button {
    border-color: transparent !important;
      width: 40px;
      height: 40px;
  }

  .icon {
    color: white;

  }
}
</style>
