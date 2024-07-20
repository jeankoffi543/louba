<template>
    <nav class="py-2 border-bottom w-100 colors">
        <div class="container ">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-sm-start">
                    <div class="contact-item">
                    <span>
                      <i class="bi bi-envelope"></i>
                      <a class="mr-1" href="">contact@radiangn.com</a>
                    </span>
                        <span>
                          <i class="bi bi-phone"></i>
                          <a class="mr-1" href="tel:+224620000000">+224620000000</a>
                        </span>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-sm-end">
                    <div class="contact-item">
            <span>
              <i class="mr-1 bi bi-linkedin"></i>
              <i class="mr-1 bi bi-twitter"></i>
              <i class="mr-1 bi bi-facebook"></i>
              <i class="mr-1 bi bi-youtube"></i>
            </span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    name: 'TopHeader'
};
</script>
<style lang="less" scoped>

.container-img {
    width: 25%;
    margin-right: 2rem;

    img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
}

.colors{
    background:#fff;
}

.contact-item {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    margin-right: 3rem;

    span {
        display: flex;
        align-items: center;
        font-size: 13px;
        color: #000;
        margin-right: 1rem;
        color: #2B2B2B;

        a {
            color: #000;
            font-weight: bold;
            margin-left: 5px;
        }
    }
}

.mr-1 {
    margin-right: 1rem;
}

header {
}

/*.dropdown-menu {
  position: fixed !important;
  margin: 0px;
  transform: inherit !important;
  width: auto !important;
  inset: inherit !important;
  //left: 5% !important;
  //right: 5% !important;
  margin-top: 16px !important;
  overflow-y: auto;
  overflow-x: hidden !important;
  height: 400px !important;

}*/

.border-bottom {
    border-bottom: 1px solid #e4e4e461 !important;
}

.btn-oni :hover {
    background-color: #033a2b !important;
    font-size: 20px;
}

a {

    text-decoration: none;
}


.dropdown-menu li {
    position: relative;
}


@media screen and (max-width: 768px) {

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
