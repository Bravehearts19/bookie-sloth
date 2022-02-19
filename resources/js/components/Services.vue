<template>
  <div>
      <form action="">

      
        <ul class='list-unstyled d-flex justify-content-around '>
            <li v-for='(service,index) in services ' :key='"service-"+index' class="m-1 d-flex">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <h3>{{service.name}}</h3> 
                <lord-icon
                        :src="service.icon"
                        trigger="loop-on-hover"
                        style="width:50px;height:50px">
                </lord-icon>
            </li>
        </ul>
      </form>
  </div>
</template>

<script>
export default {
    name: 'Services',
    data(){
        return{
            services : []
        }
    },
    async mounted (){
        const {data} = await window.axios.get('/api/services/index')
        this.services = data
    }

}
</script>

<style>

</style>