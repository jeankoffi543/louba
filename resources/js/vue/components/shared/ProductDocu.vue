<template>
  <div class="container mt-5">
    <div class="row pt-5">
      <div class="col-8 center">
        <div class="row app-m-0">
          <h4 class="fw-bold oni-color-primary fs-4 mb-4">
            Documents a fournir
          </h4>
          <div class="ms-lg-5">
            <ul class="liste-unstyled">
              <li v-for="(data, index) in requestFolder" :key="index" class="mb-3">
                <span class="number-count">{{ index + 1 }}</span>
                <p class="m-0 text-jutify">
                  {{ data.title }}
                </p>
              </li>
            </ul>
          </div>

        </div>
        <div class="row app-m-0 ">
          <h4 class="fw-bold oni-color-primary fs-4 mb-4">
            Procédure
          </h4>

          <div class="ms-lg-4">
            <ul class="liste-unstyled">
              <li v-for="(data, index) in processFolder" :key="index" class="mb-3">
                <span class="number-count">{{ index + 1 }}</span>
                <p class="m-0">
                  {{ data.title }}
                </p>
              </li>
            </ul>

          </div>

        </div>
      </div>
      <div class="col-6 center ">
        <div class="row mt-3 app-m-0 app-mt-1">
          <h4 class="fw-bold oni-color-primary fs-4 mb-4">

            Formulaire de demande de passeport
          </h4>
          <p class="fw-light text-start">
            Telecharger , imprimer et remplir au manuscrit le formulaire
          </p>
          <button class="btn btn-lg bg-oni-primary text-light">
            <i class="bi bi-download"></i> TELECHARGER
          </button>

</div>
        
      </div>
    </div>
  </div>

</template>

<script>
export default {
  name: "ProductDocu",
  data() {
    return {
      processFolder: [
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam commodi distinctio molestiae consequatur quisquam perferendis laudantium."},
      ],
      requestFolder: [
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "},
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "},
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "},
        {title: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi architecto qui accusamus, nam repellat aperiam tempore officiis quo cupiditate accusantium eligendi ipsam "},
      ]
    };
  }
};
</script>

<style lang="less" scoped>

.liste-unstyled {
  list-style: none;
  padding: 0;

  li {
    display: flex;
    align-items: self-start;
  }
  p{
    flex: 1;
  }
}

.number-count {
  border-radius: 100%;
  border: 1.5px solid var(--primaryColor);
  font-weight: bold;
  padding: 0px 11px;
  color: var(--primaryColor);
  font-size: 1.5rem;
  margin-right: 7px;
  min-width: 30px;
  min-height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.text-jutify{
  text-align: justify;
}

.center{
margin-left:auto;
margin-right:auto;
}

.mr-8{
  margin-right: 8px;
}
</style>
