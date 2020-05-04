<template>
    <div>
        <div v-if="modal" class="modal-comp-title border-bottom border-light">
            {{firm.title}}
            <div class="modal-close" @click="detaliFirm"></div>
        </div>
        <div v-else class="h5 fw-400 border-bottom border-light text-primary">{{firm.title}}</div>
        <div class="h5 fw-300 border-bottom border-light text-primary">{{firm.service}}</div>
        <div>
            <router-link
                @click.native="clickRouterLinkActive('auth')"
                :to="'/addphoto/?id='+firm.id"
                class="panel-block__link-add"
            >
                <span>{{$t('ob_photo')}}</span>
                <svg class="icon icon-icon_material-add-a-photo">
                    <use xlink:href="/img/svg/sprite.svg#icon_material-add-a-photo"/>
                </svg>
            </router-link>
            <router-link
                @click.native="clickRouterLinkActive"
                class="panel-block__link-add"
                :to="{ name: 'review', params: { id: firm.id }}"
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
            <router-link
                @click.native="clickRouterLinkActive('auth')"
                class="panel-block__link-add"
                :to="{name:'addobject',query:{address:firm.address,lat:firm.lat_lng.lat,lng:firm.lat_lng.lng}}"
            >
                <span>{{$t('ob_add')}}</span>
                <svg class="icon icon-map_marker">
                    <use xlink:href="/img/svg/sprite.svg#map_marker"/>
                </svg>
            </router-link>
            <favorite-item :firm="firm"></favorite-item>
            <br/>
            <br/>
        </div>

        <div v-if="firm.basic==1&&firm.others" class="otherLinkMinimum">
                   <router-link
                       @click.native="clickRouterLinkActive"
                       v-for="(other,index) in firm.others"
                       v-if="index<5"
                       :key="other.id"
                       :to="{name:'object', params: { id: other.id }}"
                   >{{other.title}}</router-link>
        </div>
        <a  v-if="firm.basic==1&&firm.others&&firm.others.length>5"
            href="#"
            class="panel-block__link-add firm_others_link" >
            <span>{{$t('show_othner_firm')}}</span>
            <svg class="icon icon-map_marker">
                <use xlink:href="/img/svg/sprite.svg#map_marker"/>
            </svg>
        </a>
        <div class="firm_others" style="display:none;" v-if="firm.basic==1&&firm.others&&firm.others.length>5">
            <router-link
                @click.native="clickRouterLinkActive"
                v-for="(other,index) in firm.others"
                v-if="index>=5"
                :key="other.id"
                :to="{name:'object', params: { id: other.id }}"
            >{{other.title}}
            </router-link>
        </div>


        <div class="h6 text-primary fw-300">
            {{firm.address}}
            <br/>
            <a v-if="firm.site!==null" :href="firm.site">{{firm.site}}</a>
            <br/>
            <a v-if="firm.phone!==null" :href="'tel:'+firm.phone">{{firm.phone}}</a>
        </div>
        <!--       рейтинг            -->
        <review-stars :start_value="firm.rating" :disabled="true" classMy="  "></review-stars>
        <!--       рейтинг етв           -->
        <time-work v-if="firm.time_work&&firm.timeworkstatus!==1" :time_value="firm.time_work"></time-work>

        <div class="text-left mt-a"  v-if="firm.basic==0&&firm.others.length>0">
            <router-link class="tdn text-body"
                         :to="{name:'object', params: { id: firm.basic_id }}">
                   {{$t('back_basic')}}
            </router-link>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    import TimeWork from "~/components/Firm/TimeWork";
    import ReviewStars from "~/components/Firm/ReviewStars.vue";
    import FavoriteItem from "~/components/Firm/FavoriteItem.vue";

    export default {
        name: "Item",
        data(){
            return {
                basic_id:"",
                basic_title:"",
            }
        },
        computed:{
            ...mapGetters({
                categories: "firms/categories",
            })
        },
        components: {TimeWork, ReviewStars,FavoriteItem},
        props: {
            firm: {
                type: Object,
                required: true
            },
            modal: {
                type: Boolean,
                default: false
            }
        },

        mounted() {
            $(".firm_others_link").click(function (e) {
                e.preventDefault();
                $(".firm_others").toggle();
            });
        },
        methods: {
            detaliFirm() {
                this.$emit("hiddeModal");
            }
        }
    };
</script>

