<template>
<div>
    <div class="bg-primary py-3">
      <Services @services="setServicesArray"></Services>
      <div class="d-flex justify-content-center">
        <h2>Raggio</h2>
          <Knob v-model="radius" :min="0" :max="50" valueColor="Green" />
        <h2>Stanze</h2>
          <Knob v-model="roomsValue" :min="0" :max="100" valueColor="Green" />
          <h2>Letti</h2>
          <Knob v-model="bedValue" :min="0" :max="100" valueColor="Green" />
      </div>
    </div>
  <div class="container h-100">
    <div class="row  h-100 align-items-center">
        <!--<section id="apartments-map-section" class="col-6 bg-primary">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div id="map-div"></div>
            </div>
        </section>-->
        <!-- Layout di lori -->
        <section id="apartments-slider-section" class="col overflow-auto bg-info mt-5">
            <div class="card-container">
                <div class="apartment-card py-5 border-top border-bottom border-primary d-flex flex-column justify-content-center"
                    :key="'hotel-'+index"
                    v-for="(hotel, index) in hotelArray">
                        <div class="apartment-card-header bg-secondary py-3 rounded shadow-lg">
                            <h1 class="text-white text-center mb-0">{{hotel.name}}</h1>
                            <h4 class="text-white text-center mb-0">{{hotel.address}} - {{hotel.location}} - {{hotel.cap}}</h4>
                        </div>
                        <div class="image-container p-3 mt-5 bg-primary border border-secondary my-3 mx-auto w-50 rounded shadow-lg">
                            <img :src="hotel.cover_img" :alt="hotel.name" class="w-100 py-3">
                        </div>
                        <router-link :to="`apartment/${hotel.id}`" class="btn btn-secondary mt-5 w-25 mx-auto">Discover</router-link>
                        <div class="d-flex justify-content-around flex-wrap mt-5 py-3 border-top border-secondary bg-primary rounded shadow-lg">
                            <h6 class="text-secondary mb-0">Prezzo: <span class="text-secondary">€{{hotel.price}}</span></h6>
                            <h6 class="text-secondary mb-0">Bagni: {{hotel.n_bathrooms}}</h6>
                            <h6 class="text-secondary mb-0">Letti: {{hotel.n_guests}}</h6>
                            <h6 class="text-secondary mb-0">Stanze: {{hotel.n_rooms}}</h6>
                            <h6 class="text-secondary mb-0">Dimensioni: {{hotel.size}} mq</h6>
                        </div>
                        <ul>
                            <li v-for="service in hotel.services">{{service.name}}</li>
                        </ul>
                </div>
                <ul class="pagination overflow-auto">
                    <li class="page-item"
                        :class="(index === activePage) ? 'active' : ''"
                        v-for="index in totalPages"
                        :key="'page-'+index">
                        <a href="#" class="page-link"
                           @click="getHotelData(index)">
                            {{index}}
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
  </div>
  </div>
</template>
<script>
import Knob from "primevue/knob";
import axios from "axios";
import Paginator from 'primevue/paginator';
import Services from "../components/Services.vue";
export default {
    name: 'Home',
    data() {
        return {
            hotelArray : [],
            totalPages : undefined,
            activePage : 1,
            PAGINATION_OFFSET: 5,
            radius: 20,
            roomsValue: 1,
            bedValue: 1,
            servicesQueryString: ''
        }
    },
    props : {
        locationName : String,
    },
    components: {
        Paginator, Knob, Services
    },
    methods:{
        async getHotelData(page){
            if(!page)
                page = 1
            this.activePage = page
            const {data} = await axios.get('api/hotel/index?page=' + page);
            this.hotelArray = data.data
            console.log(data)
        },
        async getRecordsCount(){
            const {data} = await axios.get('api/hotel/index');
            console.log(data.last_page)
            this.totalPages = data.last_page
        },

        setServicesArray(arr){
            let queryString = '';
            arr.forEach((el)=>{
                queryString += "&services[]=" + el
            })
            this.servicesQueryString = queryString
        }
    },
    updated(){
        console.log('-------MOUNT HOME-------')
        console.log('location:' + this.locationName + 'radius:' + this.radius)
    },
    mounted() {
        this.getRecordsCount();
        this.getHotelData()
        console.log(this.totalPages)
    },
    watch:{
        locationName: async function(val, old) {
            console.log('http://localhost:8000/api/search/filters?locationName=' + val + '&radius=20')
            const {data} = await axios.get('http://localhost:8000/api/search/filters?locationName=' + val + '&radius=' + this.radius + "&rooms=" + this.roomsValue + "&beds=" + this.bedValue + this.servicesQueryString)
            console.log('------new filtered data-------')
            console.dir(data)
            this.hotelArray = data
            console.dir(this.hotelArray)
            this.totalPages = data.length
        }
    }
}
</script>
<style lang="scss" scoped>
</style>