<template>
    <div class="hotel_container bg-info">
        <!-- Inizio loading screen -->    
        <!-- SCHERMATA DI CARICAMENTO DA SCOMMENTARE QUANDO SARA' FINITO IL LAYOUT DELLA HOME -->
        <div class="loading-screen d-flex justify-content-center align-items-center" :style="loadingScreen.hideLoading===true ? 'opacity:0; transition:opacity 0.3s' : ''" :class="loadingScreen.deleteLoading===true ? 'd-none' : ''">
            <div class="d-flex flex-column align-items-center" :style="loadingScreen.pageLoaded===true ? 'animation-name:loaded; animation-duration:2s; animation-fill-mode: forwards;' : ''">
                <img src="/images/logo-lime.svg" alt="slothel-logo" class="mb-3">
                <div class="d-flex" :style="loadingScreen.pageLoaded===true ? 'animation-name:bring-right; animation-duration:0.3s; animation-fill-mode: forwards;' : ''">
                    <h2 class="text-white me-3" :style="loadingScreen.pageLoaded===true ? 'animation-name:join-right; animation-duration:2s; animation-fill-mode: forwards;' : ''">Sloth</h2>
                    <h2 class="text-white ms-3 d-flex" :style="loadingScreen.pageLoaded===true ? 'animation-name:join-left; animation-duration:2s; animation-fill-mode: forwards;' : ''">h
                        <span :style="loadingScreen.pageLoaded===true ? 'opacity:0' : ''">ot</span>
                        <div :style="loadingScreen.pageLoaded===true ? 'animation-name:join-left; animation-duration:2s; animation-fill-mode: forwards;' : ''">el</div>
                    </h2>
                </div>
                <div class="spinner-border text-primary mt-3" role="status" :style="loadingScreen.pageLoaded===true ? 'opacity:0' : ''">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <!-- Fine loading screen -->

        <div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3" :style="loadingScreen.hideLoading===false ? 'display:none' : ''">
                <div class="col py-3" :key="'hotel-'+index" v-for="(hotel, index) in hotelArray">
                    <div class="card_container bg-primary shadow-lg">

                        <div class="d-flex flex-column align-items-center pt-3 w-50">
                            <div class="image-container shadow-lg">
                                <img :src="hotel.cover_img.includes('http') ? hotel.cover_img :`/storage/${hotel.cover_img}`" :alt="hotel.name">
                            </div>
                            <router-link :to="{name : 'apartment', params : { id :hotel.apartment_id} }" class="btn btn-secondary btn_router_link text-primary w-50 mt-3 mx-auto">Discover</router-link>
                        </div>

                        <div class="d-flex flex-column align-items-center w-50">loadingScreen.
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
            <Paginator
                :rows="12"
                :totalRecords="getRecordsCount*12"
                @page="onPage($event)"
                class="bg-secondary text-primary mt-5 shadow-lg rounded"
                v-if="activeLocation === 'index'"
            ></Paginator>
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
    props : { locationName : String },
    components: { Paginator },
    data() {
        return {
            hotelArray : [],
            activePage : 1,
            PAGINATION_OFFSET: 5,
            activeLocation : 'unset',

            loadingScreen :{
                pageLoaded: false,
                hideLoading:false,
                deleteLoading:false
            }
            
        }
    },

    computed:{
        getRecordsCount(){
            return this.hotelArray.length
        },
    },
    methods:{
        
        onPage(event) {

            this.activePage = event.page
            console.log(event.page)
            console.log(event.first)
            console.log(event.rows)
            console.log(event.pageCount)
        }
    },
    mounted() {
        this.activeLocation = 'index'
    },
    watch:{
        activeLocation: async function(val, old){
            if(val==='index'){
                try{
                    const {data} = await axios.get('http://localhost:8000/api/hotel/index?page=' + this.activePage)
                    console.dir(data.data);
                    console.log('got index data')
                    this.hotelArray = data.data

                    this.loadingScreen.pageLoaded= true;
                    setTimeout(()=>{
                        this.loadingScreen.hideLoading = true;
                    }, 3000)

                    setTimeout(()=>{
                        this.loadingScreen.deleteLoading = true;
                    }, 5000)
                }catch(err){
                    console.log('watcher query error' + err)
                }
            }else{
                try{
                    const {data} = await axios.get('http://localhost:8000/api/search/filters?locationName=' + val + '&radius=%2020&rooms=1&beds=1')
                    console.dir(data);
                    console.log('got search data')
                    this.hotelArray = data
                }catch(err){
                    console.log('watcher query error' + err)
                }
            }
        },
        locationName: function(val, old) {

            if(val === ''){
                val = 'milano'
            }

            switch (val) {
            case '':
                val = 'milano'
                    break;
            case 'roma':
                val = 'rome'
                break;
            case 'firenze':
                val = 'florence'
                break;
            case 'torino':
                val = 'turin'
                break;
            case 'napoli':
                val = 'naples'
                break;
            }

            this.activeLocation = val
        },
        activePage: async function(val, old){
            try{
                const {data} = await axios.get('http://localhost:8000/api/hotel/index?page=' + this.activePage)
                this.hotelArray = data.data
            }catch(err){
                console.log(err)
            }
        }

    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';

::v-deep .p-paginator .p-paginator-pages .p-paginator-page.p-highlight {
    background: #c7ef00 !important;
    border-color: #c7ef00 !important;
    color: #495057;
}

::v-deep .p-paginator .p-paginator-pages .p-paginator-page:not(.p-highlight):hover {    
    background: $lime !important; 
    border-color: transparent;
    color: #495057;
}

.p-link:focus {
    box-shadow: 0;
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
