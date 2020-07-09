<template>
    <div class="form-group row">
        <label class="col-12">{{label}}</label>
        <div class="col-9 form-group mb-0">
            <input type="text" class="form-control" :name="`${prefix}street`"
                   v-bind:readonly="readOnly ? true : false"
                   v-bind:required="required ? true : false"
                   :value="this.street" :placeholder="trans('general.street')">
        </div>
        <div class="col-3 form-group mb-0 pl-0">
            <input type="text" class="form-control" :name="`${prefix}street_number`"
                   v-bind:readonly="readOnly ? true : false"
                   v-bind:required="required ? true : false"
                   :value="streetnumber" :placeholder="trans('general.number')">
        </div>
        <div class="col-4 form-group mb-0 pr-0 mt-2">
            <input type="text" class="form-control" :name="`${prefix}postcode`"
                   v-bind:readonly="readOnly ? true : false"
                   v-bind:required="required ? true : false"
                   :value="postcode" :placeholder="trans('general.postcode')">
        </div>
        <div class="col-8 form-group mb-0 mt-2">
            <input type="text" class="form-control" :name="`${prefix}city`"
                   v-bind:readonly="readOnly ? true : false"
                   v-bind:required="required ? true : false"
                   :value="city" :placeholder="trans('general.city')">
        </div>
    </div>
</template>

<script>
    export default {
        //prefix should have "_" at the end
        props: {
            prefix: {default: ''},
            street: {default: ''},
            streetnumber: {default: ''},
            postcode: {default: ''},
            readOnly: {default: false},
            required: {default: true},
            city: {default: ''},
            label: {
                default: function () {
                    return this.trans('general.address')
                }
            }
        },

    }
</script>

