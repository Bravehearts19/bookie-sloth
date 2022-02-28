<template>
  <div>
    <form action="">
    <h2 class="ms-4 text-white text-center mt-3"><strong>Servizi :</strong></h2>
      <ul class="list-unstyled d-flex flex-wrap justify-content-around my-row m-auto bg-secondary mt-5">
        <li
          v-for="(service, index) in services"
          :key="'service-' + index"
          class="d-flex align-items-center justify-content-around single-service border-left border-right border-bottom border-primary shadow-lg rounded mt-3"
        >
            <input
                class="form-check-input m-0 bg-primary"
                type="checkbox"
                @click="selectService(service.id)"
                id="flexCheckDefault"
            />
            <div class="d-flex align-items-center">
              <lord-icon
                  :src="service.icon"
                  trigger="loop-on-hover"
                  style="width: 50px; height: 50px"
                  colors="primary:#c7ef00,secondary:#ffffff"
              >
              </lord-icon>
              <h3 class="mb-0 text-primary ps-2 service_title">
                  {{ capitalizeFirstLetter(service.name) }}
              </h3>
            </div>
        </li>
      </ul>
    </form>
  </div>
</template>
<script>
import Checkbox from 'primevue/checkbox';

export default {
  name: "Services",
  data() {
    return {
      services: [],
      selectedServices: []
    };
  },
  async mounted() {
    const { data } = await window.axios.get("/api/services/index");
    this.services = data;
  },
  methods: {
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },
   selectService(id){
      if(this.selectedServices.includes(id)){
        const indexOfService = this.selectedServices.indexOf(id);
        this.selectedServices.splice(indexOfService, 1)
      }
      else{
        this.selectedServices.push(id)
      }
      this.$emit('services' , this.selectedServices);
    }
  },
};
</script>
<style lang='scss' scoped>
  .my-row{
    width: 100%;


    .single-service{
      width: calc((100% / 5) - 40px);

      .service_title{
        min-width: 120px;
      }
    }
  }

</style>







