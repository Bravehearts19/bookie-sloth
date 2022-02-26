<template>
    <div class="hotel_container bg-info">
        <!-- Inizio loading screen -->     <!-- SCHERMATA DI CARICAMENTO DA SCOMMENTARE QUANDO SARA' FINITO IL LAYOUT DELLA HOME -->
        <div class="loading-screen d-flex justify-content-center align-items-center" :style="hideLoading===true ? 'opacity:0; transition:opacity 0.3s' : ''" :class="deleteLoading===true ? 'd-none' : ''">
            <div class="d-flex flex-column align-items-center" :style="pageLoaded===true ? 'animation-name:loaded; animation-duration:2s; animation-fill-mode: forwards;' : ''">
                <img src="/images/logo-lime.svg" alt="slothel-logo" class="mb-3">
                <div class="d-flex" :style="pageLoaded===true ? 'animation-name:bring-right; animation-duration:0.3s; animation-fill-mode: forwards;' : ''">
                    <h2 class="text-white me-3" :style="pageLoaded===true ? 'animation-name:join-right; animation-duration:2s; animation-fill-mode: forwards;' : ''">Sloth</h2>
                    <h2 class="text-white ms-3 d-flex" :style="pageLoaded===true ? 'animation-name:join-left; animation-duration:2s; animation-fill-mode: forwards;' : ''">h
                        <span :style="pageLoaded===true ? 'opacity:0' : ''">ot</span>
                        <div :style="pageLoaded===true ? 'animation-name:join-left; animation-duration:2s; animation-fill-mode: forwards;' : ''">el</div>
                    </h2>
                </div>
                <div class="spinner-border text-primary mt-3" role="status" :style="pageLoaded===true ? 'opacity:0' : ''">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <!-- Fine loading screen -->

        <!-- Inizio container degli hotel -->
        <div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 " :style="hideLoading===false ? 'display:none' : ''">
                <div class="col py-3" :key="'hotel-'+index" v-for="(hotel, index) in hotelArray">
                    <div class="card_container bg-primary shadow-lg">
                        
                        <div class="d-flex flex-column align-items-center pt-3 w-50">
                            <div class="image-container shadow-lg">
                                <img :src="hotel.cover_img.includes('http') ? hotel.cover_img :`/storage/${hotel.cover_img}`" :alt="hotel.name">
                            </div>
                            <router-link :to="{name : 'apartment', params : { id :hotel.id} }" class="btn btn-secondary btn_router_link text-primary w-50 mt-3 mx-auto">Discover</router-link>
                        </div>

                        <div class="d-flex flex-column align-items-center w-50">
                            <div class="py-3">
                                <h5 class="text-secondary text-center mb-0"><strong>{{hotel.name}}</strong></h5>
                                <h5 class="text-secondary text-center mb-0">{{hotel.location}}</h5>
                                <h6 class="text-secondary text-center mb-0">{{hotel.address}} - {{hotel.cap}}</h6>
                            </div>
                            
                            <div class="p-3">
                                <h6 class="text-secondary py-1 mb-0">Prezzo a persona: <strong>{{hotel.price}} €</strong></h6>
                                <h6 class="text-secondary py-1 mb-0">Numero di ospiti: <strong>{{hotel.n_guests}}</strong></h6>
                                <h6 class="text-secondary py-1 mb-0">Numero di stanze: <strong>{{hotel.n_rooms}}</strong></h6>
                                <h6 class="text-secondary py-1 mb-0">Numero di bagni: <strong>{{hotel.n_bathrooms}}</strong></h6>
                                <h6 class="text-secondary py-1 mb-0">Dimensioni: <strong>{{hotel.size}} mq</strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inizio bottoni per la paginazione -->
            <ul class="pagination overflow-auto pt-5" :class='paginationVisibility === false ? "d-none" : ""'>
                <li class="page-item"
                    :class="(index === activePage) ? 'active' : ''"
                    v-for="index in totalPages"
                    :key="'page-'+ index">
                    <a href="#" class="page-link"
                    @click="getHotelData(index)">
                        {{index}}
                    </a>
                </li>
            </ul>
            <!-- Fine bottoni per la paginazione -->
        </div>
        <!-- Fine container degli hotel -->
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
            url: '/api/search/filters?',
            pageLoaded: false,
            hideLoading:false,
            deleteLoading:false,
            paginationVisibility : false,
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
            this.hotelArray = data.data;
            setTimeout(()=>{
                this.paginationVisibility = true
            },3000)
            
            this.pageLoaded= true;
            setTimeout(()=>{
                this.hideLoading = true;
            }, 3000)
            setTimeout(()=>{
                this.deleteLoading = true;
            }, 5000)
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
    .btn_router_link {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
}
.card_container {
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 24px;
    height: 300px;
}
.image-container {
    width: 100%;
    border-radius: 20px;
    height: 150px;
    aspect-ratio: 2/1.5;
    img {
        border-radius: 20px;
        width: 100%;
        height: 100%;
        aspect-ratio: 2/1.5;
    }
}
</style>
