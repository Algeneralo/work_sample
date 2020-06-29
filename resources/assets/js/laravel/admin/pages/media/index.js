require("../../../bootstrap")

import ImageUploader from '../../../components/ImageUploader';
import ImagePreviewer from '../../../components/ImagePreviewer';
import VoiceUploader from '../../../components/VoiceUploader';
import ImageVideoUploader from '../../../components/ImageVideoUploader';

new Vue({
    el: ".medias",
    components: {ImageUploader, VoiceUploader, ImagePreviewer, ImageVideoUploader},
})