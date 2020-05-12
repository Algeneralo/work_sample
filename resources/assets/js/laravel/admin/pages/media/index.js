require("../../../bootstrap")

import ImageUploader from '../../../components/ImageUploader';
import ImagePreviewer from '../../../components/ImagePreviewer';
import VoiceUploader from '../../../components/VoiceUploader';

new Vue({
    el: ".medias",
    components: {ImageUploader, VoiceUploader, ImagePreviewer},
})