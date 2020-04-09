<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid" id="sidebarLeft">
        <div class="panel-block panel-block--md border border-primary" v-if="firm!==null">
            <div class="panel-block__head bg-wrap">
                <img class="img-bg object-fit-js" :src="firm_photo" alt=""/>
                <div class="panel-block__head-title">
                    {{firm.title}}
                </div>
            </div>
            <div class="panel-block__body">
                <time-work v-if="firm.time_work" :time_value="firm.time_work"></time-work>
                <div class="row">
                    <div v-if="reviews.length>0" class="col h5 fw-400 text-primary">{{$t('all_review')}}</div>
                    <div v-else class="col h5 fw-400 text-primary">{{$t('not_review')}}</div>
                    <div class="col-auto mb-3">
                        <router-link class="text-body tdn" :to="'/addreview/?id='+id">
                            {{$t('ob_button')}} <img src="/img/svg/add.svg" alt=""/>
                        </router-link>
                    </div>
                </div>
                <div class="rew">
                    <div class="rew__item" v-for="(review,index) in reviews">
                        <div class="rew__title mb-2 text-primary">
                            <div class="rew__img-wrap">
                                <img class="mr-2" src="/img/svg/user-circle.svg" alt=""/>Джулия Кляйн
                            </div>
                        </div>
                        <div class="star-block star-block--sm text-left">
                            <svg class="icon icon-icon_feather-star  text-primary">
                                <use xlink:href="img/svg/sprite.svg#icon_feather-star"></use>
                            </svg>
                            <svg class="icon icon-icon_feather-star  text-primary">
                                <use xlink:href="img/svg/sprite.svg#icon_feather-star"></use>
                            </svg>
                            <svg class="icon icon-icon_feather-star  text-primary">
                                <use xlink:href="img/svg/sprite.svg#icon_feather-star"></use>
                            </svg>
                            <svg class="icon icon-icon_feather-star  text-primary">
                                <use xlink:href="img/svg/sprite.svg#icon_feather-star"></use>
                            </svg>
                            <svg class="icon icon-icon_feather-star  text-primary">
                                <use xlink:href="img/svg/sprite.svg#icon_feather-star"></use>
                            </svg>
                        </div>
                        <p>
                            Люблю Украину! В моем детстве это был  универмаг. Сейчас ТРЦ. Он какой-то особенный.  Добавить бы еду какую-то. Пузатую хату  например. И туалеты сделать бесплатными.
                        </p>
                        <div class="row">
                            <a class="d-flex align-items-center col-auto h6 text-primary fw-300 tdn" href="#">
                                {{$t('like_review')}}
                                <img class="ml-2" src="/img/svg/like-4.svg" alt=""/>
                            </a>
                            <a class="d-flex align-items-center col-auto h6 text-primary fw-300 tdn" href="#">
                                <img class="ml-2" src="img/svg/Share-4.svg" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-block__footer">
                <img :src="banners" alt=""/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import TimeWork from "~/components/Firm/TimeWork";
    export default {
        name: "Review",
        data() {
            return {
                id: null,
                firm: null,
                reviews:[] ,

                error: null,
                error_text: "",
            };
        },
        components: {TimeWork},
        computed:{
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar",
                check: "auth/check",
                banners: "firms/banners"
            }),
            firm_photo(){
                if(this.firm&&this.firm.photos.length>0){
                    return this.firm.photos[0].resized;
                }
                return '/img/@2x/2019-09-06.png';
            }
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    if (typeof from == "undefined") {
                        this.id = this.$route.params.id;
                        this.getFirm()
                    } else {
                        if (to.name == "review" && to.params.id !== from.params.id) {
                            this.id = this.$route.params.id;
                            this.getFirm();
                        }
                    }
                },
            },
        },
        methods:{
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
            },
        }
    }
</script>

<style scoped>

</style>
