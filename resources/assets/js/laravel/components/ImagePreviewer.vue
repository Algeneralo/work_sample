<template>
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' :name="name" :id="name" accept="image/*" @change="readURL"/>
            <label :for="name" class="d-flex justify-content-center align-items-center"><i
                    class="fas fa-pencil-alt"></i>
            </label>
        </div>
        <img v-if="src" :src="image" alt="" :width="width" :height="height" :class="imageClass">
    </div>
</template>

<script>
    export default {
        name: "ImagePreviewer",
        props: {
            name: {
                default: "image"
            },
            src: {
                default: ""
            },
            width: {
                default: "100%"
            },
            height: {
                default: "auto"
            }, imageClass: {
                default: ""
            },
        },
        data() {
            return {
                image: '',
            }
        },
        mounted() {
            this.image = this.src
        },
        methods: {
            readURL(e) {
                let input = e.target
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    let file = input.files[0];

                    if (file.type.match('image.*')) {
                        reader.onload = (e) => this.image = e.target.result;
                        reader.readAsDataURL(input.files[0]);
                    } else
                        alert("Please upload image files only");
                }
            }
        }
    }

</script>

<style lang="scss" scoped>

    .avatar-upload {
        position: relative;
        margin: 10px auto;

        .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;

            input {
                display: none;

                + label {
                    display: inline-block;
                    width: 25px;
                    height: 25px;
                    margin-bottom: 0;
                    border-radius: 100%;
                    background: #FFFFFF;
                    border: 1px solid transparent;
                    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.12);
                    cursor: pointer;
                    font-weight: normal;
                    transition: all 0.2s ease-in-out;

                    i {
                        font-size: 14px;
                    }

                    &:hover {
                        background: #f1f1f1;
                        border-color: #d6d6d6;
                    }

                    &:after {
                        display: inline-block;
                        font: normal normal normal 24px/1 "Material Design Icons";
                        font-size: inherit;
                        text-rendering: auto;
                        line-height: inherit;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                        color: #757575;
                        position: absolute;
                        top: 10px;
                        left: 0;
                        right: 0;
                        text-align: center;
                        margin: auto;
                    }
                }
            }
        }

        img {
            object-fit: cover;
        }
    }


</style>