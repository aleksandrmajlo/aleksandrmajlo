<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar"
         class="sidebarLeft sidebarLeft--lg section container-fluid " id="sidebarLeft">
        <div class="panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <div class="col-lg-6" >
                    <div class="panel-block__head bg-wrap">
                        <img class="img-bg object-fit-js" src="/img/@2x/2019-09-06.png" alt=""/>
                        <div class="panel-block__head-title">
                            площа Перемоги, 3, <br/>Київ, Украина, <br/>секция или еще что-то
                        </div>
                    </div>
                </div>
                <banner-top></banner-top>
            </div>
            <div class="panel-block__body">
                <div class="row pb-1">
                    <div class="col-lg-6">
                            <router-link class="panel-block__link-add panel-block__link-add--title" :to="{name:'addobject'}">
                                <span>{{$t('ob_add')}}</span>
                                <svg class="icon icon-map_marker ">
                                    <use xlink:href="/img/svg/sprite.svg#map_marker"></use>
                                </svg>
                            </router-link>
                    </div>
                    <div class="col">
                        <form class="search-inner">
                            <input class="search-inner__input" type="text" placeholder="начните вводить адрес"/>
                            <button class="search-inner__btn" type="submit">
                                <img src="/img/svg/search-bl.svg" alt=""/>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-6" v-for="(firm,index) in firms" :key="firm.id" >
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">
                                Golden Ostap
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-right mt-a mb-1">
                    <a class="tdn" href="#">вернуться к описанию</a>
                </div>
            </div>
            <banner></banner>

        </div>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    import Banner from '~/components/Banner/Banner'
    import BannerTop from "~/components/Banner/BannerTop";

    export default {
        name: "Search",
        components: {BannerTop, Banner},
        data(){
            return {
                coord_q:null,

                firms:[]
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
                    this.coord_q = this.$route.query.coord;
                    this.search();
                }
            }
        },
        methods:{
            search(){
                if(this.coord_q!==null){
                    let coord=this.coord_q.split('_');

                }
               console.log(this.coord_q)
            }
        }

    }
</script>

