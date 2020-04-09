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
                let app=this;
                navigator.geolocation.getCurrentPosition(function (position) {
                        app.$store.commit('map/USERPOSITION',{coords:{lat:position.coords.latitude,lng:position.coords.longitude},radius:position.coords.accuracy})
                    },
                    function (error) {
                        console.log("The Locator was denied. :(")
                    })
            }
        }
    }
</script>

