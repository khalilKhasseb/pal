@props([
    'statePath' => null,
    'icon' => 'link',
    'label' => trans('filament-tiptap-editor::editor.link.insert_edit'),
    'active' => true,
])

@php
    $useActive = $active ? 'link' : false;
@endphp

<x-filament-tiptap-editor::button
    
     action="openModal()"
    :active="$useActive"
    :label="$label"
    :icon="$icon"
    x-data="{
        openModal() {
            let link = this.editor().getAttributes('link');
            //console.log(link  ,this.editor());
            let arguments = {
                href: link.href || '',
                id: link.id || null,
                target: link.target || null,
                hreflang: link.hreflang || null,
                rel: link.rel || null,
                referrerpolicy: link.referrerpolicy || null,
                as_button: link.as_button || null,
                button_theme: link.button_theme || null,
                button_size: link.button_size || null,
                coordinates: this.editor().view.state.selection.ranges,
            };

            console.log(arguments);

            $wire.dispatchFormEvent('tiptap::setLinkContent', '{{ $statePath }}', arguments);
        }
    }"
/>
