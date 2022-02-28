<template>
<div class="container-fluid bg-secondary py-3">
    <div class="row">
        <div class="col-12">
            <Services @services="setServicesArray"></Services>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center border-bottom border-primary pb-5">
                <div class="d-flex justify-content-center align-items-center py-3 bg-primary filters-container mt-5 w-fit-content px-5 shadow-lg">
                    <div class="d-flex align-items-center mx-3">
                        <h4 class="ms-2"><strong>Raggio:</strong></h4>
                        <Knob v-model="radius" :min="0" :max="20" valueColor="#4d1803" textColor="1" :size="75" class="ps-2"/>
                    </div>

                    <div class="ms-5 filter_slider">
                        <h4 ><strong>Stanze :</strong> {{ roomsValue }}</h4>
                        <Slider v-model="roomsValue" />
                    </div>

                    <div class="ms-5 filter_slider">
                        <h4><strong>Letti : </strong>{{ bedValue }}</h4>
                        <Slider v-model="bedValue" />
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Inizio container degli hotel -->
    <div class="">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 " :style="hideLoading===false ? 'display:none' : ''">

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

import Knob from "primevue/knob";
import axios from "axios";
import Paginator from 'primevue/paginator';
import Services from "../components/Services.vue";
import Slider from 'primevue/slider';


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
            servicesQueryString: '',
            paginationVisibility: false
        }
    },
    props : {
        locationName : String,
    },
    components: {
        Paginator, Knob, Services, Slider,
    },
    methods:{
        async getHotelData(page){
            if(!page)
                page = 1
            this.activePage = page
            const {data} = await axios.get('api/hotel/index?page=' + page);
            this.hotelArray = data.data
            this.paginationVisibility = true
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

::v-deep .p-slider
    .p-slider-handle {
        height: 1.143rem;
        width: 1.143rem;
        background: #ffffff;
        border: 2px solid #4d1803 !important;
        border-radius: 50%;
        transition: background-color 0.2s, color 0.2s, border-color 0.2s, box-shadow 0.2s;
        &::hover{
            background-color: #4d1803 !important
        }

}

.my_container{
    border-radius: 50px;
    margin:0 50px 20px 50px;

    .filter_slider{
        min-width: 140px;


    }

}

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
