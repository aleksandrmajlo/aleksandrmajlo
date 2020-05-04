<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar"
         class="sidebarLeft sidebarLeft--lg section container-fluid " id="sidebarLeft">
        <div class="panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <banner-top></banner-top>
            </div>
            <div class="panel-block__body">


                <div class="row pb-1">
                    <div class="col-lg-6">
                        <router-link class="panel-block__link-add panel-block__link-add--title"
                                     @click.native="clickRouterLinkActive('auth')"
                                     :to="{name:'addobject'}">
                            <span>{{$t('ob_add')}}</span>
                            <svg class="icon icon-map_marker ">
                                <use xlink:href="/img/svg/sprite.svg#map_marker"></use>
                            </svg>
                        </router-link>
                    </div>
                </div>
                <items-loop :search_firms="search_firms"></items-loop>
            </div>
            <banner-botom classNone="d-lg-none"></banner-botom>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    import BannerBotom from '~/components/Banner/BannerBotom';
    import BannerTop from "~/components/Banner/BannerTop";
    import ItemsLoop from "~/components/Firm/ItemsLoop.vue";

    export default {
        name: "Search",
        components: {BannerTop, BannerBotom, ItemsLoop},
        data() {
            return {
                // coord: null,
                // city: null,
                title: null,
                q: null,
                search_firms: null,
            }
        },
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: 'map/showMapYesNoSidebar'
            })
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {

                    if (typeof this.$route.query.title != "undefined") {
                        this.title = this.$route.query.title;
                    }
                    if (typeof this.$route.query.q !== "undefined") {
                        this.q = this.$route.query.q;
                    }
                    // if (typeof this.$route.query.title !== "undefined") {
                    //     this.city = this.$route.query.city;
                    // }
                    this.search();
                }
            }
        },
        methods: {
            search() {
                let data = {};
                if (this.title !== null) {
                    data.title = this.title;
                } else if (this.q !== null) {
                    data.q = this.q;
                }
                // if (this.city !== null) {
                //     data.city = this.city;
                // }
                axios.get('search', {
                    params: data
                })
                    .then(response => {
                        this.search_firms = response.data.firms;
                        // console.log('search 86')
                        // console.log(response.data)
                        if (response.data.latlng) {

                            this.$store.commit("map/SET_SEARCH", {
                                value: this.title,
                                latlng: response.data.latlng,
                                type: 'address'
                            });

                        }
                    })
                    .catch(error => {

                    })
            },
        },
    }
</script>

