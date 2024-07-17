<template>
    <div class="list-doc-visa">
        <SmallBanner :title=title></SmallBanner>

        <div class="container">
            <div class="row pt-5">
                <div class="demo-collapse">
                    <el-collapse  accordion>
                        <el-collapse-item  v-for="(item, index) in typeVisa" :name="index">
                            <template #title>
                                <el-icon class="header-icon">
                                    <info-filled/>
                                </el-icon>
                                <span class="title">{{ item.name }}</span>

                            </template>
                            <div class="description">
                                {{ item.description }}
                            </div>
                        </el-collapse-item>

                    </el-collapse>
                </div>
            </div>
        </div>

    </div>
</template>

<script lang="js" src="./_list-doc-visa.js"></script>
<style lang="less" scoped src="./_list-doc-visa.less"></style>
