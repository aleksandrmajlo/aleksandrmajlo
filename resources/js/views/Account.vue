<template>
    <div
        v-show-slide:400:ease="showMapYesNoSidebar"
        class="sidebarLeft sidebarLeft--md section container-fluid sidebarLeft sidebarLeft--addPhoto features"
        id="sidebarLeft"
    >
        <div class="panel-block panel-block--md border border-primary">
            <div class="panel-block__body">
                <div v-if="check">
                    <h2>{{$t('personal_title')}}</h2>
                    <dl class="row">
                        <dt class="col-sm-3">{{$t('name_form')}}</dt>
                        <dd class="col-sm-9">{{user.name}}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{user.email}}</dd>
                    </dl>
                    <div class="text-center">
                        <a @click.prevent="$auth.logout()" class="btn btn-outline-primary">Logout</a>
                    </div>
                </div>
                <div v-else>
                    <router-link class="btn btn-outline-primary" to="login">Login</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Account",
        computed: {
            ...mapGetters({
                user: "auth/user",
                check: "auth/check",
                showMapYesNoSidebar: 'map/showMapYesNoSidebar'
            })
        },
        watch: {
            check(newVal) {
                if (!newVal) {
                    this.$router.push({name: "login"});
                }
            }
        }
    };
</script>

