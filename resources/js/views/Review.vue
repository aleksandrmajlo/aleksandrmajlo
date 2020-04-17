<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid" id="sidebarLeft">
        <div class="panel-block panel-block--md border border-primary" v-if="firm!==null">
            <photos :photos="firm.photos" :key="firm.id"></photos>

            <div class="panel-block__body">
                <h2 class="text-center">{{firm.title}}</h2>
                <time-work v-if="firm.time_work" :time_value="firm.time_work"></time-work>
                <div class="row">
                    <div v-if="reviews&&reviews.length>0" class="col h5 fw-400 text-primary">{{$t('all_review')}}</div>
                    <div v-else class="col h5 fw-400 text-primary">{{$t('not_review')}}</div>
                    <div class="col-auto mb-3">
                        <router-link class="text-body tdn" :to="'/addreview/?id='+id">
                            {{$t('ob_button')}} <img src="/img/svg/add.svg" alt=""/>
                        </router-link>
                    </div>
                </div>
                <div class="rew" v-show="reviews&&reviews.length>0">

                    <div class="rew__item" v-for="(review,index) in reviews">
                        <div class="rew__title mb-2 text-primary">
                            <div class="rew__img-wrap">
                                <img class="mr-2" src="/img/svg/user-circle.svg" alt=""/>
                                {{review.user}}
                            </div>
                        </div>
                        <review-stars :start_value="review.value"
                                      :disabled="true"
                                      classMy=" star-block--sm text-left"></review-stars>
                        <p>
                            {{review.comment}}
                        </p>
                        <div class="row">
                            <a class="d-flex align-items-center col-auto h6 text-primary fw-300 tdn" href="#">
                                {{$t('like_review')}}
                                <img class="ml-2" src="/img/svg/like-4.svg" alt=""/>
                            </a>
                            <a class="d-flex align-items-center col-auto h6 text-primary fw-300 tdn" href="#">
                                <img class="ml-2" src="/img/svg/Share-4.svg" alt=""/>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <banner-botom ></banner-botom>

        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import TimeWork from "~/components/Firm/TimeWork";
    import ReviewStars from "~/components/Firm/ReviewStars.vue";
    import Photos from "~/components/Firm/Photos.vue";
    import BannerBotom from '~/components/Banner/BannerBotom';
    export default {
        name: "Review",
        data() {
            return {
                id: null,
                firm: null,
                reviews: null,

                error: null,
                error_text: "",
            };
        },
        components: {TimeWork,ReviewStars,Photos,BannerBotom},
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar",
                check: "auth/check",

            }),
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    if (typeof from == "undefined") {
                        this.id = this.$route.params.id;
                        this.getFirm()
                        this.getReviews()
                    } else {
                        if (to.name == "review" && to.params.id !== from.params.id) {
                            this.id = this.$route.params.id;
                            this.getReviews();
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
                        this.firm = this.$store.getters["firms/getFirmById"](this.id);
                    });
                } else {
                    this.firm = firm;
                }
            },
            getReviews() {
                let reviews = this.$store.getters["firms/getReviewsByFirm_id"](this.id);
                if (typeof reviews == "undefined" || reviews === null) {
                    this.$store.dispatch("firms/getReviews", this.id).then(() => {
                        this.reviews = this.$store.getters["firms/getReviewsByFirm_id"](this.id);
                    });
                } else {
                    this.reviews = reviews;
                }
            }
            //
        }
    }
</script>

