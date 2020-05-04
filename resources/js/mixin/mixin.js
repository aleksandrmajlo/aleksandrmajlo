import {
    mapGetters
} from "vuex";
export default {
    data() {
        return {
            Login_required: {
                ru: 'Требуется логин',
                uk: 'Необхідний вхід',
                en: 'Login required'
            }
        }
    },
    computed: {
        ...mapGetters({
            locale: 'lang/locale'
        })
    },
    methods: {
        showShwal(icon, text) {
            this.$swal.fire({
                icon: icon,
                text: text,
                showConfirmButton: false,
            });
            setTimeout(() => {
                this.$swal.close();
            }, 3000);
        },
        showLoader(data) {
            let settings = {
                loader: 'spinner',
                color: '#ecf5ff',
            };
            let res = Object.assign(settings, data)
            let loader = this.$loading.show(res);
            return loader;
        },
        clickRouterLinkActive(type = false) {
            this.$store.commit('map/ROUTERSHOWHIDDENSIDEBAR', true);
            if (type == 'auth' && !Vue.auth.check()) {
                this.showShwal('error', this.Login_required[this.locale])
            }
        }
    }
}
