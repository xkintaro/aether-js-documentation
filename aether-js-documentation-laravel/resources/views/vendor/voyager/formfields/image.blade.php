<div class="custom-image-wrapper">

    {{-- MEVCUT RESİM ÖNİZLEME ALANI --}}
    @if(isset($dataTypeContent->{$row->field}))
    <div class="custom-preview-container" data-field-name="{{ $row->field }}">
        {{-- Silme Butonu --}}
        <a href="#" class="voyager-x remove-single-image custom-delete-btn" title="Resmi Kaldır"></a>

        {{-- Resim --}}
        <img src="@if( !filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $dataTypeContent->{$row->field} ) }}@else{{ $dataTypeContent->{$row->field} }}@endif"
            data-file-name="{{ $dataTypeContent->{$row->field} }}"
            data-id="{{ $dataTypeContent->getKey() }}"
            class="custom-preview-img">
    </div>
    @endif

    {{-- MODERN DOSYA YÜKLEME ALANI --}}
    <div class="custom-file-input-group">

        {{-- Görsel Tasarım (Fake) --}}
        <div class="custom-upload-design">
            <div class="btn btn-primary">
                <i class="voyager-images"></i> Resim Seç
            </div>
            <span class="custom-file-text">Henüz resim seçilmedi...</span>
        </div>

        {{-- Gerçek Input (Görünmez & Overlay) --}}
        <input @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif
        type="file"
        name="{{ $row->field }}"
        accept="image/*"
        class="custom-real-input"
        onchange="this.previousElementSibling.querySelector('.custom-file-text').textContent = this.files[0] ? this.files[0].name : 'Henüz resim seçilmedi...'">
    </div>

</div>