require("../../../bootstrap")

import ImageUploader from '../../../components/ImageUploader';
import InfiniteLoading from 'vue-infinite-loading';


new Vue({
    el: ".forum",
    components: {ImageUploader,InfiniteLoading}
    , methods: {
        infiniteHandler($state) {
            $state.complete();
        },
    }

})