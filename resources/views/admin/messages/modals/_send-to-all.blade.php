<div class="modal fade" id="sendMessageToAllAlumniModal" tabindex="-1" role="dialog"
     aria-labelledby="sendMessageToAllAlumniModalLabel" wire:ignore="true" data-backdrop="static" data-keyboard="false"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content position-relative">
            <div class="loading" wire:loading wire:target="sendMessageToAllAlumni" wire:loading.class="disabled"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang("general.send-message-to-all-alumni")</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>@lang("general.message")</label>
                <textarea class="form-control" name="allMessage" cols="30" rows="10"
                          wire:model.lazy="messageToAll"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="sendMessageToAllAlumni"
                        class="btn btn-primary">@lang("general.send")</button>
            </div>
        </div>
    </div>
</div>