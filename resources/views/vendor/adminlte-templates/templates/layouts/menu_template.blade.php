<li>
    <a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.
    ') !!}{!! $config->modelNames->camelPlural !!}.index') }}">
        <i class="bx bx-calendar-event icon nav-icon"></i>
        @if ($config->options->localized)
<span class="menu-item">@@lang('models/{{ $config->modelNames->camelPlural }}.plural')</span>
        @else
<span class="menu-item">{{ $config->modelNames->humanPlural }}</span>
        @endif
</a>
</li>
