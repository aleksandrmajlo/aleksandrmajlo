<template>
    <div>
        <div
            class="search-block__input-wrap"
            :class="{active:mobileSearch}"
            @keyup.enter="submitSearch">
            <input
                :value="query"
                @input="evt=>query=evt.target.value"
                class="search-block__input"
                id="searchInput"
                type="text"
                @focus="focusQ"
                @blur="blurQ"
                :placeholder="placeholder"
            />
            <button @click.prevent="submitSearch" class="search-block__btn" type="submit">
                <img src="/img/svg/search.svg" alt/>
            </button>
            <div class="search-block__dropdown myDropDown"
                 :class="{activeSearch:items!==null&&items.length>0&&showRouterLink}">
                   <span v-for="(item,index) in items" :key="item.id">
          <router-link
              v-if="item.type!==undefined"
              :to="{name:'search', query: { city: item.city, coord:item.lat_lng}}"
              @click.native="serchLinkPlace(item)"
              class="search-block__dropdown-item"
          >
            <img src="/img/placealtadd.svg" alt="">
            {{item.title}} {{item.country}}
          </router-link>
          <router-link
              v-else
              :to="'/object/'+item.id"
              @click.native="serchLink"
              class="search-block__dropdown-item">
               <img src="/img/database.svg" alt="">
            {{item.title}} {{item.address}}
          </router-link>
        </span>
            </div>
        </div>
        <!-- открытие закрытие результата -->
        <button
            @click.prevent="setActiveSearch"
            class="search-block__btn search-block__btn--show-js d-lg-none"
            type="button">
            <img src="/img/svg/search.svg" alt/>
        </button>
    </div>
</template>

<script>
    var preferredLanguage = window.navigator.language.split("-")[0];
    // import algoliasearch from "algoliasearch";
    import * as algoliasearch from "algoliasearch/lite";
    import {mapGetters} from "vuex";
    export default {
        name: "SearchFirms",
        computed: {
            ...mapGetters({
                locale: "lang/locale",
            })
        },
        data() {
            return {
                mobileSearch: false,
                showRouterLink: true,
                items: null,
                algoliasearch: null,
                query: "",
                placeholder: " ",
                placeholderLoad:{
                    ru:'поиск',
                    uk:'пошук',
                    en:'search',
                }
            };
        },
        watch: {
            query: {
                handler: _.debounce(function () {
                    if (this.query.length > 2) {
                        this.showRouterLink = true;
                        this.searchFirms();

                    } else {
                        this.showRouterLink = false;
                    }
                }, 100)
            }
        },
        mounted() {
            this.placeholder = this.placeholderLoad[this.locale];
        },
        methods: {
            searchFirms() {
                axios
                    .get("search", {
                        params: {
                            q: this.query
                        }
                    })
                    .then(response => {
                        this.items = response.data.firms;
                        this.searchPlaces();
                    });
            },
            submitSearch() {
                this.showRouterLink = false;
                this.mobileSearch = false;
                this.$router.push({name: "search", query: {q: this.query}});
            },
            setActiveSearch() {
                this.mobileSearch = !this.mobileSearch;
                if (this.mobileSearch) {
                    document.getElementById("searchInput").focus();
                }
            },
            serchLink() {
                this.query = "";
                this.clickRouterLinkActive();
            },
            // клик по ссылке перейти
            serchLinkPlace(item) {
                this.query = "";
                this.clickRouterLinkActive();
                this.$store.commit("map/SET_SEARCH", {
                    value: item.title,
                    type: "searchCity",
                    latlng: item.coord
                });
            },
            // поиск по адресу
            ///*
            searchPlaces() {
                algoliasearch
                    .initPlaces(appId, apiKey)
                    .search({
                        query: this.query,
                        // type: "address",
                        hitsPerPage: 5,
                        aroundLatLngViaIP: false,
                        // language: preferredLanguage
                    })
                    .then(response => {
                        var hits = response.hits;
                        if (hits && hits.length > 0) {
                            if (this.items == null) {
                                this.items = []
                            }
                            // console.log(hits, 'hits');
                            for (let index = 0; index < hits.length; index++) {
                                const element = hits[index];
                                let res = [];
                                res.push(element.locale_names.default[0]);
                                let administrative = element.administrative[0];
                                res.push(administrative);
                                if (element.county !== undefined) {
                                    if (element.admin_level !== 2) {
                                        let county = element.county.default[0];
                                        res.push(county);
                                    }
                                }
                                let res_uniq = _.uniq(res);
                                this.items.push({
                                    title: res_uniq.join(','),
                                    city: element.locale_names.default[0],
                                    country: element.country.default,
                                    coord: element["_geoloc"],
                                    lat_lng: element["_geoloc"]['lat'] + '_' + element["_geoloc"]['lng'],
                                    type: "geoloc"
                                })
                            }
                        }

                    });
            },
            focusQ() {
                this.placeholder = this.$t('search_placholder');
            },
            blurQ() {
                this.placeholder = this.$t('search_small');
            },

        }
    };
</script>




