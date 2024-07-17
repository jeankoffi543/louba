<template>
    <div class="oni-figure">
        <SmallBanner :title="title"></SmallBanner>
    </div>
    <div v-loading="isLoading" class="mt-5">
        <div class="row">
            <EmptyState v-if="content == null" class="col-sm-12 col-md-10" @reload="fetchContent"/>
            <template v-else>
                <OniInNumber/>
                <div class="container mt-5 col-md-9">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <p class="fw-bold text-black fs-3 border-bottom">
                                {{ content?.titre?.toString().toUpperCase() }}
                            </p>
                            <div class="mb-1 justify" v-html="content?.paragraphe1"></div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

</template>

<script lang="js" src="./_oni-figure.js"></script>
<style lang="less" scoped src="./_oni-figure.less"></style>
