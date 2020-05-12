require("../../../bootstrap")

import ImageUploader from '../../../components/ImageUploader';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/de';

new Vue({
    el: ".general",
    components: {ImageUploader, DatePicker},
    data: {
        date: '',
    }
})