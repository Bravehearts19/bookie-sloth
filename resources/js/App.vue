<template>
    <div id="vue-root">
        <!-- HEADER -->
        <Header @location="setLocationName" @radius="setRadius"></Header>
        <router-view :locationName="locationName"></router-view>

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
            radius : undefined,
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
    }
    
}
</script>

<style>

</style>
