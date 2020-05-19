
require("../../../bootstrap")

import ImageUploader from '../../../components/ImageUploader';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/de';
import ImagePreviewer from "../../../components/ImagePreviewer";

new Vue({
    el: ".general",
    components: {ImageUploader, DatePicker, ImagePreviewer},
    data: {
        date: '',
    },
    mounted() {
        document.querySelectorAll('[data-change-v-model-value]').forEach(element => {
            let field = JSON.parse('' + element.getAttribute("data-change-v-model-value").replace(/'/g, '"'));
            this[Object.keys(field)[0]] = Object.values(field)[0]
        });
    },
})