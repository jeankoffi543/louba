<template>
  <div class="container-default-layout">

    <TopHeader></TopHeader>
    <header class="header-height">
      <nav class="navbar navbar-expand-md navbar-light  bg-light shadow overflow-auto">
        <div class="container-fluid my-1">

          <LogoApp/>

          <button aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
                  class="navbar-toggler collapsed" data-bs-target="#navbarCollapse" data-bs-toggle="collapse"
                  type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div id="navbarCollapse" class="navbar-collapse collapse app-justify-content-flex-end">

            <ul class="navbar-nav d-flex  justify-content-end mb-md-0 ms-lg-5 ma-t">
              <li>
                <router-link :to="{name: 'customer-home'}" class="nav-link px-2 fw-bold">
                  ACCUEIL
                </router-link>
              </li>
            </ul>

          </div>


        </div>
      </nav>
    </header>
    <router-view></router-view>
  </div>
</template>

<script>

import LogoApp from "../components/shared/LogoApp";
import TopHeader from "../components/shared/TopHeader";


export default {
  name: "AppointmentLayout",
  components: {
    LogoApp,
    TopHeader
  },
  data() {
    return {
      activeIndex: "home-page",
      textColorMenu: "var(--primaryColor)",
      activeTextColorMenu: "var(--secondaryColor)",
    };
  },
  computed: {},
  methods: {
    handleSelect(pathName) {
      this.$router.push({name: pathName});
    },

  },
  mounted() {
  },
};
</script>

<!-- <style lang="less" scoped>






////////

.nav-height {
  height: var(--nav-height);
}

.header-height .navbar {
  height: var(--height-menu);

}

.container-default-layout {
  width: 100vw;
  height: fit-content;
}

@media screen and (max-width: 600px) {
  .container-head {
    width: 10%;
  }
}

.container-head {
  z-index: 10;
  height: var(--height-menu);
  max-height: var(--height-menu);
  display: flex;
  justify-content: space-between;
  width: 100%;
  padding: 0 2rem 0;
  //padding: 1rem 2rem 0;
  margin: 0 !important;
  position: sticky;
  top: 0;
  background: #fff;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  box-shadow: rgba(99, 99, 99, 0.2) 0 2px 8px 0;
}

.container-menu {
  .el-menu.el-menu--horizontal {
    border-bottom: none;
    display: flex;
    justify-content: center;
    background: transparent;
  }

  .el-menu--horizontal > .el-menu-item.is-active {
    border-bottom-color: var(--secondaryColor);
  }

  .el-menu-item {
    font-size: 15px;
    font-weight: 500;
  }
}

.container-log {
  width: 100%;
}
</style> -->

<style lang="less" scoped>

.header-height .navbar {
  background: #ffff !important;

}


.bg-fff {
  background: #fff;
}

header {
  .el-row.app-logo {
    width: 8% !important;
  }
}

.dropdown-item {
  &:hover {
    cursor: pointer;
  }
}

.dropdown-menu {
  position: fixed !important;
  margin: 0px;
  transform: inherit !important;
  width: auto !important;
  inset: inherit !important;
  left: 5% !important;
  right: 5% !important;
  margin-top: 25px !important;
  overflow-y: scroll;
  overflow-x: hidden !important;
  height: 400px !important;

}

.nav-item {
  position: static !important;
}

.btn-oni :hover {
  background-color: #033a2b !important;
  font-size: 20px;
}

.dropdown-header {
  color: #edb222;
}

.back {
  background-color: #d3d3d3;
}

a {

  text-decoration: none;
}

.nav-link {

  color: #008F5D;
}

.back2 {
  background-color: #103c22;
}

.dropdown-item {
  font-weight: 600;
}

#bouton {
  color: white;
}


.icon-color {
  color: #033a2b;
}

@media screen and (max-width: 768px) {
  .d-no {
    display: none;
  }

  .dropdown-menu {
    width: 400px !important;
  }

  .ma-t {

    margin-top: 10px;
  }

  .el-row.app-logo {
    width: 20%;
  }
}

/* ============ desktop view ============ */
@media all and (min-width: 992px) {
}

/* ============ desktop view .end// ============ */

/* ============ mobile view ============ */
@media (max-width: 991px) {
}


/* ============ mobile view .end// ============ */

</style>
