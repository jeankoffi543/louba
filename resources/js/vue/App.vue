<template>
    <router-view/>
</template>

<style lang="less">

:root {
    //--el-color-primary: green;
    --el-menu-item-font-size: 12px;
}

.el-menu--horizontal > .el-sub-menu .el-sub-menu__title {
    padding: 0 10px !important;
}


body {
    //font-family: 'RobotoMedium';
}

#app {
    //-webkit-font-smoothing: antialiased;
    //-moz-osx-font-smoothing: grayscale;
    //text-align: center;
    //color: #2c3e50;
}

nav {
    //padding: 30px;
    a {
        //font-weight: bold;
        //color: #2c3e50;
        &.router-link-exact-active {
            //color: #42b983;
        }
    }


}
</style>
