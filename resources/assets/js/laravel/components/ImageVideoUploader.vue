<template>
    <div class="uploader"
         @dragenter="OnDragEnter"
         @dragleave="OnDragLeave"
         @dragover.prevent
         @drop="onDrop"
         :class="{ dragging: isDragging }">

        <div class="upload-control" v-show="uploadedFile.length">
            <label for="file">{{trans("general.Select a file")}}</label>
        </div>


        <div v-show="!uploadedFile.length">
            <img src="/media/icons/file-upload.svg" alt="">
            <p>{{trans("general.Drag photo or video")}}</p>
            <div>{{trans("general.or")}}</div>
            <div class="file-input form-group">
                <label for="file" id="uploadButton">{{trans("general.Select a file")}}</label>
                <input ref="imageInput" :name="name" type="file" id="file" accept="image/*,video/*"
                       @change="onInputChange"
                       v-bind:required="required ? true : false">>
            </div>
        </div>

        <div class="uploadedFile-preview" v-show="uploadedFile.length">
            <div class="img-wrapper" v-for="(file, index) in uploadedFile" :key="index">
                <img v-if="files[index].type.match('image.*')" :src="file" :alt="`Image Uplaoder ${index}`">
                <video v-else :src="file" :alt="`Image Uplaoder ${index}`"></video>
                <div class="details">
                    <span class="name" v-text="files[index].name"></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {},
            multiple: {
                default: false
            },
            required: {
                default: true
            }
        },
        data: () => ({
            isDragging: false,
            dragCount: 0,
            files: [],
            uploadedFile: []
        }),
        mounted() {
            if (this.multiple)
                this.$refs["imageInput"].setAttribute("multiple", "multiple");
            let vue = this;
            this.$refs.imageInput.closest("form").addEventListener("reset", function () {
                vue.files = [];
                vue.uploadedFile = [];
            })
        },
        methods: {
            OnDragEnter(e) {
                e.preventDefault();

                this.dragCount++;
                this.isDragging = true;

                return false;
            },
            OnDragLeave(e) {
                e.preventDefault();
                this.dragCount--;

                if (this.dragCount <= 0)
                    this.isDragging = false;
            },
            onInputChange(e) {
                this.files = [];
                this.uploadedFile = [];

                const files = e.target.files;

                Array.from(files).forEach(file => this.addImage(file));
            },
            onDrop(e) {
                e.preventDefault();
                e.stopPropagation();
                this.files = [];
                this.uploadedFile = [];

                this.isDragging = false;
                const files = e.dataTransfer.files;

                Array.from(files).forEach(file => this.addImage(file));
            },
            addImage(file) {
                this.files.push(file);
                console.log(file)
                const reader = new FileReader();
                if (file.type.match('image.*')) {
                    reader.onload = (e) => this.uploadedFile.push(e.target.result);
                    reader.readAsDataURL(file);
                }
                if (file.type.match('video.*')) {
                    let blobURL = URL.createObjectURL(file);
                    this.uploadedFile.push(blobURL)
                }
            },
            getFileSize(size) {
                const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
                let i = 0;
                while (size > 900) {
                    size /= 1024;
                    i++;
                }

                return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
            }
        }
    }
</script>

<style lang="scss" scoped>
    $gray: #919191;
    $primary-color: #2F97DA;


    .uploader {
        width: 100%;
        background: #F4F7FC;
        color: rgba(59, 62, 69, 0.5);
        padding: 40px 0;
        text-align: center;
        border-radius: 5px;
        border: 1px dashed #9AA0A8;
        font-size: 20px;
        position: relative;

        #uploadButton {
            z-index: 99999;
        }


        &.dragging {
            background: #fff;
            color: $primary-color;
            border: 3px dashed $primary-color;

            .file-input label {
                background: $gray;
                color: #fff;
                font-style: italic;
            }
        }

        i {
            font-size: 85px;
        }

        .file-input {
            width: 200px;
            margin: auto;
            height: 68px;
            position: relative;

            label,
            input {
                background: $gray;
                color: #fff;
                width: 100%;
                position: absolute;
                left: 0;
                top: 0;
                padding: 10px;
                border-radius: 5px;
                margin-top: 7px;
                font-style: italic;
                cursor: pointer;
            }

            input {
                opacity: 0;
                z-index: -2;
            }
        }

        .uploadedFile-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 15px;

            .img-wrapper {
                width: 100%;
                display: flex;
                flex-direction: column;
                margin: 1px;
                height: 100%;
                justify-content: space-between;

                img {
                    margin-top: 10px;
                    max-height: 300px;
                    width: 100%;
                    object-fit: scale-down;
                }

                video {
                    width: 99%;
                }
            }

            .details {
                font-size: 12px;
                color: #000;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 3px 6px;

                .name {
                    overflow: hidden;
                    height: 18px;
                }
            }
        }

        .upload-control {
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
            padding: 10px;
            padding-bottom: 4px;
            text-align: right;
            border-bottom: 1px dashed;

            button, label {
                background: $gray;
                padding: 10px;
                border-radius: 5px;
                color: #fff;
                font-size: 15px;
                cursor: pointer;
            }

            label {
                padding: 6px 5px;
                margin-right: 10px;
            }
        }
    }
</style>