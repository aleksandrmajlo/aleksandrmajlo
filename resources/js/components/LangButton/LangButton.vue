<template>
    <div class="dropdown__block dropdown__block--menu " :class="active">
        <div class="menu-map">
            <a class="menu-map__btn" :class="{active:mapname=='Yandex'}"  @click.prevent="setMap('Yandex')" href="#">Yandex</a>
            <a class="menu-map__btn" :class="{active:mapname=='Google'}" @click.prevent="setMap('Google')" href="#">Google</a>
            <a class="menu-map__btn" :class="{active:mapname=='OpenStreet'}" @click.prevent="setMap('OpenStreet')"  href="#">OpenStreet</a>
        </div>
        <p class="text-center text-primary">{{ $t('select_lang') }}</p>
               <flag></flag>
        <div v-if="$auth.check()" class="dropdown__divider"></div>
        <div class="nav" v-if="$auth.check()">
            <a class="nav__link" href="#">
                                            <span class="nav__icon-wrap">
										        <svg class="icon icon-speak ">
											       <use xlink:href="/img/svg/sprite.svg#speak"></use>
										        </svg>
                                            </span>{{$t('mess')}}
            </a>
            <router-link to="/favorite" class="nav__link">
                          <span class="nav__icon-wrap">
										        <svg class="icon icon-icon_feather-star ">
											       <use xlink:href="/img/svg/sprite.svg#icon_feather-star"></use>
										        </svg>
                          </span>{{$t('favorite')}}
            </router-link>
            <router-link  class="nav__link" to="/addobject">
                     <span class="nav__icon-wrap">
						 <svg class="icon icon-map_marker ">
											        <use xlink:href="img/svg/sprite.svg#map_marker"></use>
						 </svg>
                     </span>{{ $t('addObject') }}
            </router-link>

        </div>
        <div class="dropdown__divider"> </div>
        <div class="nav text-center">
            <a class="nav__link" href="#">
                {{$t('advertising_in')}} wikirent.info
            </a>
            <a class="nav__link" href="#">
                {{$t('error_send')}}
            </a>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "LangButton",
        props:['active'],
        computed: {
            ...mapGetters({
                mapname: 'map/mapname',
            }),

        },
        methods:{
            setMap(map){
                  if(map!==this.map)this.$store.commit('map/ACTIVE_MAP', map)
            }
        }

    }
</script>

