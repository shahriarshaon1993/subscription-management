@props(['label', 'name', 'cols', 'rows'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'cols' => $cols,
        'rows' => $rows,
        'class' => 'form-input',
        'value' => old($name)
    ];
@endphp

<x-forms.field :$label :$name>
    <textarea {{ $attributes($defaults) }}></textarea>
</x-forms.field>
