<template>

    <div class="col  d-lg-block">
        <div class="dropdown dropdown--js">
            <div v-if="!$auth.check()||!check">
                <router-link to="/login" @click.native="clickRouterLinkActive"
                             class="dropdown__toggle  d-none d-lg-block">
                    <svg class="icon icon-user">
                        <use xlink:href="/img/svg/sprite.svg#user"/>
                    </svg>
                </router-link>
                <div class="dropdown__block dropdown__block--form" :class="{active:isLogin}">
                    <div class="form-wrap">
                        <div class="alert alert-danger" v-if="login_error">
                            <p>{{$t('login_error')}}</p>
                        </div>
                        <form autocomplete="off" @submit.prevent="login" method="post">
                            <p class="text-center text-primary">{{$t('login_form_text')}}</p>
                            <div class="form-wrap__input-wrap form-group">
                                <input
                                    class="form-wrap__input form-control"
                                    type="email"
                                    placeholder="Email"
                                    :class="{'is-invalid':has_error && errors.email}"
                                    v-model="email"
                                />
                                <span class="invalid-feedback"
                                      v-if="has_error && errors.email">{{ errors.email[0] }}</span>
                            </div>
                            <div class="form-wrap__input-wrap form-group">
                                <input
                                    class="form-wrap__input form-control"
                                    type="password"
                                    placeholder="Password"
                                    v-model="password"
                                    :class="{'is-invalid':has_error && errors.password}"
                                />
                                <span class="invalid-feedback" v-if="has_error && errors.password">{{ errors.password[0] }}</span>
                            </div>
                            <button class="btn btn-primary btn-block mb-2" type="submit">{{$t('login_button_send')}}
                            </button>
                            <router-link
                                class="btn btn-outline-primary btn-block"
                                @click.native="hideLogin"
                                to="/register"
                            >{{$t('login_button_reg')}}
                            </router-link>
                        </form>
                    </div>
                </div>
            </div>
            <div v-else>
                <router-link to="/account" @click.native="clickRouterLinkActive"
                             class="dropdown__toggle d-none d-lg-block">
                    <svg class="icon icon-user">
                        <use xlink:href="/img/svg/sprite.svg#user"/>
                    </svg>
                </router-link>
            </div>
        </div>
    </div>

</template>
<script>
    import {mapGetters} from "vuex";

    export default {
        name: "LoginBlock",
        data() {
            return {
                isLogin: false,
                email: null,
                password: null,
                has_error: false,
                login_error: false,
                error: "",
                errors: []
            };
        },
        computed: mapGetters({
            user: "auth/user",
            check: "auth/check"
        }),
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    if (to.name == "login") {
                        this.isLogin = true;
                    } else {
                        this.isLogin = false;
                    }
                }
            }
        },
        methods: {
            hideLogin() {
                this.isLogin = false;
            },
            login() {
                var app = this;
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                        this.$router.push({name: "account"});
                    },
                    error: function (res) {
                        if (typeof res.response.data.error !== "undefined") {
                            app.login_error = true;
                            app.error = ""
                            app.errors = {}
                            app.has_error = false;

                        } else {
                            app.login_error = false;
                            app.error = res.response.data.status
                            app.errors = res.response.data.errors || {}
                            app.has_error = true;
                        }


                    },
                    rememberMe: true,
                    fetchUser: true
                });
            }
        }
    };
</script>

