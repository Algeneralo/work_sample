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
        time: [],
        minutes: [0, 15, 30, 45],
    },
    mounted() {
        document.querySelectorAll('[data-change-v-model-value]').forEach(element => {
            let field = JSON.parse('' + element.getAttribute("data-change-v-model-value").replace(/'/g, '"'));
            this[Object.keys(field)[0]] = Object.values(field)[0]
        });
    },
    methods: {
        disabledDates(date) {
            return date < new Date()
        }
    }
})

function hideShowDivs(val) {
    if (val === "external") {
        $("[name='max_participants']").closest(".form-group").hide()
        $("[name='participants']").closest(".participants").hide()
    } else {
        $("[name='max_participants']").closest(".form-group").show()
        $("[name='participants']").closest(".participants").show()
    }
}

$("[name='type']").on("change", function () {
    hideShowDivs($(this).val())
});
hideShowDivs($("[name='type']").val());