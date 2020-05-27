require("../../../bootstrap")

import ImagePreviewer from "../../../components/ImagePreviewer";
import ImageUploader from "../../../components/ImageUploader";
import DatePicker from 'vue2-datepicker';

new Vue({
    el: ".offer",
    components: {ImagePreviewer, ImageUploader, DatePicker},
    data: {
        date: ''
    },
    mounted() {
        document.querySelectorAll('[data-change-v-model-value]').forEach(element => {
            let field = JSON.parse('' + element.getAttribute("data-change-v-model-value").replace(/'/g, '"'));
            this[Object.keys(field)[0]] = Object.values(field)[0]
        });
    },
    methods: {
        deleteImage(id, event) {
            let parent = event.target.closest('.photo');
            axios.delete('/admin/bulletin-board/off')
                .then(function (response) {
                    // Do something
                }).catch(function (response) {
                alr
            })

        }
    }
})