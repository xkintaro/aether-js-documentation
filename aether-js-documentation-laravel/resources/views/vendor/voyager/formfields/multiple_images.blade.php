<div class="custom-image-wrapper">

    {{-- 1. MEVCUT RESİMLERİ LİSTELEME --}}
    @if(isset($dataTypeContent->{$row->field}))
    <?php $images = json_decode($dataTypeContent->{$row->field}); ?>

    @if($images != null)
    {{-- Flex Container: Resimleri yan yana dizer --}}
    <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 15px;">
        @foreach($images as $image)
        <div class="custom-preview-container" data-field-name="{{ $row->field }}">
            {{-- Silme Butonu --}}
            <a href="#" class="voyager-x remove-multi-image custom-delete-btn" title="Resmi Kaldır"></a>

            {{-- Resim --}}
            <img src="{{ Voyager::image($image) }}"
                data-file-name="{{ $image }}"
                data-id="{{ $dataTypeContent->getKey() }}"
                class="custom-preview-img">
        </div>
        @endforeach
    </div>
    @endif
    @endif

    {{-- 2. MODERN ÇOKLU YÜKLEME ALANI --}}
    <div class="custom-file-input-group">

        {{-- Görsel Tasarım --}}
        <div class="custom-upload-design">
            <div class="btn btn-primary">
                <i class="voyager-photos"></i> Resim Seç (Çoklu)
            </div>
            <span class="custom-file-text">Henüz resim seçilmedi...</span>
        </div>

        {{-- Gerçek Input (Görünmez & Overlay) --}}
        <input @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif
        type="file"
        name="{{ $row->field }}[]"
        multiple="multiple"
        accept="image/*"
        class="custom-real-input"
        onchange="
        var count = this.files.length;
        var textSpan = this.previousElementSibling.querySelector('.custom-file-text');

        if(count > 1) {
        textSpan.textContent = count + ' adet resim seçildi';
        textSpan.style.color = '#333';
        textSpan.style.fontWeight = 'bold';
        } else if(count === 1) {
        textSpan.textContent = this.files[0].name;
        textSpan.style.color = '#333';
        textSpan.style.fontWeight = 'bold';
        } else {
        textSpan.textContent = 'Henüz resim seçilmedi...';
        textSpan.style.color = '#888';
        textSpan.style.fontWeight = 'normal';
        }
        ">
    </div>

</div>