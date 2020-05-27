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
            //deny deletion all images
            if (parent.closest(".photos").querySelectorAll(".photo").length <= 1) {
                Swal.fire({
                    title: "you can't delete all items",
                    text: "",
                    type: 'warning',
                })
                return;
            }

            Swal.fire({
                title: this.trans("messages.delete-confirmation.title"),
                text: this.trans("messages.delete-confirmation.message"),
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#226DAE',
                cancelButtonColor: '#d33',
                cancelButtonText: this.trans("messages.delete-confirmation.cancel"),
                confirmButtonText: this.trans("messages.delete-confirmation.delete")
            }).then((result) => {
                if (result.value) {
                    axios.post(route('admin.bulletin-board.offers.image.destroy',id), {
                        _method: 'DELETE',
                    })
                        .then(function (response) {
                            parent.remove()
                        }).catch(function (response) {
                        console.log(response)
                    })
                }
            })


        }
    }
})