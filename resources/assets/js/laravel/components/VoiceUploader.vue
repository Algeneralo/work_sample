<template>
    <div class="uploader"
         @dragenter="OnVoiceDragEnter"
         @dragleave="OnVoiceLeave"
         @dragover.prevent
         @drop="onVoiceDrop"
         :class="{ dragging: isVoiceDragging }">

        <div class="upload-control" v-show="voices.length">
            <label for="voice">{{trans("general.Select a file")}}</label>
        </div>

        <div v-show="!voices.length">
            <img src="/media/icons/file-upload.svg" alt="">
            <p>{{trans("general.drag-voice")}}</p>
            <div>{{trans("general.or")}}</div>
            <div class="file-input form-group">
                <label for="voice">{{trans("general.Select a file")}}</label>
                <input type="file" id="voice" accept="audio/*" @change="onVoiceInputChange" multiple>
            </div>
        </div>

        <div class="voices-preview" v-show="voices.length">
            <div class="voice-wrapper" v-for="(voice, index) in voices" :key="index">
                <div class="border rounded text-gray voice-box">
                    <i class="fa fa-microphone"></i>
                </div>
                <span class="voice-name" v-text="voiceFiles[index].name"></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            isVoiceDragging: false,
            voiceDragCount: 0,
            voiceFiles: [],
            voices: []
        }),
        methods: {
            OnVoiceDragEnter(e) {
                e.preventDefault();
                this.voiceDragCount++;
                this.isVoiceDragging = true;
                return false;
            },
            OnVoiceLeave(e) {
                e.preventDefault();
                this.voiceDragCount--;
                if (this.voiceDragCount <= 0)
                    this.isVoiceDragging = false;
            },
            onVoiceInputChange(e) {
                const voiceFiles = e.target.files;
                Array.from(voiceFiles).forEach(file => this.addImage(file));
            },
            onVoiceDrop(e) {
                e.preventDefault();
                e.stopPropagation();
                this.isVoiceDragging = false;
                const voiceFiles = e.dataTransfer.files;
                Array.from(voiceFiles).forEach(file => this.addImage(file));
            },
            addImage(file) {
                this.files = [];
                this.voices = [];
                if (!file.type.match('audio.*')) {
                    Codebase.helpers('notify', {
                        align: 'right',
                        from: 'top',
                        type: 'danger',
                        icon: 'fa fa-times mr-5',
                        message: file.name + ' muss den Dateityp audio'
                    });
                    return;
                }
                this.voiceFiles.push(file);
                const reader = new FileReader();
                reader.onload = (e) => this.voices.push(e.target.result);
                reader.readAsDataURL(file);
            },

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

        #file-error {
            padding-top: 29% !important;
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

        .voices-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;

            .voice-wrapper {
                width: 29%;
                display: flex;
                flex-direction: column;
                margin: 10px 6px;

                i {
                    font-size: 60px !important;
                    color: rgba(90, 90, 88, 0.2) !important;
                }
            }

            .voice-box {
                border-color: rgba(90, 90, 88, 0.2) !important;
                padding: 28px 30px;
            }

            .voice-name {
                word-break: break-all;
                font-size: 14px;
                font-style: italic;
            }

            .details {
                font-size: 12px;
                background: #fff;
                color: #000;
                display: flex;
                flex-direction: column;
                align-items: self-start;
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
                background: #2196F3;
                border: 2px solid #03A9F4;
                border-radius: 3px;
                color: #fff;
                font-size: 15px;
                cursor: pointer;
            }

            label {
                padding: 2px 5px;
                margin-right: 10px;
            }
        }
    }
</style>