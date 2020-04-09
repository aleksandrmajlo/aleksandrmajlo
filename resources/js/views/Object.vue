<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid "
        id="sidebarLeft"
    >
        <div v-if="error" class="panel-block panel-block--md border border-primary">
            <div class="alert alert-danger">{{ error_text }}</div>
            <div class="panel-block__footer">
                <img :src="banners" alt/>
            </div>
        </div>

        <div v-else-if="firm!==null" class="panel-block panel-block--md border border-primary">
            <div class="panel-block__head bg-wrap" v-if="firm.photos.length>0">
                <!-- карусель -->
                <div class="carusel carusel--js swiper-container invisible">
                    <div class="swiper-wrapper">
                        <div
                            class="carusel__slide swiper-slide"
                            v-for="(photo,index) in firm.photos"
                            :key="index"
                        >
                            <a class="carusel__img-wrap bg-wrap" :href="photo.photo" data-fancybox="gal">
                                <img class="res-i object-fit-js img-bg" :src="photo.resized" alt/>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- карусель end-->
            </div>
            <div class="panel-block__body">
                <div class="h5 fw-400 border-bottom border-light text-primary">{{firm.title}}</div>
                <div class="h5 fw-300 border-bottom border-light text-primary">{{firm.service}}</div>

                <div v-if="check">
                    <a class="panel-block__link-add" href="#">
                        <span>{{$t('ob_photo')}}</span>
                        <svg class="icon icon-icon_material-add-a-photo">
                            <use xlink:href="/img/svg/sprite.svg#icon_material-add-a-photo"/>
                        </svg>
                    </a>
                    <router-link
                        class="panel-block__link-add"
                        :to="{ name: 'review', params: { id: $route.params.id }}"
                    >
                        <span>{{$t('ob_review')}}</span>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                    </router-link>
                    <router-link class="panel-block__link-add" to="/addobject">
                        <span>{{$t('ob_add')}}</span>
                        <svg class="icon icon-map_marker">
                            <use xlink:href="/img/svg/sprite.svg#map_marker"/>
                        </svg>
                    </router-link>
                    <br/>
                    <br/>
                </div>

                <div v-else>
                    <router-link
                        class="panel-block__link-add"
                        :to="{ name: 'review', params: { id: $route.params.id }}"
                    >
                        <span>{{$t('ob_review')}}</span>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                        <svg class="icon icon-icon_feather-star">
                            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                        </svg>
                    </router-link>
                </div>

                <a class="panel-block__link-add" href="#">
                    <span>{{$t('show_othner_firm')}}</span>
                    <svg class="icon icon-map_marker">
                        <use xlink:href="/img/svg/sprite.svg#map_marker"/>
                    </svg>
                </a>
                <div class="h6 text-primary fw-300">
                    {{firm.address}}
                    <br/>
                    <a v-if="firm.site!==null" :href="firm.site">{{firm.site}}</a>
                    <br/>
                    <a v-if="firm.phone!==null" :href="'tel:'+firm.phone">{{firm.phone}}</a>
                </div>
                <!--       рейтинг            -->
                <div class="star-block">
                    <svg class="icon icon-icon_feather-star text-primary">
                        <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                    </svg>
                    <svg class="icon icon-icon_feather-star text-primary">
                        <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                    </svg>
                    <svg class="icon icon-icon_feather-star text-primary">
                        <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                    </svg>
                    <svg class="icon icon-icon_feather-star text-primary-light">
                        <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                    </svg>
                    <svg class="icon icon-icon_feather-star">
                        <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
                    </svg>
                </div>
                <!--       рейтинг етв           -->
                <time-work v-if="firm.time_work" :time_value="firm.time_work"></time-work>
            </div>

            <div class="panel-block__footer">
                <img :src="banners" alt/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import TimeWork from "~/components/Firm/TimeWork";

    export default {
        name: "Object",
        data() {
            return {
                id: null,
                firm: null,
                // firm_type: [],
                swiper: null,
                error: null,
                error_text: "",
            };
        },
        components: {TimeWork},
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar",
                check: "auth/check",
                banners: "firms/banners"
            })
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    if (typeof from == "undefined") {
                        this.id = this.$route.params.id;
                        this.getFirm()
                    } else {
                        if (to.name == "object" && to.params.id !== from.params.id) {
                            this.id = this.$route.params.id;
                            this.getFirm();
                        }
                    }
                },
            },
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
                        this.fetchData();
                    });
                } else {
                    this.firm = firm;
                    this.fetchData();
                }
            },
            fetchData() {
                if (this.firm.photos.length > 0) {
                    setTimeout(()=>{
                        if (this.swiper === null) {
                            this.swiper = new Swiper(".carusel--js", {
                                slidesPerView: 3,
                                spaceBetween: 15,
                                loop: true,
                                on: {
                                    init: function () {
                                        $(".carusel--js").removeClass("invisible");
                                    }
                                }
                            });
                        } else {
                            this.swiper.update();
                            $(".carusel--js").removeClass("invisible");
                        }
                    },100)
                }

            },

        }
    };
</script>
