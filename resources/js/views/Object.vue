<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid"
        id="sidebarLeft"
    >
        <div v-if="error" class="panel-block panel-block--md border border-primary">
            <div class="alert alert-danger">{{ error_text }}</div>
            <banner-botom></banner-botom>
        </div>
        <div v-else-if="firm!==null" class="panel-block panel-block--md border border-primary">
            <div v-if="firmPhoto" class="panel-block__head bg-wrap">
                <img class="img-bg object-fit-js" :src="firmPhoto" alt=""/>
                <div class="panel-block__head-title">{{firm.address}}</div>
            </div>
            <div class="panel-block__body">
                <item :firm="firm"></item>
            </div>
            <banner-botom></banner-botom>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import Item from "~/components/Firm/Item.vue";
    import BannerBotom from "~/components/Banner/BannerBotom";

    export default {
        name: "Object",
        data() {
            return {
                id: null,
                firm: null,
                error: null,
                error_text: ""
            };
        },
        components: {
            Item,
            BannerBotom
        },
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar"
            }),
            firmPhoto() {
                if (this.firm !== null && this.firm.photos.length > 0) {
                    return this.firm.photos[0].resized
                }
                return false;
            }
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    if (typeof from == "undefined") {
                        this.id = this.$route.params.id;
                        this.getFirm();
                    } else {
                        if (to.name == "object" && to.params.id !== from.params.id) {
                            this.id = this.$route.params.id;
                            this.getFirm();
                        }
                    }
                }
            }
        },
        methods: {
            getFirm() {
                this.error = this.firm = null;
                if (this.id === null) {
                    this.id = this.$route.params.id;
                }
                let firm = this.$store.getters["firms/getFirmById"](this.id);
                if (typeof firm == "undefined" || firm === null) {
                    this.$store.dispatch("firms/getFirm", this.id).then(() => {
                        let firm = this.$store.getters["firms/getFirmById"](this.id);
                        this.firm = firm;
                    });
                } else {
                    this.firm = firm;
                }
            }
        }
    };
</script>
