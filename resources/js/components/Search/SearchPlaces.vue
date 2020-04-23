<template>
    <div class="panel-block__input-wrap form-group">
        <div class="searcBlockPlace">
            <input
                id="my-input-search"
                :class="{'is-invalid':!isValid}"
                class="panel-block__input form-control border-dotted"
                type="text"
                :placeholder="$t('search')"
            />
        </div>
    </div>
</template>
<script>
    // import {mapGetters} from "vuex";
    import {eventBus} from '~/app'
    import places from 'places.js';

    var preferredLanguage = window.navigator.language.split("-")[0];
    export default {
        name: "SearchPlaces",
        data() {
            return {
                places: null,
                mounted: false
            };
        },
        props: {
            isValid: {
                type: Boolean,
                default: true
            }
        },
        created() {
            eventBus.$on('setPlace', () => {
                this.changePlace()

            })
        },
        mounted() {

            this.places = places({
                appId: appId,
                apiKey: apiKey,
                container: "#my-input-search"
            }).configure({
                language: preferredLanguage,
                type: "address",
                aroundLatLngViaIP: false
            });
            this.places.on("change", e => {
                if (e.suggestion.length === 0) {
                    this.$store.commit("map/SET_SEARCH", {
                        value: "",
                        latlng: null,
                        type: false
                    });
                } else {
                    let res = e.suggestion;
                    this.$store.commit("map/SET_SEARCH", {
                        value: res.value,
                        type: res.type,
                        latlng: res.latlng
                    });
                }
            });
            this.places.on("clear", e => {
                this.$store.commit("map/SET_SEARCH", {
                    value: "",
                    latlng: null,
                    type: false
                });
            });

            /*
            if (this.$route.query.address !== undefined) {
                this.places.setVal(this.$route.query.address);
                this.$store.commit("map/SET_SEARCH", {
                    value: this.$route.query.address,
                    type: "address",
                    latlng: {lat: this.$route.query.lat, lng: this.$route.query.lng}
                })
            }
           */

        },
        methods: {
            changePlace() {
                this.places.setVal(this.$store.state.map.search.value);
            }
        }
    };
</script>

