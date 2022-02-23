<template>
    <div class="my-container">
        <div class="img-container"><img :src="apartment.cover_img" :alt="apartment.name"></div>
        
        
        <div class="data-container">
            <h1 class="pt-1 m-0 text-secondary">{{ apartment.name }}</h1>

            <div class=" pb-1">
                <h5 class="d-inline text-secondary">{{ apartment.address}}</h5>
                <h5 class="d-inline text-secondary">,{{ apartment.location}}</h5>
            </div>

            <Rating class="pb-3 " v-model="stars" :cancel="false" />

            <Calendar v-model="dates" class="pb-3" dateFormat="dd/mm/yy"  :showIcon='true' selectionMode="range" inputStyle="background-color: #A2BA02;border-radius:10px" />

            <div class="services-container p-3">
                <!-- ICONE SERVIZI -->
                
                    <div v-for='service in apartment.services' :key="'service-'+service.id" class="px-1">
                        <lord-icon 
                            :src="service.icon"
                            trigger="hover"
                            colors="primary:#B2CC03,secondary:#B2CC03"
                            style="width:45px;height:45px;background-color:#4d1803;border-radius:50px;align-content: space-around;"
                            >
                        </lord-icon>
                    </div>
                
            </div>
           
           <!-- ROW PEOPLE AND PRICE -->
            <div class="d-flex mt-4 justify-content-between align-items-center">     
                <div class="d-flex align-items-center">
                    <lord-icon  @click="decrementCounter()"
                        src="https://cdn.lordicon.com/rivoakkk.json"
                        trigger="hover"
                        :colors='peopleCounter === 1 ? "primary:#A2BA02,secondary:#4d1803" : "primary:#4d1803,secondary:#4d1803"'
                        stroke="150"
                        style="width:50px;height:50px">
                    </lord-icon>

                    <h2 class="mx-4 my-0">{{ peopleCounter }}</h2>
                    
                    <lord-icon  @click="incrementCounter()"
                        src="https://cdn.lordicon.com/mecwbjnp.json"
                        trigger="hover"
                        colors="primary:#4d1803,secondary:#4d1803"
                        stroke="150"
                        style="width:50px;height:50px">
                    </lord-icon>
                </div>

                <h2 class="me-4 text-secondary">{{ apartment.price }}0$</h2>
            </div>

            <div class="user-container">
               <div class="d-flex align-items-center">
                    <lord-icon 
                        src="https://cdn.lordicon.com/dxjqoygy.json"
                        trigger="hover"
                        colors="primary:#c7ef00,secondary:#c7ef00"
                        style="width:40px;height:40px">
                    </lord-icon>
                    <h6 class="text-primary m-0">{{ apartment.user.name }} {{ apartment.user.surname }}</h6>
                </div>

                <Button label="Contatta" @click="openPosition('right')" class="p-button-warning p-button-sm" />
                
            </div> 

        </div>

        <Dialog header="Conttatami" :visible.sync="displayPosition" :containerStyle="{width: '50vw'}" :position="position" :modal="true">
            <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <template #footer>
                <Button label="No" icon="pi pi-times" @click="closePosition" class="p-button-text"/>
                <Button label="Yes" icon="pi pi-check" @click="closePosition" autofocus />
            </template>
        </Dialog>
        
        <!-- <h1 class="text-secondary text-center">
            {{ apartment.name }}
        </h1>
        <div class="d-flex justify-content-around">
            <div class="img_container">
                <img :src="apartment.cover_img" alt="">
            </div>
            <div id="map-div"></div>
        </div> -->
    </div>
</template>
<script>
import Rating from 'primevue/rating';
import Calendar from 'primevue/calendar';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';

export default {
    name: 'Apartment',
    data() {
        return {
            apartment: '',
            stars : '',
            dates : "",
            peopleCounter: 1,
            displayPosition: false, //PRIME VUE DIALOG 
            position: 'center', //PRIME VUE DIALOG 
        }
    },

    components:{
        Rating,Calendar,Button,Dialog,
    },

    methods:{
        decrementCounter(){
            if(this.peopleCounter === 1 ){
                return
            }else{

                this.peopleCounter--
            }
        },

        incrementCounter(){
            this.peopleCounter++
        },

         openPosition(position) {
            this.position = position;
            this.displayPosition = true;
        },
        closePosition() {
            this.displayPosition = false;
        }
    },

    mounted(){
        axios.get(`/api/hotel/` + this.$route.params.id)
        .then((resp) => {
            console.log(resp.data);
            this.apartment = resp.data[this.$route.params.id - 1]; /* la resp.data ritorna un oggetto con chiave id dell'oggetto -1 */
            const HOTEL_COORDINATES = {lng: this.apartment.x_coordinate, lat: this.apartment.y_coordinate};

            const API_KEY = 'on35t6tyRKJCe8Q2JIAWTMwu3Opxi7wH';
            const APPLICATION_NAME = 'bookie_sloth';
            const APPLICATION_VERSION = '1.0';
            tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);
            var map = tt.map({
            key: API_KEY,
            container: 'map-div',
            center: HOTEL_COORDINATES,
            zoom: 18
            });
        })
    }
}
</script>
<style lang="scss" scoped>


.my-container{
    background-color: #B5D601;
    height: 550px;
    width: 1400px;
    margin: auto;
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;

    .img-container{
        height: 520px;
        width: 800px;
        /* margin-left: 15px; */
        border-radius: 25px;
        overflow: hidden;

        img{
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    }

    .data-container{
        height: 520px;
        width: 550px;
        display: flex;
        flex-direction: column;
        align-content: center;
        /* background-color: red; */

        

        .p-calendar{
           max-width: 300px;
               
           .p-button-icon{

               background-color: #B2CC03;
           }
        }

        .services-container{
            display: flex;
            background-color: #A2BA02;
            height: 150px;
            width: 300px;
            margin: 10px 0;
            border-radius: 20px;
            flex-wrap: wrap;
            justify-content: flex-start;
            
        }

        .user-container{
            background-color: #4D1803;
            margin-top: 35px;
            border-radius: 30px;
            display: flex;
            justify-content: center;
            height: 50px;

            .p-button{
                background-color: #B2CC03; 
                border: #B2CC03;
                border-radius: 20px;
                height: 30px !important;
                margin-top: 8px;
                margin-left: 20px;
            }
        }
    }
}

        



/* #map-div{
    height: 400px;
    width: 400px;
}
.img_container {
    aspect-ratio: 1/1;
    img {
        width: 100%;
        height: 100%;
    }
} */


</style>