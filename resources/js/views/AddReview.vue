<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid"
        id="sidebarLeft"
    >
        <div class="panel-block panel-block--md border border-primary" v-if="firm!==null">
            <photos :photos="firm.photos" :key="firm.id"></photos>
            <div class="panel-block__body">
                <h2 class="text-center">{{firm.title}}</h2>
                <div class="panel-block__link-add panel-block__link-add--title">
                    <span>{{$t('ob_add_review')}}</span>
                    <review-stars v-model="value" :start_value="null"
                                  :disabled="false"
                                  classMy=" mb-1"></review-stars>
                </div>

                <div class="form-group">
                  <textarea
                     class="form-control border-dotted"
                     v-model="comment"
                     placeholder="Добавьте описание"
                   ></textarea>
                </div>
                <dropzone-comp ref="upload" v-on:SetImagesChild="SetImages"></dropzone-comp>
                <button :disabled="isDisabled" @click.prevent="sendReview" class="panel-block__btn-add" type="submit">
                    {{$t('ob_button')}}
                </button>
                <div class="text-left mt-a">
                    <router-link class="tdn text-body" :to="'/object/'+this.id">
                        {{$t('ob_back')}}
                    </router-link>
                    <a href="#"></a>
                </div>
            </div>
            <banner-botom ></banner-botom>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import DropzoneComp from "~/components/Dropzone/DropzoneComp.vue";
    import ReviewStars from "~/components/Firm/ReviewStars.vue";
    import Photos from "~/components/Firm/Photos.vue";
    import BannerBotom from '~/components/Banner/BannerBotom';
    export default {
        name: "AddReview",
        data() {
            return {
                id: null,
                firm: null,
                comment: "",
                value: null,
                isDisabled: false
            };
        },
        components: {ReviewStars, DropzoneComp, Photos,BannerBotom},
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar",
                user: "auth/user"
            }),
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    this.id = this.$route.query.id;
                    this.getFirm();
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
            },
            SetImages(images = false) {
                if (!images) {
                    images = this.$refs.upload.getFieled();
                }
                let img_ar = [];
                images.forEach(img => {
                    img_ar.push(img.name);
                });
                return img_ar;
            },
            sendReview() {
                if (this.value == null) {
                    this.showShwal('warning', this.$t('rating_warning'));
                    return false;
                }
                this.isDisabled = true;
                let data = {
                    value: this.value,
                    comment: this.comment,
                    user: this.user.id,
                    photos: this.SetImages(),
                    firm_id: this.id
                };
                console.log(data)
                axios({
                    method: "post",
                    url: "addReview",
                    headers: {
                        Authorization: "Bearer " + this.$auth.token("laravel-vue-spa")
                    },
                    data: data
                })
                    .then(response => {
                        this.showShwal('info', this.$t('rating_check'));
                        this.$router.push({name: 'object', params: {id: this.id}})
                    })
                    .catch(e => {
                        this.showShwal('error', this.$t('ALL_EROOR'));
                    })
                    .finally(() => {
                        this.isDisabled = false;
                    })
            }
        }
    };
</script>
