<template>

  <div class="container">
      <button @click="searchedHotel()" class="bg-primary">premi</button>
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card-container">
                <div id="map-div"></div>
            </div>
      </div>
        <section id="apartments-slider-section" class="col-5 overflow-auto bg-info">
            <div class="card-container">
                <div class="apartment-card py-5 border-top border-bottom border-primary"
                    :key="'hotel-'+index"
                    v-for="(hotel, index) in hotelArray">
                        <h3 class="text-white">{{hotel.name}}</h3>
                        <h4 class="text-white">{{hotel.address}} - {{hotel.location}} - {{hotel.cap}}</h4>
                        <img :src="hotel.cover_img" :alt="hotel.name" class="w-50 py-3">
                        <h6 class="text-white">price: <span class="text-primary">{{hotel.price}}</span></h6>
                        <h6 class="text-white">bathrooms: {{hotel.n_bathrooms}}</h6>
                        <h6 class="text-white">guests: {{hotel.n_guests}}</h6>
                        <h6 class="text-white">rooms: {{hotel.n_rooms}}</h6>
                        <h6 class="text-white">sizes: {{hotel.size}} mq</h6>

                </div>
            </div>
        </section>
    </div>
  </div>
</template>

<script>

import MegaMenu from 'primevue/megamenu';
import axios from "axios";



export default {
    name: 'Home',
    data() {
        return {
            initialHotelArray : [],
            hotelArray : [],
                  
        }
    },
    components: {
    },

    props : {
      searched : String,
      boolStartSearch : Boolean,   
    },

    methods:{
        
        getAllHotelData(){
            window.axios.get('api/hotel/index', {
                params : {
                    query : this.searched
                }
            }).then(resp => {
                const data = resp.data 
                this.hotelArray = data
                this.initialHotelArray = data

		    })

        },

        searchLocation(hotel){
            return hotel.location.toLowerCase().includes(this.searched.toLowerCase())
        },

        searchedHotel(){

            this.hotelArray = this.initialHotelArray.filter(this.searchLocation)
        }
        
    },
    mounted() {
        this.getAllHotelData()
        const GOLDEN_GATE_BRIDGE = {lng: -122.47483, lat: 37.80776};

        const API_KEY = 'onx0t6tyRKJCe8Q2JIAWTMwu3Opxi7wH';
        const APPLICATION_NAME = 'bookie_sloth';
        const APPLICATION_VERSION = '1.0';

        tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);
        var map = tt.map({
        key: API_KEY,
        container: 'map-div',
        center: GOLDEN_GATE_BRIDGE,
        zoom: 12
        });

        
    },

    computed: {
        boolSearch: function () {
        return this.boolStartSearch
        },

        startSearchHotel: function (){
            if(!this.boolSearch){

               if(this.searched === '') {
                    this.hotelArray = this.initialHotelArray;
                } else {
                    this.searchedHotel()
                } 
               
            }
            

            }
  }
}
</script>

<style lang="scss" scoped>
#map-div{
    height: 400px;
    width: 400px;
}

section#apartments-map-section{
    height: 60vh
}

section#apartments-slider-section{
    height: 60vh
}
</style>
