<template>
    <div>
        <NavBar v-on:searching="searching" v-on:catchBool='catchBool'></NavBar>
        
        <Home :searched='toSearch' :boolStartSearch='boolStartSearch'></Home>
        

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
          boolStartSearch : ''
        }
    },

    components: {
        NavBar,Home
    },    


    methods : {
        searching(toSearch){
            this.toSearch = toSearch
        },

        catchBool(boolStartSearch){
            this.boolStartSearch = boolStartSearch
        }

    
    },

}
</script>

<style>

</style>
