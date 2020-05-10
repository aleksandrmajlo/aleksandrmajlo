<template>
    <div>
        <div
            class="search-block__input-wrap"
            :class="{active:mobileSearch}"
            @keyup.enter="submitSearch"
        >
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
            <div
                class="search-block__dropdown myDropDown"
                :class="{activeSearch:items!==null&&items.length>0&&showRouterLink}"
            >
            <span v-for="(item,index) in items" :key="item.id" v-if="item.type==undefined">
               <router-link
                   :to="'/object/'+item.id"
                   @click.native="serchLink(item)"
                   class="search-block__dropdown-item" >
                  <img src="/img/database.svg" alt/>
                  {{item.title}} <span v-if="item['address_'+locale]">{{item['address_'+locale]}}</span><span v-else>{{item.address}}</span>
               </router-link>
              </span>
                <span v-for="(item,index) in items" :key="item.id" v-if="item.type!==undefined">
               <router-link
                   :to="{name:'search', query: {title:item.title}}"
                   @click.native="serchLinkPlace(item)"
                   class="search-block__dropdown-item"
               >
               <img src="/img/placealtadd.svg" alt/>
                    {{item.title}}
               </router-link>
             </span>
            </div>
        </div>
        <!-- открытие закрытие результата -->
        <button
            @click.prevent="setActiveSearch"
            class="search-block__btn search-block__btn--show-js d-lg-none"
            type="button"
        >
            <img src="/img/svg/search.svg" alt/>
        </button>
    </div>
</template>

