<template>
    <div class="panel-block__head bg-wrap" v-show="photos.length>0">
        <!-- карусель -->
        <div class="carusel carusel--js swiper-container invisible">
            <div class="swiper-wrapper">
                <div
                    class="carusel__slide swiper-slide"
                    v-for="(photo,index) in photos"
                    :key="index"
                >
                    <a class="carusel__img-wrap bg-wrap" :href="photo.photo" data-fancybox="gal">
                        <img class="res-i object-fit-js img-bg swiper-lazy" :data-src="photo.resized" alt/>
                        <div class="swiper-lazy-preloader"></div>
                    </a>
                </div>
            </div>
        </div>
        <!-- карусель end-->
    </div>
</template>

<script>
    export default {
        name: "Photos",
        data() {
            return {
                swiper: null,
            }
        },
        props:{
            photos:{
                type:Array,
                default:[]
            }
        },
        mounted(){
            this.swiperSet()
        },
        methods: {
            swiperSet() {
                if (this.photos.length > 0) {
                            this.swiper = new Swiper(".carusel--js", {
                                slidesPerView: 3,
                                spaceBetween: 15,
                                loop: false,
                                preloadImages: false,
                                lazy: true,
                                on: {
                                    init: function () {
                                        $(".carusel--js").removeClass("invisible");
                                    }
                                }
                            });
                }
            }
        }
    }
</script>

