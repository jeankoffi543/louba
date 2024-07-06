<template>
    <div class="container col-lg-9">
        <div class="col-lg-7 text-light mt-5 mb-3">
            <h1 class="display-4 fw-bold oni-color-secondary fs-1">
                Actualités
            </h1>
            <img alt="" src="/assets/vue/imgs/others/divider-red.png"/>
        </div>
        <div v-loading="isLoading" class="row  mb-3 text-center">
            <EmptyState v-if="actualities.length===0" @reload="onReloadData"/>
            <template v-else>
                <ActualityItem v-for="(actuality,index) in actualities" :key="index" :actuality="actuality"
                               @click="goToDetail(actuality)"/>
                <el-row :gutter="24" align="middle" justify="space-between">
                    <el-col :md="14" :sm="24">
                        <el-pagination
                            :current-page="pagination?.pageIndex"
                            :total="pagination?.total"
                            background
                            class="mt-4"
                            layout="prev, pager, next"
                            small
                            @current-change="onChangePage"></el-pagination>

                    </el-col>

                    <el-col :md="10" :sm="24" class="d-flex justify-content-end">
                        <router-link :to="{name: 'actualities'}"
                                     class="btn bg-oni-primary btn-sm  text-light">Voir toute
                            les actualités
                        </router-link>
                    </el-col>

                </el-row>
            </template>

        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ActualityItem from "../components/ActualityItem";
import EmptyState from "./shared/EmptyState";

export default {
    name: "ActualityApp",
    components: {ActualityItem, EmptyState},
    computed: {
        ...mapActions(["FETCH_ACTUALITIES", "FETCH_ONE_ACTUALITY"]),
        ...mapGetters({
            actualities: "GET_ACTUALITIES",
            pagination: "GET_PAGINATION_ACTUALITY",
            isLoading: "IS_LOADING_ACTUALITIES"
        })
    },
    data() {
        return {
            page: 1
        };
    },
    methods: {
        fetchDataActualities() {
            this.$store.dispatch('FETCH_ACTUALITIES', {pageIndex: this.page, size: 4});
        },
        goToDetail(item) {
            const params = {id: item.id};
            this.$router.push({name: 'actuality-details', params});
        },
        onReloadData() {
            this.fetchDataActualities();
        },
        onChangePage(page) {
            console.log("page", page);
            this.page = page;
            this.fetchDataActualities();
        }
    },
    mounted() {
        this.fetchDataActualities();
    }

};
</script>

<style lang="less" scoped>

.container-img-actuality {
    width: 15%;
}


.fit-content {
    width: fit-content;
}

.display {

    display: grid;
}


.w-min-content {

    width: min-content;

}

@media screen and (max-width: 768px) {
    .ma-t-sm {
        margin-top: 40px;
    }
}
</style>
