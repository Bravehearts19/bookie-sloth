<template>
    <div class="hotel_container bg-info">
        <div class="row row-cols-3">
            <div class="col" :key="'hotel-'+index" v-for="(hotel, index) in hotelArray">
                <div class="card_container">
                    <div class="py-5 d-flex align-items-center">
                        <div class="image-container p-3 mt-5 bg-primary border border-secondary my-3 mx-auto w-50 rounded shadow-lg">
                            <img :src="hotel.cover_img" :alt="hotel.name" class="w-100 py-3">
                        </div>

                        <div class="apartment-card-header bg-secondary py-3 rounded shadow-lg">
                            <h1 class="text-white text-center mb-0">{{hotel.name}}</h1>
                            <h4 class="text-white text-center mb-0">{{hotel.address}} - {{hotel.location}} - {{hotel.cap}}</h4>
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
                </div>
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
        <!-- <div class="row h-100 align-items-center bg-info">
            <div class="col">
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
            </div>
        </div> -->
    </div>
</template>

<script>

import axios from "axios";
import Paginator from 'primevue/paginator';

export default {
    name: 'Home',
    data() {
        return {
            hotelArray : [],
            totalPages : undefined,
            activePage : 1,
            PAGINATION_OFFSET: 5,
            url: '/api/search/filters?'
        }
    },
    props : {
        filters : Object
    },
    computed:{
        getLocationName(){
            return this.filters.location
        },
        getRadius(){
            return this.filters.radius
        },
        getRooms(){
            return this.filters.rooms
        },
        getGuests(){
            return this.filters.guests
        }
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
            /* console.log(data) */
        },
        async getRecordsCount(){
            const {data} = await axios.get('api/hotel/index');
            /* console.log(data.last_page) */
            this.totalPages = data.last_page
        }
    },
    mounted() {
        this.getRecordsCount();
        this.getHotelData()
        /* console.log(this.totalPages) */
    },
    watch:{
        getLocationName: function(val, old) {
            //get url
            let url = this.url

            //find the position of the start of the query
            const queryPosition = url.indexOf('?')

            //truncate params
            url = url.slice(0, queryPosition)

            //set new location name
            url += '?locationName=' + val + '&radius=20'

            //update url
            this.url = url

            console.log('updated location: ' + this.url)
        },
        getRadius: function(val, old) {
            //get url
            let url =  this.url

            //find query concat position
            const concatPosition = url.indexOf('&radius')

            //truncate 2nd param
            url = url.slice(0, concatPosition)

            //set new radius
            url += ('&radius=' + val)

            //update url
            this.url = url
        },
        getRooms: function(val, old) {
            //get url
            let url =  this.url

            //find query concat position
            const concatPosition = url.indexOf('&rooms')

            //truncate 2nd param
            url = url.slice(0, concatPosition)

            //set new radius
            url += ('&rooms=' + val + '&radius=' + this.radius)

            //update url
            this.url = url
        },
        url: async function(val, old) {
            console.log('api endpoint: '+ val)
            const {data} = await axios.get(val)

            this.hotelArray = data
        }

    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';

.hotel_container {
    background-image: url('/images/wood_template.svg');
    background-repeat: repeat;
    background-size: contain;
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-grow: 0;
}
.row {
    gap: 20px;
}
/* .card_container {

} */
</style>
