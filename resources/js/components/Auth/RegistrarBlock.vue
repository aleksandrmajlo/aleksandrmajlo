<template>

    <div class="modal-reg" v-show="isShow">


        <div class="form-wrap">

            <a class="closeRegister" href="#" @click.prevent="isShow=false">
                <img src="/img/svg/times-solid.svg">
            </a>

            <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Ошибка (и) проверки, пожалуйста, смотрите
                        сообщение (я) ниже.</p>
                    <p v-else>{{$t('error_reg')}}</p>
                </div>
                <div class="form-wrap__input-wrap form-group">
                    <input class="form-wrap__input form-control form-control-lg" type="text"
                           :class="{'is-invalid':has_error && errors.name}"
                           :placeholder="$t('name_form')" v-model="name"/>
                    <span class="invalid-feedback" v-if="has_error && errors.name">{{ errors.name[0] }}</span>
                </div>
                <div class="form-wrap__input-wrap form-group">
                    <input class="form-wrap__input form-control form-control-lg" type="password"
                           :placeholder="$t('pass_form')"
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
                           :class="{'is-invalid':has_error && errors.email}"/>
                    <span class="invalid-feedback" v-if="has_error && errors.email">{{ errors.email[0] }}</span>
                </div>
                <button class="btn btn-primary btn-lg btn-block"
                        :disabled="disabled"
                        type="submit">{{$t('button_reg')}}</button>
                <a @click.prevent="isShow=false" class="btn btn-primary btn-lg btn-block btn-reset" href="#">
                    {{$t('cancel_reg')}}
                </a>
            </form>
            <h4 v-if="success" >
                {{$t('reg_succes',{name:name})}}
            </h4>
        </div>
    </div>

</template>

<script>
    import {eventBus} from '~/app'
    export default {
        name: "RegistrarBlock",
        data() {
            return {
                isShow: false,
                disabled:false,
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
        created() {
            eventBus.$on('showRegister', () => {
                this.showRegisterForm();
            })
        },
        methods: {
            register() {
                var app = this;
                app.disabled=true;
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation
                    },
                    success: function () {
                        app.has_error = false
                        app.errors = {};
                        app.success = true;
                        app.disabled=false;
                        setTimeout(()=>{
                            app.isShow = false;
                        },3000)
                    },
                    error: function (res) {
                        app.has_error = true
                        app.error = res.response.data.error
                        app.errors = res.response.data.errors || {};
                        app.disabled=false;
                    }
                })
            },
            showRegisterForm() {
                this.isShow = true;
            }
        }
    }
</script>
