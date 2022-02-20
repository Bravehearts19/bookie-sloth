<template>
  <div class="container h-100">
    <div class="row h-100 align-items-center">
        <!--<section id="apartments-map-section" class="col-6 bg-primary">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div id="map-div"></div>
            </div>
        </section>-->
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
                        <button class="btn btn-secondary mt-5 w-25 mx-auto">Discover</button>
                        <div class="d-flex justify-content-around flex-wrap mt-5 py-3 border-top border-secondary bg-primary rounded shadow-lg">
                            <h6 class="text-secondary mb-0">price: <span class="text-primary">{{hotel.price}}</span></h6>
                            <h6 class="text-secondary mb-0">bathrooms: {{hotel.n_bathrooms}}</h6>
                            <h6 class="text-secondary mb-0">guests: {{hotel.n_guests}}</h6>
                            <h6 class="text-secondary mb-0">rooms: {{hotel.n_rooms}}</h6>
                            <h6 class="text-secondary mb-0">sizes: {{hotel.size}} mq</h6>
                        </div>


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
</template>

<script>

import MegaMenu from 'primevue/megamenu';
import axios from "axios";
import Paginator from 'primevue/paginator';

export default {
    name: 'Home',
    data() {
        return {
            hotelArray : [],
            totalPages : undefined,
            activePage : 1,
            PAGINATION_OFFSET: 5
        }
    },
    props : {
        locationName : String,
        radius : Number
    },
    components: {
        Paginator
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
            const {data} = await axios.get('http://localhost:8000/api/search/filters?locationName=' + val + '&radius=20')
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
