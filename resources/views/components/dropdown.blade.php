@props(['align' => 'right', 'width' => '48', 'contentClasses' => '', 'dropdownClasses' => ''])

@php
$alignmentClasses = match ($align) {
    'left' => 'dropdown-align-left',
    'top' => 'dropdown-align-top',
    'none', 'false' => '',
    default => 'dropdown-align-right',
};

$width = match ($width) {
    '48' => 'dropdown-width-48',
    '60' => 'dropdown-width-60',
    default => 'dropdown-width-48',
};
@endphp

<div class="dropdown-container" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="dropdown-transition-enter"
            x-transition:enter-start="dropdown-transition-enter-start"
            x-transition:enter-end="dropdown-transition-enter-end"
            x-transition:leave="dropdown-transition-leave"
            x-transition:leave-start="dropdown-transition-leave-start"
            x-transition:leave-end="dropdown-transition-leave-end"
            class="dropdown-menu {{ $width }} {{ $alignmentClasses }} {{ $dropdownClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="dropdown-content {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
