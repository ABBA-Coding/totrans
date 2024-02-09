<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @if($localeCode == App::getLocale())
            <li class="nav-item">
                <a class="nav-link active">
                    {{ __('static.'.$localeCode) }}
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ __('static.'.$localeCode) }}
                </a>
            </li>
        @endif
    @endforeach
</ul>