<script>
    var preferredLanguage = window.navigator.language.split("-")[0];
    // import algoliasearch from "algoliasearch";
    import * as algoliasearch from "algoliasearch/lite";
    import {eventBus} from '~/app';
    import {mapGetters} from "vuex";

    export default {
        name: "SearchFirms",
        computed: {
            ...mapGetters({
                locale: "lang/locale"
            })
        },
        data() {
            return {
                mobileSearch: false,
                showRouterLink: true,
                items: [],
                Сheckitems: {
                    firms: [],
                    location: []
                },
                algoliasearch: null,
                query: "",
                placeholder: " ",
                placeholderLoad: {
                    ru: "поиск",
                    uk: "пошук",
                    en: "search"
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
            let app = this;
            this.placeholder = this.placeholderLoad[this.locale];
            $(document).click(function (e) {
                let el = e.target;
                let id = el.id;
                let par = $(el).parents('.myDropDown');
                if (id !== "searchInput" && par.length == 0 && !$(el).hasClass('myDropDown')) {
                    app.showRouterLink = false;
                }
            });

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
                        this.Сheckitems.firms = response.data.firms;
                        // this.items = response.data.firms;
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
            // клик на объекте с базы
            serchLink(item) {
                // this.query = "";
                this.showRouterLink = false;
                this.clickRouterLinkActive();
                eventBus.$emit('setFirmCoord',item);
            },
            // клик по ссылке перейти
            serchLinkPlace(item) {
                // this.query = "";
                this.showRouterLink = false;
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
                this.Сheckitems.location = []
                algoliasearch
                    .initPlaces(appId, apiKey)
                    .search({
                        query: this.query,
                        type: "address",
                        hitsPerPage: 5,
                        aroundLatLngViaIP: false,
                        // language: preferredLanguage
                    })
                    .then(response => {
                        var hits = response.hits;
                        if (hits && hits.length > 0) {
                            for (let index = 0; index < hits.length; index++) {

                                const hit = hits[index];
                                let resType = {};

                                //***********************************
                                let name=hit.locale_names.default[0];
                                resType.name=name;
                                //***********************************

                                //******************************************
                                var country = hit.country.default;
                                resType.country=country;
                                //******************************************

                                //******************************************
                                let administrative = hit.administrative && hit.administrative[0] !== name ? hit.administrative[0] : undefined;
                                resType.administrative=administrative;
                                //******************************************


                                //******************************************
                                var city=undefined;
                                if (typeof hit.city !== "undefined" && hit.city.default !== "undefined") {
                                    var city = hit.city && hit.city.default[0] !== name ? hit.city.default[0] : undefined;
                                    resType.city=city;
                                }
                                //******************************************


                                //******************************************
                                var suburb = hit.suburb && hit.suburb[0] !== name ? hit.suburb[0] : undefined;
                                resType.suburb=suburb;
                                //******************************************


                                //******************************************
                                var county = hit.county && hit.county.default[0] !== name ? hit.county.default[0] : undefined;
                                resType.county=county;
                                //******************************************

                                //******************************************
                                resType.type=this.findType(hit._tags);
                                //******************************************

                                let title=this.formatInputValue(resType)
                                this.Сheckitems.location.push({
                                    id: hit.objectID,
                                    title: title,
                                    // coord: hit["_geoloc"],
                                    // lat_lng: hit["_geoloc"]["lat"] + "_" + hit["_geoloc"]["lng"],
                                    type: "geoloc"
                                });
                            }
                        }
                        this.setItems();
                    });
            },
            // получить по поиску название прочее
            formatInputValue(_ref) {
                var administrative = _ref.administrative,
                    city = _ref.city,
                    country = _ref.country,
                    name = _ref.name,
                    type = _ref.type;
                var out = "".concat(name).concat(type !== 'country' && country !== undefined ? ',' : '', "\n ").concat(city ? "".concat(city, ",") : '', "\n ").concat(administrative ? "".concat(administrative, ",") : '', "\n ").concat(country ? country : '').replace(/\s*\n\s*/g, ' ').trim();
                return out;
            },
            findType(tags) {
                var types = {
                    country: 'country',
                    city: 'city',
                    'amenity/bus_station': 'busStop',
                    'amenity/townhall': 'townhall',
                    'railway/station': 'trainStation',
                    'aeroway/aerodrome': 'airport',
                    'aeroway/terminal': 'airport',
                    'aeroway/gate': 'airport'
                };

                for (var t in types) {
                    if (tags.indexOf(t) !== -1) {
                        return types[t];
                    }
                }

                return 'address';
            },

            setItems() {
                // console.log('***********************************************************************')
                let length_firms = this.Сheckitems.firms.length;
                let length_locations = this.Сheckitems.location.length;
                if (length_firms > 0) {
                    this.Сheckitems.firms.forEach((el, index) => {
                        let i = this.items.map(item => item.id).indexOf(el.id);
                        if (i == -1) {
                            this.items.push(this.Сheckitems.firms[index]);
                        }
                    });
                }
                if (length_locations > 0) {
                    this.Сheckitems.location.forEach((el, index) => {
                        let i = this.items.map(item => item.id).indexOf(el.id);
                        if (i == -1) {
                            this.items.push(this.Сheckitems.location[index]);
                        }
                    });
                }
                this.items.forEach((el, index) => {
                    if (el.type == "geoloc") {
                        if (length_locations > 0) {
                            let i = this.Сheckitems.location.map(item => item.id).indexOf(el.id);
                            if (i == -1) {
                                this.items.splice(this.items, 1)
                            }
                        } else {
                            this.items.splice(this.items, 1)
                        }

                    } else {
                        // проверка для фирм
                        if (length_firms > 0) {
                            let i = this.Сheckitems.firms.map(item => item.id).indexOf(el.id);
                            if (i == -1) {
                                this.items.splice(this.items, 1)
                            }
                        } else {
                            this.items.splice(this.items, 1)
                        }

                    }
                });
                // console.log('***********************************************************************')
            },
            focusQ() {
                this.placeholder = this.$t("search_placholder");
                if (this.query.length > 2) {
                    this.showRouterLink = true;
                }
            },
            blurQ() {
                this.placeholder = this.$t("search_small");
            }
        }
    };
</script>




