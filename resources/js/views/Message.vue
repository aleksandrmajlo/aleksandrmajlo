<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar"
         class="sidebarLeft sidebarLeft--lg section container-fluid " id="sidebarLeft">
        <div class="panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <div class="col-lg-6">
                    <div class="panel-block__head bg-wrap BackBlueHeder">
                        <div class="panel-block__head-title">{{$t('mess')}}</div>
                    </div>
                </div>
                <banner-top></banner-top>
            </div>
            <div class="panel-block__body">

            </div>
            <banner-botom classNone="d-lg-none"></banner-botom>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import BannerBotom from '~/components/Banner/BannerBotom';
    import BannerTop from "~/components/Banner/BannerTop";

    export default {
        name: "Message",
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar"
            })
        },
        components: {BannerBotom,BannerTop},
    };
</script>
