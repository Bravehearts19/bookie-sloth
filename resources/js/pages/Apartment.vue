<template>
    <div class="my-container">
        <div class="img-container"><img :src="apartment.cover_img" :alt="apartment.name"></div>
        
        
        <div class="data-container">
            <h1 class="pt-1">{{ apartment.name }}</h1>
            <Rating v-model="stars" :cancel="false" />
            <div class="pt-3 pb-3">
                <h6 class="d-inline">{{ apartment.address}}</h6>
                <h6 class="d-inline">,{{ apartment.location}}</h6>
            </div>

            <Calendar v-model="dates" class="pb-3" selectionMode="range" />

            <div class="services-container">
                <p>{{apartment.services[0].id}}</p>
            <!-- <lord-icon
                src="https://cdn.lordicon.com/tkgyrmwc.json"
                trigger="loop"
                style="width:50px;height:50px">
            </lord-icon> -->
            </div>
           
           <!-- ROW PEOPLE AND PRICE -->
            <div class="d-flex mt-4 justify-content-between align-items-center">     
                <div class="d-flex align-items-center">
                    <lord-icon
                        src="https://cdn.lordicon.com/rivoakkk.json"
                        trigger="hover"
                        colors="primary:#A2BA02,secondary:#4d1803"
                        stroke="150"
                        style="width:50px;height:50px">
                    </lord-icon>

                    <h2 class="mx-4 my-0">1</h2>
                    
                    <lord-icon
                        src="https://cdn.lordicon.com/mecwbjnp.json"
                        trigger="hover"
                        colors="primary:#A2BA02,secondary:#4d1803"
                        stroke="150"
                        style="width:50px;height:50px">
                    </lord-icon>
                </div>

                <h2 class="me-4">{{ apartment.price }}0$</h2>
            </div>

            <div class="user-container">
               <div class="d-flex align-items-center">
                    <lord-icon
                        src="https://cdn.lordicon.com/dxjqoygy.json"
                        trigger="hover"
                        colors="primary:#c7ef00,secondary:#c7ef00"
                        style="width:35px;height:35px">
                    </lord-icon>
                    <h6 class="text-primary m-0">{{ apartment.user.name }} {{ apartment.user.surname }}</h6>
                </div>

                
            </div> 

        </div>
        
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

export default {
    name: 'Apartment',
    data() {
        return {
            apartment: '',
            stars : '',
            dates : "",
        }
    },

    components:{
        Rating,Calendar,Button,
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

        .services-container{
            display: flex;
            background-color: #A2BA02;
            height: 150px;
            width: 300px;
            margin: 10px 0;
            border-radius: 20px;
        }

        .user-container{
            background-color: #4D1803;
            border-radius: 20px;
            display: flex;
            /* justify-content: space-between; */
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