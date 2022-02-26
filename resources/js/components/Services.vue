<template>
  <div>
    <form action="">
    <h3 class="ms-4"><strong>Servizi :</strong></h3>
      <ul class="list-unstyled d-flex flex-wrap justify-content-around my-row m-auto bg-secondary">
        <li
          v-for="(service, index) in services"
          :key="'service-' + index"
          class="d-flex align-items-center single-service"
        >
          <input
            class="form-check-input"
            type="checkbox"
            @click="selectService(service.id)"
            id="flexCheckDefault"
          />
          <h3 class="mb-0 ps-2 service_title">
            {{ capitalizeFirstLetter(service.name) }}
          </h3>
          <lord-icon
            :src="service.icon"
            trigger="loop-on-hover"
            style="width: 50px; height: 50px"
          >
          </lord-icon>
        </li>
      </ul>
    </form>
  </div>
</template>
<script>
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







