<template>
    <div class="search-block__input-wrap">
        <input id="my-input-search" class="search-block__input" type="text"
               :placeholder="$t('search')"/>
        <button class="search-block__btn" onclick="return false" type="submit">
            <img src="/img/svg/search.svg" alt=""/>
        </button>
        <button class="search-block__btn search-block__btn--show-js d-lg-none" onclick="return false" type="button">
            <img src="/img/svg/search.svg" alt=""/>
        </button>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    const options = {
        // на день
        // appId: 'plNE57FG36HY',
        // apiKey: '4ca625b39b5b1e2f8c4282d51de2135a',
        //100 0000
        appId: 'plGI4WX834ON',
        apiKey: 'c6b248d20b8626e86fa7785893a9160c',
        container: '#my-input-search',
        style: false,
    };
    const reconfigurableOptions = {
        language: 'ru',
        type: 'address',
        aroundLatLngViaIP: false
    };

    export default {
        name: "SearchPlaces",
        data() {
            return {
                places: null,
            }
        },
        mounted() {
            this.places = places(options).configure(reconfigurableOptions);
            this.places.on('change', (e) => {
                if (e.suggestion.length === 0) return false;
                let res = e.suggestion;
                this.$store.commit('map/SET_SEARCH', {
                    value: res.value,
                    type: res.type,
                    latlng: res.latlng,
                })
            });
        }
    }
</script>

