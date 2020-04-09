<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar"  class="features sidebarLeft sidebarLeft--md section container-fluid sidebarLeft sidebarLeft--addPhoto" id="sidebarLeft">
        <div class="panel-block panel-block--md border border-primary">
            <div class="panel-block__head bg-wrap" v-if="isTitleFoto">
                <!--                <img class="img-bg object-fit-js" src="/img/@2x/2019-09-06.png" alt=""/>-->
                <!--                <div class="panel-block__head-title">.-->
                <!--                    площа Перемоги, 3, <br/>Київ, Украина, <br/>секция или еще что-то-->
                <!--                </div>-->
            </div>
            <div class="panel-block__body">
                <div class="panel-block__link-add panel-block__link-add--title">
                    <span>{{$t('ob_photo')}} </span>
                    <svg class="icon icon-icon_material-add-a-photo ">
                        <use xlink:href="/img/svg/sprite.svg#icon_material-add-a-photo"></use>
                    </svg>
                </div>
                <div class="carusel carusel--js swiper-container">
                    <div class="swiper-wrapper">
                        <div class="carusel__slide swiper-slide">
                            <!--                            <a class="carusel__img-wrap bg-wrap" href="/img/@2x/1.jpg" data-fancybox="gal">-->
                            <!--                                <img class="res-i object-fit-js img-bg" src="/img/@1x/1.jpg" alt=""/>-->
                            <!--                            </a>-->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <vue-dropzone class="dropzone" ref="myVueDropzone" id="dropzone"
                                  :include-styling="false"
                                  :options="dropzoneOptions"  :useCustomSlot=true>
                        <div class="dropzone__prev-wrap">
                            {{$t('ob_photo1')}} <span class="text-primary">{{$t('ob_photo2')}}</span> {{$t('ob_photo3')}}
                        </div>
                    </vue-dropzone>
                    <!--
                                        <form class="dropzone" action="/file-upload" enctype="multipart/form-data">
                                            <div class="dropzone__prev-wrap">
                                                {{$t('ob_photo1')}} <span class="text-primary">{{$t('ob_photo2')}}</span> {{$t('ob_photo3')}}
                                            </div>
                                            <div class="fallback">
                                                <input  type="file" multiple=""/>
                                            </div>
                                        </form>

                    -->
                </div>
                <div class="form-group">
                    <input type="text" v-model="title" class="form-control border-dotted" :placeholder="$t('ob_name')"></input>
                </div>
                <div class="form-group">
                    <input type="text"  v-model="time_work"  class="form-control border-dotted" :placeholder="$t('ob_time')"></input>
                </div>
                <div class="form-group">
                    <textarea v-model="description" class="form-control border-dotted" :placeholder="$t('ob_desc')"></textarea>
                </div>
                <button class="panel-block__btn-add" type="submit">
                    {{$t('ob_button')}}
                </button>
                <!--
                <div class="text-left mt-a">
                    <a class="tdn text-body" href="#">вернуться к описанию</a>
                </div>
                -->
            </div>
            <div class="panel-block__footer">
                <img src="/img/@2x/banner-sm.jpg" alt=""/>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "ReadFirm",
        data(){
            return {
                isTitleFoto:false,//открытие названия
                title:'',
                time_work:'',
                description:"",
                dropzoneOptions: {
                    url: 'https://httpbin.org/post',
                    thumbnailWidth: 100,
                    maxFilesize: 1,
                    headers: { "My-Awesome-Header": "header value" }
                }

            }
        },
        computed:{
            ...mapGetters({
                showMapYesNoSidebar:'map/showMapYesNoSidebar'
            })
        }
        components: {
            vueDropzone: vue2Dropzone
        },
    }
</script>


