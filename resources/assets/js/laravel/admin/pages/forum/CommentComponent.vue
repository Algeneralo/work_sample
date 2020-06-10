<template>

    <div class="row mx-0 px-20 py-30" v-bind:class="{ 'bg-body': index%2 }">
        <div class="col-md-2 text-md-center">
            <img src="" alt="" width="60"
                 height="60"
                 class="rounded-circle border border-4x border-primary">
            <span class="text-primary d-block"></span>
        </div>
        <div class="col-md-10">
            <span class="d-block text-gray font-size-xs"></span>
            <p class="font-size-md"></p>
            <span class="font-italic font-weight-bold">
                Gefällt mir-Angaben
            </span>

            <div class="float-sm-right">
                <a href="#" wire:click.prevent="blockAlumnus(1)"
                   wire:key="comment.id"
                   class="btn btn-noborder btn-outline-dark font-italic text-black">

                </a>
                <a href="#" :data-id="comment.id" data-custom-event="deleteComment"
                   class="btn bg-gray text-white delete-button">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "comment",
        props: ['comment', "index"]
    }
</script>
