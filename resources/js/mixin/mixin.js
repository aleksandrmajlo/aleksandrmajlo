
export default{
     methods:{
         showShwal(icon,text){
             this.$swal.fire({
                 icon: icon,
                 text: text,
                 showConfirmButton: false,
                 closeOnClickOutside: false
             });
             setTimeout(() => {
                 this.$swal.close();
             }, 3000);
         }
     }
}
