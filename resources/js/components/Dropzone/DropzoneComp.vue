<template>
    <div>
        <div id="prevViewDropThumb"></div>
        <div class="form-group">
            <vue-dropzone
                class="dropzone"
                ref="myVueDropzone"
                id="dropzone"
                :destroyDropzone="false"
                @vdropzone-sending="sending"
                @vdropzone-success="suc"
                @vdropzone-removed-file="remove"
                :include-styling="false"
                :options="dropzoneOptions"
                :useCustomSlot="true"
            >
                <div class="dropzone__prev-wrap">
                    {{$t('ob_photo1')}}
                    <span class="text-primary">{{$t('ob_photo2')}}</span>
                    {{$t('ob_photo3')}}
                </div>
            </vue-dropzone>
        </div>
    </div>
</template>

<script>
    import vue2Dropzone from "vue2-dropzone";
    import Dropzone from "dropzone";
    import {mapGetters} from 'vuex'
    Dropzone.autoDiscover = false;
    export default {
        name: "DropzoneComp",
        data() {
            return {
                dropzoneOptions: {
                    url: "/api/images-save",
                    thumbnailWidth: 100,
                    maxFilesize: 5,
                    acceptedFiles: ".jpeg,.jpg,.png",
                    uploadMultiple: true,
                    parallelUploads: 2,
                    addRemoveLinks: true,
                    dictRemoveFile: "Remove",
                    dictFileTooBig: "Image is larger than 5MB",
                    previewsContainer: "#prevViewDropThumb",
                }
            };
        },
        computed: {
            ...mapGetters({
                    user: 'auth/user'
                }
            )
        },
        components: {
            vueDropzone: vue2Dropzone
        },
        methods: {
            getFieled(){
                let files = this.$refs.myVueDropzone.getAcceptedFiles();
                return files;
            },
            sending(file, xhr, formData) {
                if(this.user){
                    formData.append('user_id', this.user.id);
                }
            },
            suc(file, response) {
                let files = this.$refs.myVueDropzone.getAcceptedFiles();
                this.$emit('SetImagesChild', files)
            },
            remove(file, error, xhr) {
                axios.post("images-delete", {name: file.name}).then(response => {
                    let files = this.$refs.myVueDropzone.getAcceptedFiles();
                    this.$emit('SetImagesChild', files)
                });
            }
        }
    };
</script>

