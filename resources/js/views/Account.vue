<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid sidebarLeft sidebarLeft--addPhoto features"
        id="sidebarLeft"
    >
        <div class="panel-block panel-block--md border border-primary">
            <div class="panel-block__body">
                <div>
                    <h2>{{$t('personal_title')}}</h2>
                    <dl class="row">
                        <dt class="col-sm-5">{{$t('name_form')}}</dt>
                        <dd class="col-sm-7">{{user.name}}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-5">Email</dt>
                        <dd class="col-sm-7">{{user.email}}</dd>
                    </dl>
                    <div class="d-flex justify-content-between mb-2">

                       <router-link class="btn btn-outline-primary" to="/my_review">
                           {{$t('my_review')}}
                       </router-link>
                       <router-link class="btn btn-outline-primary" to="/my_firm">
                           {{$t('my_firm')}}
                       </router-link>

                    </div>
                    <div class="text-center">
                        <a @click.prevent="$auth.logout()" class="btn btn-outline-primary">Logout</a>
                    </div>
                </div>
            </div>
            <banner-botom></banner-botom>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import BannerBotom from '~/components/Banner/BannerBotom';

    export default {
        name: "Account",
        computed: {
            ...mapGetters({
                user: "auth/user",
                showMapYesNoSidebar: "map/showMapYesNoSidebar"
            })
        },
        components: {BannerBotom},
        watch: {
            check(newVal) {
                if (!newVal) {
                    this.$router.push({name: "login"});
                }
            }
        }
    };
</script>

