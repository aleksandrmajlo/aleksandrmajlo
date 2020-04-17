<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar"
         class="sidebarLeft sidebarLeft--lg section container-fluid " id="sidebarLeft">
        <div class="panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <div class="col-lg-6">
                    <div class="panel-block__head bg-wrap">
                        <img class="img-bg object-fit-js" src="/img/@2x/2019-09-06.png" alt=""/>
                        <div class="panel-block__head-title">

                        </div>
                    </div>
                </div>
                <banner-top></banner-top>
            </div>
            <div class="panel-block__body">

                <div v-show-slide:400:ease="detaliFirm&&firmModal!==null"
                     class=" overflow-auto modal-comp border-dotted">
                    <item v-if="firmModal!==null" :firm="firmModal" :modal="true" @hiddeModal="detaliFirm=false"></item>
                </div>

                <div class="row pb-1">
                    <div class="col-lg-6">
                        <router-link class="panel-block__link-add panel-block__link-add--title"
                                     :to="{name:'addobject'}">
                            <span>{{$t('ob_add')}}</span>
                            <svg class="icon icon-map_marker ">
                                <use xlink:href="/img/svg/sprite.svg#map_marker"></use>
                            </svg>
                        </router-link>
                    </div>
                </div>
                <div class="row" v-if="search_firms!==null&&search_firms.length>0">
                    <div class="col-lg-6" v-for="(firm,index) in search_firms">
                        <div @click="showDetali(firm.id,$event)"
                             class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">
                                {{firm.title}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-else>
                    <div class="col-lg-12">
                        <p class="text-warning">
                            {{$t('search_not_found')}}
                        </p>
                    </div>
                </div>
                <div class="text-right mt-a mb-1">
                    <router-link class="tdn" to="/">
                        {{$t('ob_back')}}
                    </router-link>
                </div>
            </div>
            <banner-botom classNone="d-lg-none"></banner-botom>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    import BannerBotom from '~/components/Banner/BannerBotom';
    import BannerTop from "~/components/Banner/BannerTop";
    import Item from "~/components/Firm/Item.vue";

    export default {
        name: "Search",
        components: {BannerTop, BannerBotom, Item},
        data() {
            return {
                coord: null,
                city: null,
                q: null,
                firm_id: null,
                firmModal: null,
                search_firms: null,
                detaliFirm: false
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
                    if (typeof this.$route.query.coord != "undefined") {
                        this.coord = this.$route.query.coord;
                    }
                    if (typeof this.$route.query.q !== "undefined") {
                        this.q = this.$route.query.q;
                    }
                    if (typeof this.$route.query.city !== "undefined") {
                        this.city = this.$route.query.city;
                    }
                    this.search();
                }
            }
        },
        methods: {
            search() {
                this.firmModal = null;
                this.detaliFirm = null;
                let data = {};
                if (this.coord !== null) {
                    data.coord = this.coord;
                } else if (this.q !== null) {
                    data.q = this.q;
                }
                if (this.city !== null) {
                    data.city = this.city;
                }
                axios.get('search', {
                    params: data
                })
                    .then(response => {
                        this.search_firms = response.data.firms;
                    })
                    .catch(error => {

                    })
            },

            showDetali(firm_id, event) {
                if (this.firm_id == firm_id) {
                    this.detaliFirm = true;
                    return false;
                }
                let loader = this.showLoader({
                    container: event.target,
                    loader: 'bars',
                    isFullPage: false
                });
                this.firm_id = firm_id
                let firm = this.$store.getters["firms/getFirmById"](this.firm_id);
                if (typeof firm == "undefined" || firm === null) {
                    this.$store.dispatch("firms/getFirm", this.firm_id).then(() => {
                        this.firmModal = this.$store.getters["firms/getFirmById"](this.firm_id);
                        this.detaliFirm = true;
                        loader.hide()
                    });
                } else {
                    this.firmModal = firm;
                    this.detaliFirm = true;
                    loader.hide()
                }
            }

        },
    }
</script>

