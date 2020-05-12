require("../../../bootstrap")

import ImagePreviewer from "../../../components/ImagePreviewer";

new Vue({
    el: ".offer",
    components: {ImagePreviewer},
    methods: {
        deleteImage(id) {
            console.log(id)
        }
    }
})