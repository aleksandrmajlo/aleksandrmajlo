<template>
    <div class="mapOver" v-if="mapname=='OpenStreet'">
        <lmap-block></lmap-block>
    </div>
    <!--
    <div class="mapOver" v-else-if="mapname=='Yandex'">
        <yandex-block></yandex-block>
    </div>
    <div class="mapOver" v-else-if="mapname=='Google'">
        <google-block></google-block>
    </div>
    -->
</template>

<script>
    // import YandexBlock from "./YandexBlock";
    // import GoogleBlock from "./GoogleBlock";
    import LmapBlock from "./LmapBlock";
    import {mapGetters} from "vuex";

    export default {
        name: "MapBlock",
        components: {
            LmapBlock,
            // YandexBlock,
            // GoogleBlock
        },
        computed: {
            ...mapGetters({
                mapname: "map/mapname",
            })
        },
        created() {
            this.$store.dispatch('map/Geolocation')
        }
    };
</script>


