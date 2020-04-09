<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar" class="sidebarLeft sidebarLeft--md section container-fluid" id="sidebarLeft"    >
        <div class="panel-block panel-block--md border border-primary" v-if="firm!==null">
            <div class="panel-block__head bg-wrap">
                <img class="img-bg object-fit-js" :src="firm_photo" alt/>
                <div class="panel-block__head-title">{{firm.title}}</div>
            </div>
            <div class="panel-block__body">

                <review-stars></review-stars>

                <div class="form-group">
                    <textarea class="form-control border-dotted" v-model="comment" placeholder="Добавьте описание"></textarea>
                </div>
                <dropzone-comp ref="upload" v-on:SetImagesChild="SetImages"></dropzone-comp>
                <button class="panel-block__btn-add" type="submit">
                    {{$t('ob_button')}}
                </button>
                <div class="text-left mt-a">
                    <a class="tdn text-body" href="#">{{$t('ob_back')}}</a>
                </div>
            </div>
            <div class="panel-block__footer">
                <img :src="banners" alt/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import DropzoneComp from "~/components/Dropzone/DropzoneComp.vue";
    import ReviewStars from "~/components/Firm/ReviewStars.vue";
    export default {
        name: "AddReview",
        data() {
            return {
                id: null,
                firm: null,
                comment:"",
                value:0
            };
        },
        components:{ReviewStars, DropzoneComp},
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar",
                banners: "firms/banners",
                user: 'auth/user'
            }),
            firm_photo() {
                if (this.firm && this.firm.photos.length > 0) {
                    return this.firm.photos[0].resized;
                }
                return "/img/@2x/2019-09-06.png";
            }
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
            SetImages(){

            }
        }
    };
</script>
