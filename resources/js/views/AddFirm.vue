<template>
    <div  v-show-slide:400:ease="showMapYesNoSidebar"  class="sidebarLeft sidebarLeft--lg section container-fluid features" id="sidebarLeft">
        <div   class=" panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <div class="col-lg-6" v-show="isTitleFoto">
                    <div class="panel-block__head bg-wrap">
                        <img class="img-bg object-fit-js 99999" :src="photo" alt/>
                        <div class="panel-block__head-title">{{title}}</div>
                    </div>
                </div>
                <div class="col-6 d-none d-lg-block">
                    <a class="head-banner" href="#">
            <span class="head-banner__img-wrap">
              <img src="/img/@1x/img-without.jpg" alt/>
            </span>
                        <span class="head-banner__text">Самая эффективная реклама вашего бизнеса</span>
                    </a>
                </div>
            </div>
            <div class="panel-block__body">
                <div class="panel-block__link-add panel-block__link-add--title">
                    <span>{{$t('ob_add')}}</span>
                    <svg class="icon icon-map_marker">
                        <use xlink:href="/img/svg/sprite.svg#map_marker"/>
                    </svg>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel-block__input-wrap form-group">
                            <input
                                class="panel-block__input form-control border-dotted"
                                :class="{'is-invalid':titleInValid}"
                                type="text"
                                v-model="firm.title"
                                :placeholder="$t('ob_name_ob')"
                                name="text"
                            />
                        </div>
                        <div class="panel-block__input-wrap form-group">
                            <input
                                class="panel-block__input form-control border-dotted"
                                :class="{'is-invalid':titleInService}"
                                type="text"
                                v-model="firm.service"
                                :placeholder="$t('ob_activity_ob')"
                                name="text"
                            />
                        </div>
                        <div class="border-dotted border-dotted--block">
                            <div class="fw-300 mb-2">{{$t('ob_type_ob')}}</div>
                            <label class="custom-input">
                                <input
                                    class="custom-input__input"
                                    type="radio"
                                    name="type"
                                    v-model="firm.type"
                                    value="1"
                                />
                                <span class="custom-input__lab"></span>
                                <span class="custom-input__text">{{$t('ob_type_kom_ob')}}</span>
                            </label>
                            <label class="custom-input">
                                <input
                                    class="custom-input__input"
                                    type="radio"
                                    name="type"
                                    v-model="firm.type"
                                    value="2"
                                />
                                <span class="custom-input__lab"></span>
                                <span class="custom-input__text">{{$t('ob_type_house_ob')}}</span>
                            </label>
                        </div>
                        <div class="panel-block__input-wrap form-group">
                            <input
                                class="panel-block__input form-control border-dotted"
                                type="text"
                                v-model="firm.phone"
                                :placeholder="$t('ob_phone_ob')"
                            />
                        </div>
                        <div class="panel-block__input-wrap form-group">
                            <input
                                class="panel-block__input form-control border-dotted"
                                type="text"
                                v-model="firm.site"
                                :placeholder="$t('ob_site_ob')"
                            />
                        </div>
                        <div class="panel-block__input-wrap form-group">
                            <input
                                class="panel-block__input form-control border-dotted"
                                type="email"
                                v-model="firm.email"
                                :placeholder="$t('ob_email_ob')"
                            />
                        </div>
                        <dropzone-comp ref="upload" v-on:SetImagesChild="SetImages"></dropzone-comp>
                    </div>
                    <div class="col-lg-6 d-flex flex-column">
                        <div
                            class="accordion-item accordion-item--js border-dotted border-dotted border-dotted--block"
                        >
                            <div class="accordion-item__toggle accordion-item__toggle--js">{{$t('ob_time')}}</div>
                            <div class="accordion-item__dropdown accordion-item__dropdown--js">

                                <table>
                                    <tr>
                                        <td>{{$t('dayMo')}}</td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayMo.start"/>
                                        </td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayMo.end"/>
                                        </td>
                                        <td>
                                            <label class="time-select">
                                                <input
                                                    class="time-select__input"
                                                    type="checkbox"
                                                    v-model="firm.time_work.dayMo.notwork"
                                                />
                                                <span
                                                    class="time-select__text time-select__text--work"
                                                >{{$t('ob_work_day')}}</span>
                                                <span
                                                    class="time-select__text time-select__text--holiday"
                                                >{{$t('ob_out_day')}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$t('dayTu')}}</td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayTu.start"/>
                                        </td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayTu.end"/>
                                        </td>
                                        <td>
                                            <label class="time-select">
                                                <input
                                                    class="time-select__input"
                                                    v-model="firm.time_work.dayTu.notwork"
                                                    type="checkbox"
                                                />
                                                <span
                                                    class="time-select__text time-select__text--work"
                                                >{{$t('ob_work_day')}}</span>
                                                <span
                                                    class="time-select__text time-select__text--holiday"
                                                >{{$t('ob_out_day')}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$t('dayWE')}}</td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayWE.start"/>
                                        </td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayWE.end"/>
                                        </td>
                                        <td>
                                            <label class="time-select">
                                                <input
                                                    class="time-select__input"
                                                    v-model="firm.time_work.dayWE.notwork"
                                                    type="checkbox"
                                                />
                                                <span
                                                    class="time-select__text time-select__text--work"
                                                >{{$t('ob_work_day')}}</span>
                                                <span
                                                    class="time-select__text time-select__text--holiday"
                                                >{{$t('ob_out_day')}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$t('dayTH')}}</td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayTH.start"/>
                                        </td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayTH.start"/>
                                        </td>
                                        <td>
                                            <label class="time-select">
                                                <input
                                                    class="time-select__input"
                                                    v-model="firm.time_work.dayTH.notwork"
                                                    type="checkbox"
                                                />
                                                <span
                                                    class="time-select__text time-select__text--work"
                                                >{{$t('ob_work_day')}}</span>
                                                <span
                                                    class="time-select__text time-select__text--holiday"
                                                >{{$t('ob_out_day')}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$t('dayFR')}}</td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayFR.start"/>
                                        </td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.dayFR.end"/>
                                        </td>
                                        <td>
                                            <label class="time-select">
                                                <input
                                                    class="time-select__input"
                                                    v-model="firm.time_work.dayFR.notwork"
                                                    type="checkbox"
                                                />
                                                <span
                                                    class="time-select__text time-select__text--work"
                                                >{{$t('ob_work_day')}}</span>
                                                <span
                                                    class="time-select__text time-select__text--holiday"
                                                >{{$t('ob_out_day')}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$t('daySA')}}</td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.daySA.start"/>
                                        </td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.daySA.end"/>
                                        </td>
                                        <td>
                                            <label class="time-select">
                                                <input
                                                    class="time-select__input"
                                                    v-model="firm.time_work.daySA.notwork"
                                                    type="checkbox"
                                                />
                                                <span
                                                    class="time-select__text time-select__text--work"
                                                >{{$t('ob_work_day')}}</span>
                                                <span
                                                    class="time-select__text time-select__text--holiday"
                                                >{{$t('ob_out_day')}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$t('daySU')}}</td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.daySU.start"/>
                                        </td>
                                        <td>
                                            <input type="time" v-model="firm.time_work.daySU.end"/>
                                        </td>
                                        <td>
                                            <label class="time-select">
                                                <input
                                                    class="time-select__input"
                                                    v-model="firm.time_work.daySU.notwork"
                                                    type="checkbox"
                                                />
                                                <span
                                                    class="time-select__text time-select__text--work"
                                                >{{$t('ob_work_day')}}</span>
                                                <span
                                                    class="time-select__text time-select__text--holiday"
                                                >{{$t('ob_out_day')}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="form-group">
              <textarea
                  class="form-control border-dotted"
                  v-model="firm.comment"
                  :placeholder="$t('ob_comment')"
              ></textarea>
                        </div>
                        <button
                            class="panel-block__btn-add"
                            @click.prevent="send"
                            type="submit"
                        >{{$t('ob_button')}}
                        </button>
                    </div>
                </div>
                <div class="text-right mt-a mb-1">
                    <a class="tdn" href="#">{{$t('ob_back')}}</a>
                </div>
            </div>
            <div class="panel-block__footer d-lg-none">
                <img :src="banners" alt/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import DropzoneComp from "~/components/Dropzone/DropzoneComp.vue";

    export default {
        name: "Review",
        data() {
            return {
                isTitleFoto: false, //открытие названия
                photo: "/img/@2x/2019-09-06.png",
                firm: {
                    title: "",
                    service: "",
                    type: 1,
                    phone: "",
                    email: "",
                    site: "",
                    time_work: {
                        dayMo: {
                            start: "10:00",
                            end: "21:00",
                            notwork: false
                        },
                        dayTu: {
                            start: "10:00",
                            end: "21:00",
                            notwork: false
                        },
                        dayWE: {
                            start: "10:00",
                            end: "21:00",
                            notwork: false
                        },
                        dayTH: {
                            start: "10:00",
                            end: "21:00",
                            notwork: false
                        },
                        dayFR: {
                            start: "10:00",
                            end: "21:00",
                            notwork: false
                        },
                        daySA: {
                            start: "10:00",
                            end: "21:00",
                            notwork: true
                        },
                        daySU: {
                            start: "10:00",
                            end: "21:00",
                            notwork: true
                        }
                    },
                    comment: "",
                    photos: []
                },
                titleInValid: false,
                titleInService: false
            };
        },
        computed: {
            title() {
                if (this.$store.state.map.search.value !== "") this.isTitleFoto = true;
                return this.$store.state.map.search.value;
            },
            ...mapGetters({
                location: "map/search_latlng",
                address: "map/search_address",
                user: "auth/user",
                showMapYesNoSidebar:'map/showMapYesNoSidebar',
                banners: "firms/banners"
            })
        },

        components:{DropzoneComp},
        watch: {
            "firm.photos": function (newVal) {
                if (this.firm.photos.length > 0) {
                    return axios
                        .post("images-get", {name: this.firm.photos[0]})
                        .then(response => {
                            if (typeof response.data.err !== "undefined") {
                                this.photo = "/img/@2x/2019-09-06.png";
                            } else {
                                this.isTitleFoto = true;
                                this.photo = response.data.link;
                            }
                        });
                } else {
                    this.photo = "/img/@2x/2019-09-06.png";
                }
            }

        },
        mounted() {
            $(".accordion-item__toggle--js").click(function () {
                $(this)
                    .next()
                    .slideToggle(function () {
                        $(this)
                            .parents(".accordion-item--js")
                            .toggleClass("active");
                    });
            });
        },
        methods: {
            SetImages(images=false) {
                if (!images){
                    images=this.$refs.upload.getFieled();
                }
                let img_ar = [];
                images.forEach(img => {
                    img_ar.push(img.name);
                });
                this.firm.photos = img_ar;
            },
            send() {
                if (this.valid()) {
                    this.SetImages();
                    let data = {
                        firm: this.firm,
                        address: this.address,
                        location: this.location,
                        user_id: this.user.id,
                    };
                    axios({
                        method: "post",
                        url: "addFirm",
                        headers: {
                            Authorization: "Bearer " + this.$auth.token("laravel-vue-spa")
                        },
                        data: data
                    })
                        .then(response => {
                            if(typeof response.data.error!=="undefined"){
                                this.showShwal( "error",response.data.error)
                            }else{

                                this.showShwal( "success",this.$t('successAddFirm'))
                                this.$router.push({name: 'search'});
                                //обнуление поиска
                                $('#my-input-search').val('')
                                this.$store.commit('map/SET_SEARCH', {
                                    value: "",
                                    type: "",
                                    latlng:{
                                        lat: 0,
                                        lng: 0
                                    }
                                });

                            }
                        })
                        .catch(error => {
                            this.showShwal( "error",error)
                        });
                } else {
                    this.showShwal( "error",this.$t("errorAddFirm"))
                }
            },
            valid() {
                let valid = true;
                if (this.firm.title == "") {
                    valid = false;
                    this.titleInValid = true;
                } else {
                    this.titleInValid = false;
                }
                if (this.firm.service == "") {
                    valid = false;
                    this.titleInService = true;
                } else {
                    this.titleInService = false;
                }
                if (this.address == "") {
                    valid = false;
                }
                return valid;
            }
        }
    };
</script>

