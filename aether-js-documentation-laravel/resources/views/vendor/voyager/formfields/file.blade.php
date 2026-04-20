<div class="custom-image-wrapper">

  {{-- 1. MEVCUT DOSYALARI LİSTELEME ALANI --}}
  @if(isset($dataTypeContent->{$row->field}))
  {{-- Çoklu Dosya Kontrolü --}}
  @if(json_decode($dataTypeContent->{$row->field}) !== null)
  <div style="display: flex; flex-wrap: wrap; gap: 10px;">
    @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
    <div class="custom-preview-container" data-field-name="{{ $row->field }}" style="padding: 10px 15px; display: flex; align-items: center;">
      {{-- Silme Butonu --}}
      <a href="#" class="voyager-x remove-multi-file custom-delete-btn" title="Dosyayı Kaldır"></a>

      {{-- Dosya Linki ve İkonu --}}
      <a class="fileType" target="_blank"
        href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}"
        data-file-name="{{ $file->original_name }}"
        data-id="{{ $dataTypeContent->getKey() }}"
        style="text-decoration: none; color: #555; font-weight: 600; display: flex; align-items: center; gap: 5px;">
        <i class="voyager-file-text"></i> {{ $file->original_name ?: '' }}
      </a>
    </div>
    @endforeach
  </div>
  @else
  {{-- Tekli Dosya (Eski veri yapısı için fallback) --}}
  <div class="custom-preview-container" data-field-name="{{ $row->field }}" style="padding: 10px 15px;">
    <a href="#" class="voyager-x remove-single-file custom-delete-btn" title="Dosyayı Kaldır"></a>
    <a class="fileType" target="_blank"
      href="{{ Storage::disk(config('voyager.storage.disk'))->url($dataTypeContent->{$row->field}) }}"
      data-file-name="{{ $dataTypeContent->{$row->field} }}"
      data-id="{{ $dataTypeContent->getKey() }}"
      style="text-decoration: none; color: #555; font-weight: 600;">
      <i class="voyager-download"></i> {{ __('voyager::generic.download') }}
    </a>
  </div>
  @endif
  @endif

  {{-- 2. MODERN DOSYA YÜKLEME ALANI (INPUT) --}}
  <div class="custom-file-input-group">

    {{-- Görsel Tasarım --}}
    <div class="custom-upload-design">
      <div class="btn btn-primary">
        <i class="voyager-upload"></i> Dosya Seç
      </div>
      <span class="custom-file-text">Henüz dosya seçilmedi...</span>
    </div>

    {{-- Gerçek Input (Görünmez & Overlay) --}}
    <input @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif
    type="file"
    name="{{ $row->field }}[]"
    multiple="multiple"
    class="custom-real-input"
    onchange="
    var count = this.files.length;
    var textContainer = this.previousElementSibling.querySelector('.custom-file-text');
    if(count > 1) {
    textContainer.textContent = count + ' dosya seçildi';
    } else if(count === 1) {
    textContainer.textContent = this.files[0].name;
    } else {
    textContainer.textContent = 'Henüz dosya seçilmedi...';
    }
    ">
  </div>

</div>