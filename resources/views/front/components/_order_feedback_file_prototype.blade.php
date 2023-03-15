<div id="product_file_prototype_{{ $orderProduct->id }}" class="file_upload {{!empty($orderProduct) ? 'order_product_' . $orderProduct->id : '' }}">
    <div data-repeater-item class="form-group row align-items-center file_upload_img">
        <div class="col-md-4">
            <div class="kt-form__group--inline">
                <img src="{{ asset('images/placeholder-image.png') }}" style="width: 100%;"  class="rounded">
            </div>
        </div>
        <div class="col-md-8">
            <div class="p-2">
                <div class="custom-file">
                    <input name="{{$field_name}}[id]" type="hidden" value="{{ !empty($galleryImage->id) ? $galleryImage->id : '' }}" class="image-id" data-type=""/>
                    <input type="file" class="custom-file-input" id="customFile_{{$orderProduct->product_id}}" name="{{$field_name}}[filename]" value="{{ !empty($galleryImage) ? $galleryImage->name : '' }}">
                    <label class="custom-file-label text-left" for="customFile">{{ !empty($galleryImage) ? $galleryImage->name : '' }}</label>
                    <input name="{{$field_name}}[position]" type="hidden" value="" class="js-position-holder position" />
                </div>
            </div>
            <div class="p-2">
                <input type="text" name="{{$field_name}}[title]"  class="form-control title" placeholder="Напишете заглавие" value="">
            </div>
        </div>
{{--        <div class="col-md-6 pt-4">--}}
{{--            <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">--}}
{{--                <i class="la la-trash-o"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
</div>
