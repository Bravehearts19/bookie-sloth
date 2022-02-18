<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card-container">
                <div id="map-div"></div>
                <div class="apartment-card py-5 border-top border-bottom border-primary"
                    :key="'hotel-'+index"
                    v-for="(hotel, index) in hotelArray.data">
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
      </div>
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
            hotelArray : []
        }
    },
    components: {
    },
    methods:{
        async getHotelData(){
            const {data} = await axios.get('api/hotel/index');
            this.hotelArray = data
            console.log(data)
        }
    },
    mounted() {
        this.getHotelData()
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
    }
}
</script>

<style lang="scss" scoped>
#map-div{
    height: 400px;
    width: 400px;
}
</style>
