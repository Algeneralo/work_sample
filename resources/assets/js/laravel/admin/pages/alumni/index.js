require("../../../bootstrap")

import AddressComponent from '../../../components/Address'
import ImageUploader from '../../../components/ImageUploader';
import ImagePreviewer from '../../../components/ImagePreviewer';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/de';

const ins = new Vue({
    el: ".alumni",
    components: {AddressComponent, DatePicker, ImageUploader, ImagePreviewer},
    data: {
        dob: '',
        alumniYear: '',
    },
    mounted() {
        document.querySelectorAll('[data-change-v-model-value]').forEach(element => {
            let field = JSON.parse(element.getAttribute("data-change-v-model-value").replace(/'/g, '"'));
            this[Object.keys(field)[0]] = Object.values(field)[0]
        });
    },
    methods: {
        disabledDobDates(date) {
            return date > new Date()
        }
    }
})