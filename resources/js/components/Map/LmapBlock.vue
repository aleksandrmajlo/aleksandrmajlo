<template>
    <div id="map" class="map"></div>
</template>
<script>
    const geolocation_marker = {
        en: 'You are a few meters from this point.',
        ru: 'Вы находитесь в нескольких метрах от этой точки.',
        uk: 'Ви перебуваєте в декількох метрах від цієї точки.',
    };
    import L from "leaflet";
    import {mapGetters} from "vuex";
    import {eventBus} from '~/app';

    const mapsLeer = {
        osm: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osm2: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
        google: 'http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',
    };

    export default {
        name: "LmapBlock",
        data() {
            return {
                map: null,
                firms: null,
                mapMarker: [],
                searchMarker: null,
            };
        },
        computed: {
            ...mapGetters({
                zoom: "map/zoom",
                center: "map/center",

                search: "map/search",
                user_position: "map/user_position",
                locale: "lang/locale",
            }),
            currentRouteName() {
                return this.$route.name;
            }
        },
        watch: {
            search(newVal, oldVal) {
                if (this.search.latlng === null) {
                    this.removeSearchMarker();
                } else {
                    this.removeSearchMarker();
                    this.addMarkerSearch();
                }
            },
            user_position() {
                if (this.user_position.lat !== null && this.user_position.lng !== null) {
                    let marker = L.marker(this.user_position)
                        .addTo(this.map)
                        .bindPopup(geolocation_marker[this.locale])
                        .openPopup();
                    marker.on("mouseover", function (e) {
                        this.openPopup();
                    });
                    marker.on("mouseout", function (e) {
                        this.closePopup();
                    });
                    L.circle(this.user_position, 150).addTo(this.map);
                    this.map.setView(this.user_position, 12, {
                        animate: true
                    });
                }
            }
        },
        mounted() {
            let app = this;
            //**********************
            this.map = L.map("map", {
                attributionControl: false,
                zoomControl: false
            }).setView(this.center, this.zoom);
            L.tileLayer(
                mapsLeer.osm,
                {
                    attribution: ''
                }).addTo(this.map);
            //************************************
            L.control
                .zoom({
                    position: "bottomright"
                })
                .addTo(this.map);
            this.$store.dispatch("firms/getGoordFirms").then(() => {
                this.firms = this.$store.getters["firms/coord_firms"];
                this.addMarker();
            });
            this.map.on("click", function (e) {
                app.$store.commit("map/ROUTERSHOWHIDDENSIDEBAR", false);
            });

            this.map.on('zoomend', function (e) {
                let currZoom = app.map.getZoom();
                if(currZoom>10){
                    $('body').removeClass('MarkerHidden')
                }else{
                    $('body').addClass('MarkerHidden')
                }
                console.log(currZoom)
            });

        },
        methods: {
            addMarker() {
                this.mapMarker = [];
                let app = this;
                for (let key in this.firms) {
                    let coord = [];
                    let title = "";
                    let address = "";
                    let firms = this.firms[key];
                    let ids = [];
                    let len = firms.length;
                    for (let index = 0; index < len; index++) {
                        const element = firms[index];
                        if (index === 0) {
                            address = element.address;
                            coord = element.coord;
                        }
                        let koma = " ";
                        if (index !== (len - 1)) koma = ", ";
                        title +=
                            '<a class="setObject" data-key="' +
                            key +
                            '" data-id="' +
                            element.id +
                            '" href="#">' +
                            element.title +
                            "</a>" + koma;
                        ids.push(element.id);
                    }
                    let marker = L.marker(coord, {
                        title: address,
                        alt: address,
                        ids: ids.join()
                    });
                    marker.bindPopup(
                        '<strong>' +
                        title +
                        "</strong><p>" +
                        address +
                        "</p>"
                    );
                    marker.addTo(app.map);
                    marker.on("click", function (e) {
                        let ids = e.target.options.ids;
                        let ob_ids = ids.split(",");
                        app.$store.commit("map/ROUTERSHOWHIDDENSIDEBAR", true);
                        app.$router.push({name: "object", params: {id: ob_ids[0]}});
                    });
                    marker.on("mouseover", function (e) {
                        this.openPopup();
                    });
                    marker.on("mouseout", function (e) {
                        this.closePopup();
                    });
                    app.mapMarker.push(marker);
                }
                $("body").on("click", ".setObject", function (e) {
                    e.preventDefault();
                    let id = $(this).data("id");
                    app.$router.push({name: "object", params: {id: id}});
                    let key = $(this).data("key");
                    let coord = app.firms[key][0].coord;
                    app.scrollToCoord(coord);
                });
            },
            addMarkerSearch() {
                let app = this;
                var LeafIcon = L.icon({
                    iconUrl: "/img/placealtadd.svg",
                    iconSize: [40, 40]
                });
                this.searchMarker = L.marker(
                    [this.search.latlng.lat, this.search.latlng.lng],
                    {
                        icon: LeafIcon,
                        title: this.search.value
                    }
                );
                this.searchMarker.bindPopup(
                    '<p class="text-center">' +
                    '<strong>' +
                    this.search.value +
                    '</strong>' +
                    '</p>'
                );
                this.searchMarker.on('click', function (e) {
                    if (app.search.type == "searchCity") {
                        app.$router.push({name: 'addobject'});
                        setTimeout(() => {
                            eventBus.$emit('setPlace');
                        }, 10)
                    }
                });
                this.searchMarker.addTo(this.map);
                this.map.setView([this.search.latlng.lat, this.search.latlng.lng], 14, {
                    animate: false,
                });
                this.searchMarker.openPopup();
            },
            removeSearchMarker() {
                if (this.searchMarker !== null) {
                    this.map.removeLayer(this.searchMarker);
                    this.searchMarker = null;
                }
            },
            findBestZoom() {
                if (this.mapMarker.length > 0) {
                    var featureGroup = L.featureGroup(this.mapMarker);
                    this.map.fitBounds(featureGroup.getBounds().pad(0.1), {
                        animate: false
                    });
                }
            },
            scrollToCoord(coord) {
                this.map.setView(coord, 15, {
                    animate: false,
                    pan: {
                        duration: 10
                    }
                });
            }
        }
    };
</script>

