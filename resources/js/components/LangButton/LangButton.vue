<template>
    <div class="dropdown__block dropdown__block--menu " :class="{active:mobile}">
        <div class="menu-map">
            <!--
            <a class="menu-map__btn" :class="{active:mapname=='Yandex'}" @click.prevent="setMap('Yandex')" href="#">Yandex</a>
            <a class="menu-map__btn" :class="{active:mapname=='Google'}" @click.prevent="setMap('Google')" href="#">Google</a>
            -->
            <a class="menu-map__btn" :class="{active:mapname=='OpenStreet'}" @click.prevent="setMap('OpenStreet')"
               href="#">OpenStreet</a>
        </div>
        <p class="text-center text-primary">{{ $t('select_lang') }}</p>
        <flag></flag>
        <div class="dropdown__divider"></div>
        <div class="nav" >
            <router-link :to="{name:'message'}" @click.native="clickRouterLinkActive" class="nav__link">
                   <span class="nav__icon-wrap">
					     <svg class="icon icon-speak ">
					       <use xlink:href="/img/svg/sprite.svg#speak"></use>
					     </svg>
                   </span>{{$t('mess')}}
            </router-link>
            <router-link to="/favorite" @click.native="clickRouterLinkActive" class="nav__link">
                          <span class="nav__icon-wrap">
								 <svg class="icon icon-icon_feather-star ">
								      <use xlink:href="/img/svg/sprite.svg#icon_feather-star"></use>
								 </svg>
                          </span>{{$t('favorite')}}
            </router-link>

            <router-link :to="{name:'addobject'}" @click.native="clickRouterLinkActive('auth')" class="nav__link">
                     <span class="nav__icon-wrap">
						 <svg class="icon icon-map_marker ">
							  <use xlink:href="/img/svg/sprite.svg#map_marker"></use>
						 </svg>
                     </span>{{ $t('addObject') }}
            </router-link>
            <router-link v-if="mobile" :to="{name:'account'}" @click.native="clickRouterLinkActive" class="nav__link">
                 <span class=" nav__icon-wrap">
						 <svg class="icon icon-map_marker ">
							  <use xlink:href="/img/svg/sprite.svg#user"></use>
						 </svg>
                 </span>
                {{$t('personal_title')}}
            </router-link>
        </div>
        <div class="dropdown__divider"></div>
        <div class="nav text-center">
            <router-link @click.native="clickRouterLinkActive"
                         class="nav__link" :to="{name:'advertising'}">
                {{$t('advertising_in')}} wikirent.info
            </router-link>
            <router-link @click.native="clickRouterLinkActive"
                         class="nav__link" :to="{name:'error'}">
                {{$t('error_send')}}
            </router-link>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Flag from '~/components/LangButton/Flag.vue'
    export default {
        name: "LangButton",
        components: {Flag},
        props: {
            mobile: {
                type: Boolean,
                defaulf: false
            }
        },
        computed: {
            ...mapGetters({
                mapname: 'map/mapname',
            })
        },
        methods: {
            setMap(map) {
                if (map !== this.map) this.$store.commit('map/ACTIVE_MAP', map)
            }
        }
    }
</script>

