<template>
    <yandex-map
        :settings="settingsYandex"
        @map-was-initialized="onLoading($event)"
        :controls="controls"
        :coords="center" :zoom="zoom">
    </yandex-map>
</template>

<script>
    import {mapGetters} from "vuex";
    import {yandexMap, ymapMarker} from 'vue-yandex-maps'
    // import {loadYmap} from 'vue-yandex-maps'

    export default {
        name: "YandexBlock",
        data() {
            return {
                myMap: {},
                settingsYandex: {
                    apiKey: '988df137-cebd-4457-8c7e-4925438db283',
                    // lang: 'uk_UA',
                    lang: 'ru_RU',
                    coordorder: 'latlong',
                    version: '2.1'
                },
                controls:[]
            };
        },
        comments: {
            yandexMap,
            ymapMarker,
            // loadYmap
        },
        async mounted() {

        },
        computed: {
            ...mapGetters({
                zoom: "map/zoom",
                center: "map/center",
                mapname: "map/mapname",

            })
        },
        methods: {
            onLoading(map) {
                this.myMap = map;
                /*
                var searchControl = new ymaps.control.SearchControl({
                    options: {
                        float: 'none',
                        position:{top:50,right:20},
                        floatIndex: 100,
                    }
                });
                this.myMap.controls.add(searchControl);
                */

                var zoomControl = new ymaps.control.ZoomControl({
                    options: {
                        size: "small",
                        float: 'none',
                        position: {right: 20, bottom: 50}
                    }
                });
                this.myMap.controls.add(zoomControl);

            }
        }

    }
</script>

<style>
    .ymap-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100% !important;
        height: calc(100% - 2.125rem) !important;
        z-index: -1;
    }
    .ymaps-2-1-76-searchbox,
    .ymaps-2-1-76-searchbox__button-cel,
    .ymaps-2-1-76-searchbox__input-cell {
       z-index: 999999 !important;
    }
</style>
