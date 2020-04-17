<template>
    <div class="footer__col col-auto">
        <a class="footer__link"  @click.prevent="user_position" href="#">
            <img src="/img/svg/geolocation.svg" alt=""/>
        </a>
    </div>
</template>
<script>
    export default {
        name: "GeolocationMy",
        methods:{
            user_position(){
                this.$store.dispatch('map/Geolocation')
            }
        }
    }
</script>

