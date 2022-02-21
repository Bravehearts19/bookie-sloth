<template>
  <div>
    <form action="">
    <h2>Servizi</h2>
      <ul class="list-unstyled d-flex justify-content-around">
        <li
          v-for="(service, index) in services"
          :key="'service-' + index"
          class="m-1 d-flex align-items-center"
        >
          <input
            class="form-check-input"
            type="checkbox"
            @click="selectService(index + 1)"
            id="flexCheckDefault"
          />
          <h3 class="mb-0">
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
    selectService(i){
      if(this.selectedServices.includes(i)){
        this.selectedServices.pop(i)
      }
      else{
        this.selectedServices.push(i)
      }
      this.$emit('services' , this.selectedServices);
    }
  },
};
</script>
<style>
</style>







