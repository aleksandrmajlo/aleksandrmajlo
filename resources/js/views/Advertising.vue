<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid features"
        id="sidebarLeft"
    >

        <div class="panel-block panel-block--md border border-primary">
            <div class="panel-block__body">
                <h2 class="text-center">Реклама</h2>
            </div>
            <banner-botom></banner-botom>
        </div>

    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    import BannerBotom from '~/components/Banner/BannerBotom';

    export default {
        name: "Favorite",
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar"
            }),

        },
        components: {BannerBotom},
    };
</script>
