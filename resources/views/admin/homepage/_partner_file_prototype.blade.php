<div class="d-none">
    <div data-repeater-item class="form-group row align-items-center image-wrapper">
        <div class="col-md-3">
            <div class="kt-form__group--inline">
                <img src="{{ asset('images/placeholder-image.png') }}" style="max-width: 100%;"  class="rounded">
            </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
        <div class="col-md-4">
            <div class="kt-form__group--inline">
                <div class="kt-form__label">
                    <label>Име на файл:</label>
                </div>
                <div class="custom-file">
                    <input name="id" type="hidden" value="" class="image-id" data-type="partner_file"/>
                    <input type="file" class="custom-file-input" id="customFile" name="filename">
                    <label class="custom-file-label text-left" for="customFile">Изберете файл</label>
                    <input name="position" type="hidden" value="" class="js-position-holder" />
                </div>
            </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
        <div class="col-md-4">
            <div class="kt-form__group--inline">
                <div class="kt-form__label">
                    <label>Линк:</label>
                </div>
                <div class="kt-form__control">
                    <input type="text" name="link"  class="form-control" placeholder="Напишете линк" value="">
                </div>
            </div>
            <div class="d-md-none kt-margin-b-10"></div>
        </div>
        <div class="col-md-1 pt-4">
            <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                <i class="la la-trash-o"></i>
            </a>
        </div>
    </div>
    <hr/>
</div>

