<template>

    <div v-show-slide:400:ease="showMapYesNoSidebar"
         class="sidebarLeft sidebarLeft--lg section container-fluid " id="sidebarLeft">

        <div class="panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <div class="col-lg-6">
                    <div class="panel-block__head bg-wrap BackBlueHeder">
                        <div class="panel-block__head-title">{{$t('my_firm')}}</div>
                    </div>
                </div>
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
        name: "Myfirm",
        data() {
            return {

            }
        },
        components: {ItemsLoop, BannerBotom, BannerTop},
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar",
                search_firms: "auth/user_firms"
            }),
        },
        created() {
            this.$store.dispatch("auth/get_firms")
        },
    }
</script>
