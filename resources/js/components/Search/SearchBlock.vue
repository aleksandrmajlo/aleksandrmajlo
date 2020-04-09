<template>
    <div class="overSearchBlock">
        <search-places v-if="isPlaces"></search-places>
        <search-firms v-else></search-firms>
    </div>
</template>

<script>
    import SearchPlaces from './SearchPlaces'
    import SearchFirms from './SearchFirms'
    export default {
        name: "SearchBlock",
        data(){
            return{
                isPlaces:false
            }
        },
        components:{SearchPlaces,SearchFirms},
        created() {
        },
        mounted() {
        },
        watch: {
            $route(to, from) {
                if (to.name == "addobject") {
                    this.isPlaces = true;
                } else {
                    this.isPlaces = false;
                }
            }
        }

    }
</script>
