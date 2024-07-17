<template>
    <div class="status-document">
        <SmallBanner :title=title></SmallBanner>

        <div class="container-tab container">
            <div class="row m-auto">
                <SearchStatus></SearchStatus>
            </div>
            <ResultSearch></ResultSearch>
        </div>
    </div>

</template>

<script lang="js" src="./_status-document.js"></script>
<style lang="less" scoped src="./_status-document.less"></style>
