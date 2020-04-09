<template>
        <div v-show-slide:400:ease="showMapYesNoSidebar" class="sidebarLeft sidebarLeft--md section container-fluid features ">
            <div class="panel-block panel-block--md border border-primary">
                <h3 class="text-center">
                    {{$t('page_not')}}
                </h3>
                <div class="text-center">
                    <router-link :to="{name:'home'}" class="btn btn-outline-primary">
                        {{$t('go_home')}}
                    </router-link>
                </div>
            </div>
        </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "NotFound",
        computed:{
            ...mapGetters({
                showMapYesNoSidebar:'map/showMapYesNoSidebar'
            })
        }
    }
</script>
