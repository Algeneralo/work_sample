<template>
    <div class="form-group row">
        <label class="col-12">{{label}}</label>
        <div class="col-9 form-group mb-0">
            <input type="text" class="form-control" :name="`${prefix}street`"
                   :value="this.street" :placeholder="trans('general.street')" required>
        </div>
        <div class="col-3 form-group mb-0 pl-0">
            <input type="text" class="form-control" :name="`${prefix}street_number`" :value="streetnumber"
                   :placeholder="trans('general.number')" required>
        </div>
        <div class="col-4 form-group mb-0 pr-0 mt-2">
            <input type="text" class="form-control" :name="`${prefix}postcode`" :value="postcode"
                   :placeholder="trans('general.postcode')" required>
        </div>
        <div class="col-8 form-group mb-0 mt-2">
            <input type="text" class="form-control" :name="`${prefix}city`" :value="city"
                   :placeholder="trans('general.city')" required>
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
            city: {default: ''},
            label: {
                default: function () {
                    return this.trans('general.address')
                }
            }
        },

    }
</script>

