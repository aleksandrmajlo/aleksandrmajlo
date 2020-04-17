<template>
    <div>

        <GmapMap
            ref="mapRef"
            class="map"
            :center="{lat:center[0], lng:center[1]}"
            :zoom="zoom"
            :options="{
               zoomControl: true,
               mapTypeControl: false,
               scaleControl: false,
               streetViewControl: false,
               rotateControl: false,
               fullscreenControl: false,
               disableDefaultUI: false
           }"
        >
        </GmapMap>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "GoogleBlock",
        data() {
            return {
                place:null
            };
        },
        computed: {
            ...mapGetters({
                zoom: "map/zoom",
                center: "map/center",

                search: "map/search",
                user_position: "map/user_position",
                radius: "map/radius"
            }),
            currentRouteName() {
                return this.$route.name;
            }
        },
        mounted() {

        }

    }
</script>

<style scoped>

</style>
