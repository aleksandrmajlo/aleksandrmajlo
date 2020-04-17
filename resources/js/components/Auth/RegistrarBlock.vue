<template>

    <div class="modal-reg" v-show="isShow">
        <div class="form-wrap">
            <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Ошибка (и) проверки, пожалуйста, смотрите сообщение (я) ниже.</p>
                    <p v-else>{{$t('error_reg')}}</p>
                </div>
                <div class="form-wrap__input-wrap form-group">
                    <input class="form-wrap__input form-control form-control-lg" type="text"
                           :class="{'is-invalid':has_error && errors.name}"
                           :placeholder="$t('name_form')" v-model="name"/>
                    <span class="invalid-feedback" v-if="has_error && errors.name">{{ errors.name[0] }}</span>
                </div>
                <div class="form-wrap__input-wrap form-group">
                    <input class="form-wrap__input form-control form-control-lg" type="password" :placeholder="$t('pass_form')"
                           :class="{'is-invalid':has_error && errors.password}"
                           v-model="password"/>
                    <span class="invalid-feedback" v-if="has_error && errors.password">{{ errors.password[0] }}</span>
                </div>
                <div class="form-wrap__input-wrap form-group">
                    <input class="form-wrap__input form-control form-control-lg" type="password"
                           :placeholder="$t('pass_conf_form')" v-model="password_confirmation"/>
                </div>
                <div class="form-wrap__input-wrap form-group">
                    <input class="form-wrap__input form-control form-control-lg" type="email" placeholder="@mail"
                           v-model="email"
                           :class="{'is-invalid':has_error && errors.email}" />
                    <span class="invalid-feedback" v-if="has_error && errors.email">{{ errors.email[0] }}</span>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">{{$t('button_reg')}}</button>
                <router-link @click.native="clickRouterLinkActive" class="btn btn-primary btn-lg btn-block btn-reset" to="/">{{$t('cancel_reg')}}</router-link>
            </form>
            <p  v-if="success">
                Вы зарегистрировались.Войдите под своим логином
            </p>
        </div>
    </div>

</template>

<script>
    export default {
        name: "RegistrarBlock",
        data() {
            return {
                isShow: false,
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                has_error: false,
                error: '',
                errors: {},
                success: false
            }
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    if (to.name == 'register') {
                        this.isShow = true;
                    } else {
                        this.isShow = false;
                    }
                }
            }
        },
        methods: {
            register() {
                var app = this
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation
                    },
                    success: function () {
                        app.success = true
                        this.$router.push({
                            name: 'login',
                            params: {successRegistrationRedirect: true}
                        })
                    },
                    error: function (res) {
                        app.has_error = true
                        app.error = res.response.data.error
                        app.errors = res.response.data.errors || {}
                    }
                })
            }
        }
    }
</script>
