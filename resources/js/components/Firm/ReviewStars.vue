<template>

    <div class="star-block" :class="classMy">
        <svg
            class="icon icon-icon_feather-star"
            v-for="rating in ratings"
            :class="{'text-primary': ((value >= rating) && value != null), 'is-disabled': disabled}"
            v-on:click="set(rating)"
            v-on:mouseover="star_over(rating)"
            v-on:mouseout="star_out"
        >
            <use xlink:href="/img/svg/sprite.svg#icon_feather-star"/>
        </svg>
    </div>
</template>

<script>
    export default {
        name: "ReviewStars",
        props: {
            start_value: null,
            disabled: Boolean,
            classMy:String
        },
        data: function () {
            return {
                temp_value: null,
                ratings: [1, 2, 3, 4, 5],
                value: null
            };
        },
        created() {
            this.value = this.start_value;
        },
        methods: {
            star_over: function (index) {
                if (!this.disabled) {
                    this.temp_value = this.value;
                    return (this.value = index);
                }
            },

            star_out: function () {
                if (!this.disabled) {
                    return (this.value = this.temp_value);
                }
            },

            set: function (value) {
                if (!this.disabled) {
                    this.temp_value = value;
                    this.$emit("input", value);
                    return (this.value = value);
                }
            }
        }
    };
</script>
