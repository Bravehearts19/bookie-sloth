<template>
    <div class="container">
        <h1 class="text-primary text-center">
            {{ apartment.name }}
        </h1>
        <div class="d-flex justify-content-around">
            <div class="img_container">
                <img :src="apartment.cover_img" alt="">
            </div>

            <div id="map-div"></div>
        </div>
<!-- 
        <p v-for="">

        </p> -->
    </div>
</template>

<script>
export default {
    name: 'Apartment',
    data() {
        return {
            apartment: '',
        }
    },
    mounted(){
        axios.get(`/api/hotel/` + this.$route.params.id)
        .then((resp) => {
            this.apartment = resp.data[this.$route.params.id - 1]; /* la resp.data ritorna un oggetto con chiave id dell'oggetto -1 */
            console.log(this.apartment);
            const HOTEL_COORDINATES = {lng: this.apartment.x_coordinate, lat: this.apartment.y_coordinate};

            const API_KEY = 'onx0t6tyRKJCe8Q2JIAWTMwu3Opxi7wH';
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

        let here = new URL(window.location.href);
        here.searchParams.append('searchedString', this.searched);
        console.log(here.href);

        let here = new URL(window.location.href);
        here.searchParams.id
    }
}
</script>

<style lang="scss" scoped>
#map-div{
    height: 400px;
    width: 400px;
}

.img_container {
    aspect-ratio: 1/1;
    img {
        width: 100%;
        height: 100%;
    }
}
</style>