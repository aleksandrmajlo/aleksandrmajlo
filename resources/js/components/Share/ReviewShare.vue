<template>
    <div class="row">
        <a class="d-flex align-items-center col-auto h6 text-primary fw-300 tdn" href="#">
            {{$t('like_review')}}
            <img class="ml-2" src="/img/svg/like-4.svg" alt=""/>
        </a>
        <a class="d-flex align-items-center col-auto h6 text-primary fw-300 tdn" href="#">
            <img class="ml-2" src="/img/svg/Share-4.svg" alt=""/>
        </a>
    </div>
</template>

<script>
    export default {
        name: "ReviewShare",
        props:{
            review:{
                type:Object
            }
        }
    }
</script>

<style scoped>

</style>
