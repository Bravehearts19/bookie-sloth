<template>
    <div>
        <h1 class="text-primary text-center">
            {{ apartment.name }}
        </h1>
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
            console.log(resp.data);
            this.apartment = resp.data[this.$route.params.id - 1]; /* la resp.data ritorna un oggetto con chiave id dell'oggetto -1 */
        })
    }
}
</script>

<style>

</style>