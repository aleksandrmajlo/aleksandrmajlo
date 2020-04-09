<template>
    <div class="panel-block__link-add panel-block__link-add--title">
        <span>{{$t('ob_add_review')}} </span>
        <div class="star-block mb-1">
            <svg class="icon icon-icon_feather-star " v-for="rating in ratings"
                 :class="{'text-primary': ((value >= rating) && value != null), 'is-disabled': disabled}"
                 v-on:click="set(rating)" v-on:mouseover="star_over(rating)" v-on:mouseout="star_out">
                <use xlink:href="/img/svg/sprite.svg#icon_feather-star"></use>
            </svg>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReviewStars",
        props: {
            'value': null,
            'disabled': Boolean,
        },
        data: function () {
            return {
                temp_value: null,
                ratings: [1, 2, 3, 4, 5],
                // value: null,
                // disabled:false
            }
        },
        methods: {
            star_over: function (index) {
                if (!this.disabled) {
                    this.temp_value = this.value;
                    return this.value = index;
                }

            },

            star_out: function () {
                if (!this.disabled) {
                    return this.value = this.temp_value;
                }
            },

            set: function (value) {
                if (!this.disabled) {
                    this.temp_value = value;
                    return this.value = value;
                }
            }
        }
    }
</script>
