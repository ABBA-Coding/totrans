<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li class="nav-item">
            <a class="nav-link {{ $localeCode == 'ru' ? 'active' : '' }}"
               id="pills-{{ $localeCode }}-tab"
               data-toggle="pill"
               href="#pills-{{ $localeCode }}"
               role="tab"
               aria-controls="pills-{{ $localeCode }}"
               aria-selected="{{ $localeCode == 'ru' ? 'true' : 'false' }}">{{ __('static.'.$localeCode) }}
            </a>
        </li>
    @endforeach
</ul>
