@extends('voyager::master')

@section('page_title', 'Translation')

@section('page_header')
<h1 class="page-title">
    <i class="voyager-world"></i> Translation
</h1>
<form action="{{ route('admin.translations.scan') }}" method="POST" style="display:inline-block; margin-left: 10px; vertical-align:middle;">
    @csrf
    <button type="submit" class="btn btn-warning">
        <i class="voyager-refresh"></i> SCAN TRANSLATIONS
    </button>
</form>
@stop

@section('content')
<div class="page-content container-fluid">
    @include('voyager::alerts')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="GET" action="{{ route('admin.translations.index') }}" id="search_form" style="margin-bottom: 20px; display:flex; justify-content: flex-end;">
                        <label style="display: inline-flex; align-items:center; gap: 3px;">Search:
                            <input type="text"
                                name="s"
                                id="search_input"
                                class="form-control input-sm"
                                placeholder=""
                                value="{{ $search }}"
                                autocomplete="off">
                        </label>
                    </form>

                    <form action="{{ route('admin.translations.update') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20%;">
                                            Key
                                        </th>
                                        @foreach($locales as $locale)
                                        <th class="sorting_disabled" rowspan="1" colspan="1">
                                            {{ strtoupper($locale) }}
                                        </th>
                                        @endforeach
                                        <th class="actions text-right dt-not-orderable sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($translations as $key => $vals)
                                    <tr role="row">
                                        <td>
                                            <code style="display:block; word-break:break-all; width: fit-content; color: #555;">{{ $key }}</code>
                                        </td>

                                        @foreach($locales as $locale)
                                        <td>
                                            <textarea
                                                name="translations[{{ base64_encode($key) }}][{{ $locale }}]"
                                                class="form-control"
                                                rows="2"
                                                style="min-width: 150px; min-height: 150px; font-size: 13px; border: 1px solid #eee;">{{ $vals[$locale] ?? '' }}</textarea>
                                        </td>
                                        @endforeach

                                        <td class="text-right">
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-key="{{ base64_encode($key) }}" title="Delete">
                                                <i class="voyager-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr role="row" class="odd">
                                        <td colspan="{{ count($locales) + 2 }}" class="dataTables_empty" style="text-align: center;">
                                            No translations found.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{ $translations->appends(['s' => $search])->links('pagination::bootstrap-4') }}
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-success btn-lg" style="margin-top: 0;">
                                    <i class="voyager-check"></i> SAVE CHANGES
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete_form" action="{{ route('admin.translations.delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="key" id="delete_key">
</form>

@stop

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this translation?')) {
                    document.getElementById('delete_key').value = this.getAttribute('data-key');
                    document.getElementById('delete_form').submit();
                }
            });
        });

        var searchInput = document.getElementById('search_input');
        var searchForm = document.getElementById('search_form');
        var timeout = null;

        if (searchInput) {
            var val = searchInput.value;
            searchInput.focus();
            searchInput.value = '';
            searchInput.value = val;

            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    searchForm.submit();
                }, 200);
            });
        }
    });
</script>
@stop