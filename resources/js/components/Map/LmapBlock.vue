<template>
    <l-map ref="map" class="map" :zoom="zoom" :center="center" :attributionControl="false" :scrollWheelZoom="false">
        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
        <l-control-zoom position="bottomright"></l-control-zoom>
    </l-map>
</template>

<script>
    import {mapGetters} from "vuex";
    import L from "leaflet";
    import {LMap, LTileLayer, LMarker, LControlZoom} from "vue2-leaflet";
    //scrollWheelZoom.enable()

    export default {
        name: "LmapBlock",
        data() {
            return {
                mapMarker: [],
                searchMarker: null
            };
        },
        props: ["firms"],
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LControlZoom
        },
        computed: {
            ...mapGetters({
                zoom: "map/zoom",
                center: "map/center",
                search_latlng: "map/search_latlng",
                search_address: "map/search_address",
                user_position: "map/user_position",
                radius: "map/radius",
            }),

        },
        watch: {
            search_latlng(val) {
                if (val.lat === 0) {
                    this.removeMarker();
                    this.findBestZoom();
                } else {
                    this.addMarkerSearch();
                }
            },
            firms(newVal) {
                this.addMarker();
                this.findBestZoom();
            },
            user_position(){
                if(this.user_position.lat!==null&&this.user_position.lng!==null){
                    L.marker(this.user_position).addTo(this.$refs.map.mapObject)
                        .bindPopup("Вы находитесь в нескольких метрах от этой точки").openPopup();
                    // L.circle(this.user_position, this.radius).addTo(this.$refs.map.mapObject);
                    this.$refs.map.mapObject.setView(this.user_position, 13, { "animate": false})
                }
            }
        },
        mounted() {
            let app = this;
            this.$refs.map.mapObject.on('click', function (e) {
                app.$store.commit('map/MAPSHOWHIDDENSIDEBAR')
            });

        },
        methods: {
            addMarker() {
                this.mapMarker = [];
                let app = this;
                for (let index = 0; index < this.firms.length; index++) {
                    const firm = this.firms[index];
                    let lat = firm.latlng.lat;
                    let lng = firm.latlng.lng;
                    let marker = L.marker([lat, lng], {
                        title: firm.title,
                        alt: firm.address,
                        id: firm.id
                    });
                    marker.bindPopup('<p class="text-center"><strong>' + firm.title + '</strong></p><p>' + firm.address + '</p>');
                    marker.on('mouseover', function (e) {
                        this.openPopup()
                    })
                    marker.on('mouseout', function (e) {
                        this.closePopup()
                    })
                    marker.on("click", function (e) {
                        app.$router.push({name: 'object', params: {id: e.target.options.id}})
                    });
                    marker.addTo(this.$refs.map.mapObject);
                    this.mapMarker.push(marker);
                }
            },
            addMarkerSearch() {
                this.searchMarker = L.marker([this.search_latlng.lat, this.search_latlng.lng], {
                    title: this.search_address,
                });
                this.searchMarker.addTo(this.$refs.map.mapObject);
                this.$refs.map.mapObject.setView([this.search_latlng.lat, this.search_latlng.lng], 15, {
                    "animate": false,
                    "pan": {
                        "duration": 10
                    }
                })

            },
            removeMarker() {
                this.$refs.map.mapObject.removeLayer(this.searchMarker);
                this.searchMarker = null;
            },
            findBestZoom() {
                if (this.mapMarker.length > 0) {
                    var featureGroup = L.featureGroup(this.mapMarker);
                    this.$refs.map.mapObject.fitBounds(featureGroup.getBounds().pad(0.5), {
                        animate: false
                    });
                }
            },
            /*
            onLocationFound(e) {
                console.log(333333333)
                var radius = e.accuracy;
                L.marker(e.latlng).addTo(this.$refs.map.mapObject)
                    .bindPopup("You are within " + radius + " meters from this point").openPopup();
                L.circle(e.latlng, radius).addTo(this.$refs.map.mapObject);
            },
            onLocationError(e) {
                console.log(2222222)
                this.showShwal('warning',e.message)
            }
             */

        }
    };
</script>

