<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid" id="sidebarLeft">

        <div class="panel-block panel-block--md border border-primary">
            <div class="panel-block__head bg-wrap BackBlueHeder">
                <div class="panel-block__head-title">
                    {{$t('my_review')}}
                </div>
            </div>
            <div class="panel-block__body">

                <div class="rew" v-show="reviews&&reviews.length>0">
                    <div class="rew__item" v-for="(review,index) in reviews">
                        <div class="rew__title mb-2 text-primary">
                            <div class="rew__img-wrap">
                                <router-link :to="{name:'object',params:{id:review.firm_id}}">
                                    {{review.firm}}
                                </router-link>
                            </div>
                        </div>
                        <review-stars :start_value="review.value"
                                      :disabled="true"
                                      classMy=" star-block--sm text-left"></review-stars>
                        <p>
                            {{review.comment}}
                        </p>
                        <review-share :review="review"></review-share>
                    </div>
                </div>
                <div v-if="reviews.length===0&&loader" class="text-warning">
                    {{$t('notReview')}}
                </div>

            </div>
        </div>
        <banner-botom></banner-botom>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import TimeWork from "~/components/Firm/TimeWork";
    import ReviewStars from "~/components/Firm/ReviewStars.vue";
    import Photos from "~/components/Firm/Photos.vue";
    import BannerBotom from '~/components/Banner/BannerBotom';
    import ReviewShare from '~/components/Share/ReviewShare.vue';
    export default {
        name: "Myreview",
        data() {
            return {
                id: null,
                firm: null,

                error: null,
                error_text: "",
                loader:false
            };
        },
        components: {TimeWork,ReviewStars,Photos,BannerBotom,ReviewShare},
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar",
                user: "auth/user",
                reviews:"auth/user_review"
            }),
        },
        mounted() {
            this.$store.dispatch("auth/get_review").then(() => {
                this.loader=true;
            });

        }
    }
</script>

