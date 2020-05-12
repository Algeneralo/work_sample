require("../../../bootstrap")

import AddressComponent from '../../../components/Address'
import ImageUploader from '../../../components/ImageUploader'
import ImagePreviewer from '../../../components/ImagePreviewer'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/de';

new Vue({
    el: ".events",
    components: {AddressComponent, DatePicker, ImageUploader, ImagePreviewer},
    data: {
        date: '',
        time: '',
        minutes: [0, 15, 30, 45],
    },
})