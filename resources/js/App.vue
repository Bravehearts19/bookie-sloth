<template>
    <div id="vue-root" class="d-flex flex-column">
        <!-- HEADER -->
        <Header @location="setLocationName" @radius="setRadius"></Header>
        <div class="flex-grow-1 bg-white">
            <router-view :locationName="locationName"></router-view>
        </div>

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
        
        setRadius(val){
            this.radius = val
        }        
    }

}
</script>

<style lang="scss">
#vue-root{
    height: 100vh
}

</style>
