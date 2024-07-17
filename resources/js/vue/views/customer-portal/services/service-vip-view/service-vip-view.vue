<template>
    <div class="service-vip-view">
        <SmallBanner :title=title></SmallBanner>

        <div class="container-tab container">
            <div class="row w-75 m-auto mt-3 jc-center">
                <div v-for="(item, index) in dataServices"
                     :key="index"
                     :class="[item.code == type?.code ? 'active-tab bg-oni-primary text-white': 'tabs']"
                     class="col-sm-12 col-md-4 app-cursor-pointer" @click="handleClick(item)">
                    <div class="p-3 text-center text-uppercase fs-6">
                        <span>{{ item?.label }}</span>
                    </div>
                </div>
                <div class="col-sm-12 mt-5">

                    <div class="row" :class="{'flex-row-reverse' : reverseImageId == type?.code}">
                        <div class="col-sm-12 col-md-4 justify-content-center d-flex">
                            <div class="container-img">
                                <img :src="type?.img" :alt="type?.label">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8" data-aos="fade-down-right">
                            <h3 class="oni-color-secondary text-uppercase">{{ type?.label }}</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiores beatae debitis dicta dolore
                                eligendi, eos exercitationem facilis fugit inventore, iusto molestiae molestias nemo neque non odio
                                reiciendis sint, voluptate!
                            </p>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>

</template>

<script src="./_service-vip-view.js" lang="js"></script>
<style src="./_service-vip-view.less" lang="less" scoped></style>
