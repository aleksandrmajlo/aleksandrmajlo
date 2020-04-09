<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar" class="sidebarLeft sidebarLeft--lg section container-fluid features" id="sidebarLeft">

        <div class="panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <div class="col-lg-6">
                    <div class="panel-block__head bg-wrap">
                        <img class="img-bg object-fit-js" src="img/@2x/2019-09-06.png" alt=""/>
                        <div class="panel-block__head-title">площа Перемоги, 3, <br/>Київ, Украина, <br/>секция или еще что-то
                        </div>
                    </div>
                </div>
                <div class="col-6 d-none d-lg-block"><a class="head-banner" href="#"><span class="head-banner__img-wrap"><img src="img/@1x/img-without.jpg" alt=""/></span><span class="head-banner__text"> Самая эффективная реклама вашего бизнеса</span></a>
                </div>
            </div>
            <div class="panel-block__body">
                <div class="row pb-1">
                    <div class="col-lg-6">
                        <div class="panel-block__link-add panel-block__link-add--title"><span>Добавить объект</span>
                            <svg class="icon icon-map_marker ">
                                <use xlink:href="img/svg/sprite.svg#map_marker"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="col">
                        <form class="search-inner"><input class="search-inner__input" type="text" placeholder="начните вводить адрес"/>
                            <button class="search-inner__btn" type="submit"><img src="img/svg/search-bl.svg" alt=""/>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Golden Ostap
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Ірис
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Золотий Вік
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Київський Ювелірний Завод
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Онікс
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">СЮФ
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">SOVA
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Golden Ostap
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Pandora
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Golden Ostap
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Ірис
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Золотий Вік
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Київський Ювелірний Завод
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Онікс
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">СЮФ
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">SOVA
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Golden Ostap
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion-item border-dotted border-dotted border-dotted--block">
                            <div class="accordion-item__toggle">Pandora
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-a mb-1"><a class="tdn" href="#">вернуться к описанию</a></div>
            </div>
            <div class="panel-block__footer d-lg-none"><img src="img/@2x/banner-sm.jpg" alt=""/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "Search",
        computed:{
            ...mapGetters({
                showMapYesNoSidebar:'map/showMapYesNoSidebar'
            })
        }
    }
</script>

