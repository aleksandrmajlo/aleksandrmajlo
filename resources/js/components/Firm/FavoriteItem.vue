<template>
    <div class="favoriteBlock">
        <a v-if="!inFavorite" href="#" @click.prevent="addFavotite">
            {{$t('addFavorite')}}
            <img src="/img/round-favorite-border.svg">
        </a>
        <a v-else href="#" @click.prevent="removeFavotite">
            {{$t('removeFavorite')}}
            <img src="/img/sharp-favorite.svg">
        </a>
    </div>
</template>
<script>
    import Cookies from 'js-cookie'
    export default {
        name: "FavoriteItem",
        data() {
            return {
                inFavorite: false,
            }
        },
        props: {
            firm: {
                type: Object,
                required: true
            },
        },
        created() {
            let FavoriteItems = Cookies.get('FavoriteItems');
            if (typeof FavoriteItems !== "undefined") {
                let arr = JSON.parse(FavoriteItems);
                if (arr.indexOf(this.firm.id) != -1) {
                    this.inFavorite = true;
                }
            }
        },
        methods: {
            addFavotite() {
                let FavoriteItems = Cookies.get('FavoriteItems');
                if (typeof FavoriteItems !== "undefined") {
                    let arr = JSON.parse(FavoriteItems);
                    arr.push(this.firm.id);
                    let json_str = JSON.stringify(arr);
                    Cookies.set('FavoriteItems', json_str, {expires: 365});
                } else {
                    let items = [this.firm.id];
                    let json_str = JSON.stringify(items);
                    Cookies.set('FavoriteItems', json_str, {expires: 365});
                }
                this.inFavorite = true;
            },
            removeFavotite() {
                let FavoriteItems = Cookies.get('FavoriteItems');
                let arr = JSON.parse(FavoriteItems);
                let ind = arr.indexOf(this.firm.id)
                if (ind != -1) {
                    arr.splice(ind, 1);
                    if (arr.length > 0) {
                        let json_str = JSON.stringify(arr);
                        Cookies.set('FavoriteItems', json_str, {expires: 365});
                    } else {
                        Cookies.remove('FavoriteItems')
                    }
                }
                this.inFavorite = false;
            }
        }
    }
</script>

