<template>
    <div class="error_container d-flex align-items-center">
        <div class="d-flex flex-column justify-content-center align-items-center w-50 flex_grow_0 flex_shrink_0">
            <h1 class="text-primary"><strong>Error 404</strong></h1>
            <div class="image_container"> 
                <img src="https://c.tenor.com/PWjgUp98zaEAAAAM/sloth-zootopia.gif" class="w-100 h-100" alt="">
            </div>
        </div>
        <div class="flex_grow_0 flex_shrink_0 w-50">
            <h2 class="text-primary text-center"><strong>Sorry</strong></h2>
            <h2 class="text-primary text-center">We can't find the page <br> you're looking for...</h2>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Error404',
}
</script>

<style lang="scss" scoped>
.error_container {
    overflow: hidden;
    h1 {
        font-size: 122px;
    }
    .image_container {
        margin-right: -30px;
        width: 60%;
        border-radius: 50%;
        overflow: hidden;
    }
    .flex_grow_0 {
        flex-grow: 0;
    }
    .flex_shrink_0 {
        flex-shrink: 0;
    }
    h2 {
        font-size: 54px;
        strong {
            font-size: 80px;
        }
    }
}
</style>>
