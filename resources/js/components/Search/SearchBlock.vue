<template>
    <div class="overSearchBlock">
        <search-firms></search-firms>
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
        components:{SearchFirms},
    }
</script>
