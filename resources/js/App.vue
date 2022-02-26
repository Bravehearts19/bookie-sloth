<template>
    <div id="vue-root">
        <!-- HEADER -->
        <Header @location="setLocationName" @radius="radius"></Header>
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
            radius : 20,
            
        }
    },
    methods:{
        setLocationName(event){
            /* console.log('------settingname-----')
            console.log('locationName: ')
            console.log(event) */
            this.locationName = event
        },
        
        
    }
    
}
</script>

<style lang="scss">
</style>
