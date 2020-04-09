<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar"
         @slide-close-end="slideCloseEnd"
         class="sidebarLeft sidebarLeft--main section container-fluid features" id="sidebarLeft">
        <div class="panel-block panel-block--lg">
            <img src="/img/@2x/img.jpg" alt/>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    export  default {
        computed:{
            ...mapGetters({
                showMapYesNoSidebar:'map/showMapYesNoSidebar'
            })
        },
        methods:{
            slideCloseEnd(){

            }
        }
    }
</script>
