require("../../../bootstrap")

import ImageUploader from '../../../components/ImageUploader';
import ImagePreviewer from '../../../components/ImagePreviewer';
import InfiniteLoading from 'vue-infinite-loading';


new Vue({
    el: ".forum",
    components: {ImagePreviewer, ImageUploader, InfiniteLoading}
    , methods: {
        infiniteHandler($state) {
            $state.complete();
        },
    }

})