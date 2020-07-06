<div>
    <div class="from-group">
        <label for="">@lang("general.experience.${type}.label")</label>
        <div class="row m-0">
            <div class="form-group w-25 mr-2">
                <input type="text" class="form-control @error("place") is-invalid @enderror"
                       wire:model.lazy="place" name="place"
                       placeholder="@lang("general.experience.".$type.".place")"
                       title="@lang("general.experience.".$type.".place")">
                @error("place")
                <div class="invalid-feedback animated fadeInDown">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group w-25 mr-2">
                <input type="text" class="form-control @error("title") is-invalid @enderror"
                       wire:model.lazy="title" name="title"
                       placeholder="@lang("general.experience.".$type.".title")"
                       title="@lang("general.experience.".$type.".title")">
                @error("title")
                <div class="invalid-feedback animated fadeInDown">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group w-25 mr-2">
                <input type="text" class="form-control @error("period") is-invalid @enderror"
                       wire:model.lazy="period" name="period"
                       placeholder="@lang("general.experience.period")"
                       title="@lang("general.experience.period")">
                @error("period")
                <div class="invalid-feedback animated fadeInDown">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group d-flex justify-content-center align-items-center" style="width: 15%">
                <a href="#" class="btn btn-primary" wire:click.prevent="add" wire:key="{{$type.rand()}}">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        @foreach($experiences as $index=>$item)
            <div class="row m-0">
                <div class="form-group w-25 mr-2">
                    <input type="text" class="form-control" value="{{$item['place']}}"
                           name="experiences[{{$type}}][{{$loop->index}}][place]"
                           placeholder="@lang("general.experience.".$type.".place")"
                           title="@lang("general.experience.".$type.".place")" required>
                </div>
                <div class="form-group w-25 mr-2">
                    <input type="text" class="form-control" value="{{$item['title']}}"
                           name="experiences[{{$type}}][{{$loop->index}}][title]"
                           placeholder="@lang("general.experience.".$type.".title")"
                           title="@lang("general.experience.".$type.".title")" required>
                </div>
                <div class="form-group w-25 mr-2">
                    <input type="text" class="form-control" value="{{$item['period']}}"
                           name="experiences[{{$type}}][{{$loop->index}}][period]"
                           placeholder="@lang("general.experience.period")"
                           title="@lang("general.experience.period")" required>
                    <input type="hidden" class="form-control" value="{{$type}}"
                           name="experiences[{{$type}}][{{$loop->index}}][type]" required>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center" style="width: 15%">
                    <a href="#" class="btn btn-danger" wire:click.prevent="remove({{$index}})"
                       wire:key="{{$type.$loop->index}}">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>