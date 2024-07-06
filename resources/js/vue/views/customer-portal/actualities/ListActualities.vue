<template>
    <div class="actuality-view">
        <SmallBanner :title="title"></SmallBanner>

        <div class="container mt-4">
            <div v-loading="isLoading" class="row  mb-3 text-center">
                <EmptyState v-if="actualities.length===0" class="col-sm-10" @reload="fetchDataActualities"></EmptyState>

                <template v-else>
                    <ActualityItem v-for="(actuality,index) in actualities" :key="index" :actuality="actuality"
                                   @click="goToDetail(actuality)"/>

                    <el-row :gutter="24" align="middle" justify="space-between">

                        <el-col :md="10" :sm="24" class="d-flex justify-content-start">
                            <router-link class="w-min-content btn bg-oni-primary btn-sm  text-light" to="#"
                                         @click="fetchDataActualities">
                                Actualiser
                            </router-link>
                        </el-col>
                        <el-col :md="14" :sm="24" class="d-flex justify-content-end">
                            <el-pagination
                                :current-page="pagination?.pageIndex"
                                :total="pagination?.total"
                                background
                                class="mt-4"
                                layout="prev, pager, next"
                                small
                                @current-change="onChangePage"></el-pagination>

                        </el-col>


                    </el-row>
                </template>


            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ActualityItem from "../../../components/ActualityItem";
import EmptyState from "../../../components/shared/EmptyState.vue";
import SmallBanner from "../../../components/shared/SmallBanner";

export default {
    name: "ListActualities",
    components: {EmptyState, SmallBanner, ActualityItem},
    computed: {
        ...mapActions(["FETCH_ACTUALITIES"]),
        ...mapGetters({
            actualities: "GET_ACTUALITIES",
            pagination: "GET_PAGINATION_ACTUALITY",
            isLoading: "IS_LOADING_ACTUALITIES"
        })
    },
    methods: {
        fetchDataActualities() {
            this.$store.dispatch('FETCH_ACTUALITIES', {size: -1, pageIndex: this.page});
        },
        goToDetail(item) {
            const params = {id: item.id};
            this.$router.push({name: 'actuality-details', params});
        },
        onChangePage(page) {
            this.page = page;
            this.fetchDataActualities();
        }
    },
    mounted() {
        this.fetchDataActualities();
    },
    data() {
        return {
            title: 'ACTUALITES',
            sousTitre: '',
            page: 1
        };
    }

};
</script>


<style lang="less" scoped>

.container-img {
    padding-top: 0 !important;
    margin: 1rem !important;
}


.w-min-content {

    width: min-content;

}

.content-img {
    width: 50%;
    margin: auto;
    height: 40%;

    img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 100%;
    }
}

.description {
    font-size: 17px;
    color: #726e6e;
}

.time {
    display: flex;
    align-items: center;
    font-size: 14px;
}

.container-img-actuality {
    width: 15%;
}


.fit-content {
    width: fit-content;
}

.display {

    display: grid;
}


@media screen and (max-width: 768px) {
    .ma-t-sm {
        margin-top: 40px;
    }
}
</style>

