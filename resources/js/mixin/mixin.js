export default {
    methods: {
        showShwal(icon, text) {
            this.$swal.fire({
                icon: icon,
                text: text,
                showConfirmButton: false,
                closeOnClickOutside: false
            });
            setTimeout(() => {
                this.$swal.close();
            }, 3000);
        },
        showLoader(data) {
            let settings = {
                loader: 'spinner',
                color: '#ecf5ff',
                // backgroundColor: '#ecf5ff',
            };
            let res = Object.assign(settings, data)
            let loader = this.$loading.show(res);
            return loader;
        },
        clickRouterLinkActive(event){
            // if($(event.target).hasClass('router-link-exact-active')){
                this.$store.commit('map/ROUTERSHOWHIDDENSIDEBAR', true);
            // }

        }
    }
}
