<template>
    <div class="dropdown dropdown--js">
        <div class="dropdown__toggle ">
            <svg class="icon icon-user " @click="isLogin=!isLogin">
                <use xlink:href="/img/svg/sprite.svg#user"></use>
            </svg>
        </div>

        <div class="dropdown__block dropdown__block--form" :class="{active:isLogin}">

            <div class="form-wrap" v-if="$auth.check()">
                <p class="text-success text-center">{{user.name}} {{user.email}}</p>
                <a href="#" class="btn btn-outline-primary btn-block" @click.prevent="$auth.logout()">Logout</a>
            </div>

            <div class="form-wrap" v-else>
                <div class="alert alert-danger" v-if="has_error">
                    <p>Ошибка, невозможно соединиться с этими идентификаторами.</p>
                </div>
                <form autocomplete="off" @submit.prevent="login" method="post">
                    <p class="text-center text-primary">Войти в аккаунт</p>
                    <div class="form-wrap__input-wrap form-group">
                        <input class="form-wrap__input form-control" type="text" placeholder="Login"
                               v-model="email"
                               name="text"/>
                    </div>
                    <div class="form-wrap__input-wrap form-group">
                        <input class="form-wrap__input form-control" type="password" placeholder="Password"
                               v-model="password"
                               name="password"/>
                    </div>
                    <button class="btn btn-primary btn-block mb-2" type="submit">Войти</button>
                    <router-link class="btn btn-outline-primary btn-block" @click.native="hideLogin" to="/register">
                        Регистрация
                    </router-link>
                </form>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        name: "LoginBlock",
        data() {
            return {
                isLogin: false,
                email: null,
                password: null,
                has_error: false,
                user: {
                    id: '',
                    name: '',
                    email: ''
                }
            }
        },
        created() {
            this.$auth.ready(function () {
                if (this.$auth.check()) {
                    this.$auth.fetch({
                        success: function (response) {
                            this.user=response.data.user;
                        }
                    })
                }
            });

        },
        mounted() {

        },
        watch: {
            '$route'(to, from) {
                if (to.name == 'login') {
                    this.isLogin = true;
                }
            }
        },
        methods: {
            hideLogin() {
                this.isLogin = false;
            },
            login() {
                var redirect = this.$auth.redirect()
                var app = this;
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                        const redirectTo = 'home'
                        this.$router.push({name: redirectTo})
                        app.$auth.fetch({
                            success: function (response) {
                                app.user = response.data.user;
                                console.log(response)
                            }
                        })
                    },
                    error: function () {
                        app.has_error = true
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }

        }
    }
</script>

