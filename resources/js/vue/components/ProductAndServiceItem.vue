<template>
    <div class="col-sm-12 col-md-6 col-lg-3 mb-3 cardTopHeader ">
        <div class="h-100 app-p-0 txt  shadow app-d-flex app-flex-d-column">
            <div class="card-header mt-4 bg text-center border-0 " style="">
                <img :src="product?.image" :alt="product?.name">
            </div>
            <div class="card-middle">
                <h5 class=" my-0 fw-bold text-center">
                    {{ product?.name }}
                </h5>
            </div>
              <div class="trait"></div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ProductAndServiceItem',
    props: {
        product: {}
    },
    methods: {}
}
</script>
<style lang="less" scoped>
.card-body {
    flex: initial;
}

.card-middle {
    flex: .2;
    margin: 13px 0 !important;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 8px;
      color:#030b3c;
}
  .cardTopHeader{
         margin-top: 1rem !important;

    }

    .txt{

         border: 1px solid gray;
         border-radius:2px;
    }
    .trait{
        display:flex;
        justify-content:center;
        width:25px;
        height:3px;
        margin-left:auto;
        margin-right:auto;
        margin-bottom:15px;
        border-radius:5px;
        background:#00ccc2;
    }

.card-header {
    flex: auto;
    margin-top:10px;
    justify-content: space-around;
    //width: 30%;
    margin: auto;
    background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;
    max-width: 50%;

    align-items: center;
    display: flex;

    img {
        //width: 100%;
        //height: 100%;
        width: 100%;
        height: 100%;
        object-fit: cover;

    }

    h5 {
        margin-top: 1rem !important;

    }

}

@media screen and (min-width: 768px) {

}


</style>
