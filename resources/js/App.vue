<template>
    <div id="vue-root">
        <!-- HEADER -->
<<<<<<< HEAD
        <Header 
            @location="setLocationName"
            @radius="setRadius"
            @rooms="setRooms">
        </Header>
        <router-view :filters="{ 
            location : locationName,
            radius : radius,
            rooms : rooms
            }">
        </router-view>
=======
        <Header @location="setLocationName" @radius="setRadius"></Header>
        <router-view :locationName="locationName"></router-view>
>>>>>>> d46edf84ba3c737eed43231a84edbb0aa922e903

        <!-- FOOTER -->
    </div>
        
</template>

<script>
import Header from './components/Header.vue'

export default {
    name: "App",
    components:{
        Header
    },
    data(){
        return {
            locationName : undefined,
            radius : 20,
            rooms : 1,
        }
    },
    methods:{
        setLocationName(event){
            console.log('------settingname-----')
            console.log('locationName: ')
            console.log(event)
            this.locationName = event
        },
        setRadius(event){
            console.log('------settingragius-----')
            console.log('radius: ')
            console.log(event)
            this.radius = event
        },
        setRooms(event){
            this.rooms = event
        }
    }
    
}
</script>

<style>

</style>
