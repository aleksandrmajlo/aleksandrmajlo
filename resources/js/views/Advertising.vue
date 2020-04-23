<template>
    <div v-show-slide:400:ease="showMapYesNoSidebar"
         class="sidebarLeft sidebarLeft--lg section container-fluid " id="sidebarLeft">
        <div class="panel-block panel-block--lg border border-primary-light">
            <div class="row-head row no-gutters bg-primary-light text-white">
                <div class="col-lg-6">
                    <div class="panel-block__head bg-wrap BackBlueHeder">
                        <div class="panel-block__head-title">{{$t('advertising')}}</div>
                    </div>
                </div>
                <banner-top></banner-top>
            </div>
            <div class="panel-block__body">
                <h4 class="text-center" v-html="$t('advertising_text')"></h4>
                <form @submit.prevent="checkForm" class="formMess">
                    <div class="form-group ">
                        <label for="exampleInputEmail1">Email</label>
                        <input v-model="email" type="email"
                               :class="{ 'is-invalid': error.email }"
                               class="form-control " id="exampleInputEmail1"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="mess">{{$t('mess')}}</label>
                        <textarea v-model="messange"
                                  :class="{ 'is-invalid': error.messange }"
                                  id="mess" class="form-control"></textarea>
                    </div>
                    <button :disabled="disabled" type="submit" class="btn btn-primary">{{$t('form_submit')}}</button>
                </form>
            </div>
            <banner-botom classNone="d-lg-none"></banner-botom>
        </div>

    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    import BannerBotom from '~/components/Banner/BannerBotom';
    import BannerTop from "~/components/Banner/BannerTop";
    import localMixin from "~/mixin/local_mixin"

    export default {
        name: "Favorite",
        data() {
            return {
                email: "",
                messange: "",
                theme: 1,
                disabled: false,
                error: {
                    email: false,
                    messange: false,
                }
            }
        },
        mixins: [localMixin],
        components: {BannerBotom, BannerTop},
        computed: {
            ...mapGetters({
                showMapYesNoSidebar: "map/showMapYesNoSidebar"
            }),

        },
        methods: {

            checkForm() {
                if (this.validate()) {
                    this.disabled = true;
                    axios.post('send', {
                        email: this.email,
                        messange: this.messange,
                        theme: this.theme,
                    })
                        .then(() => {
                            this.email = "";
                            this.messange = "";
                            this.showShwal('success', this.$t('form_Succes'))
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                        .then(function () {
                            this.disabled = false;
                        });
                }
            }

        }
    };
</script>
