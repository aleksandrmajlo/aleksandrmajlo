<template>
    <div   v-show-slide:400:ease="showMapYesNoSidebar" class="sidebarLeft sidebarLeft--lg section container-fluid features" id="sidebarLeft">
        <div class="panel-block panel-block--lg border border-primary-light">
             <h2 class="text-center">Избранное</h2>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "Favorite",
        computed:{
            ...mapGetters({
                showMapYesNoSidebar:'map/showMapYesNoSidebar'
            })
        }
    }
</script>
