<template>
    <span>
        <span v-if="firm['address_'+locale]">{{firm['address_'+locale]}}</span>
        <span v-else>{{firm.address}}</span>
    </span>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "AddressFirm",
        props: {
            firm: {
                type: Object,
                required: true
            },
        },
        computed:{
            ...mapGetters({
                locale: "lang/locale",
            })
        }
    }
</script>

<style scoped>

</style>
