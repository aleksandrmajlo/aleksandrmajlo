<template>
    <div class="menu-lang">
        <a class="menu-lang__btn" :class="{active:locale=='ru'}" href="#" @click.prevent="setLocale('ru')">
                      <span class="menu-lang__img-wrap">
                           <img src="/img/svg/Flag_of_Russia.svg" alt=""/>
                      </span>RU
        </a>
        <a class="menu-lang__btn" href="#" :class="{active:locale=='uk'}" @click.prevent="setLocale('uk')">
                   <span class="menu-lang__img-wrap">
                         <img src="/img/svg/Flag_of_Ukraine-98.svg" alt=""/>
                   </span> UA
        </a>
        <a class="menu-lang__btn" :class="{active:locale=='en'}" href="#" @click.prevent="setLocale('en')">
            <span class="menu-lang__img-wrap">
                        <img src="/img/svg/Flag_of_the_United_Kingdom.svg" alt=""/>
            </span>EN
        </a>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {loadMessages} from '~/plugins/i18n'

    export default {
        name: "Flag",
        computed: mapGetters({
            locale: 'lang/locale',
            locales: 'lang/locales'
        }),
        methods: {
            setLocale(locale) {
                if (this.$i18n.locale !== locale) {
                    loadMessages(locale)
                    this.$store.dispatch('lang/setLocale', {locale})
                }
            }
        }
    }
</script>

<style scoped>
    a.menu-lang__btn.active {
        color: rgb(25, 120, 215) !important;
    }
</style>
