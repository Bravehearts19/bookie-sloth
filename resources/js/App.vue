<template>
    <div>
        <NavBar v-on:searching="searching"></NavBar>
        
        <Home :searched='toSearch'></Home>
        

        <!-- FOOTER -->
</template>


<script>

import NavBar from './components/NavBar';
import Home from './pages/Home'

export default {
    name: "App",
    
    data(){
        return {
            
          toSearch : '',  
        }
    },

    components: {
        NavBar,Home
    },    


    methods : {
        searching(toSearch){
            this.toSearch = toSearch
        },

    
    },

}
</script>

<style>

</style>
