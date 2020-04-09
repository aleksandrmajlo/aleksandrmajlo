<template>
    <div>
        <div class="search-block__input-wrap">
            <input class="search-block__input" type="text" placeholder="начните вводить адрес"/>
            <button @click.prevent="submitSearch"  class="search-block__btn" type="submit">
                <img src="/img/svg/search.svg" alt=""/>
            </button>
            <div class="search-block__dropdown">
<!--                <div class="search-block__dropdown-title">-->
<!--                    недавние-->
<!--                </div>-->
                     <a class="search-block__dropdown-item" href="#">Lorem ipsum dolor sit amet.</a>
                     <a class="search-block__dropdown-item" href="#">Lorem ipsum dolor sit amet.</a>
                     <a class="search-block__dropdown-item" href="#">Lorem ipsum dolor sit amet.</a>
            </div>
        </div>
        <button @click.prevent="submitSearch" class="search-block__btn search-block__btn--show-js d-lg-none" type="button">
            <img src="/img/svg/search.svg" alt=""/>
        </button>
    </div>
</template>

<script>
    export default {
        name: "SearchFirms",

        methods:{
            submitSearch(){

            }
        }
    }
</script>


