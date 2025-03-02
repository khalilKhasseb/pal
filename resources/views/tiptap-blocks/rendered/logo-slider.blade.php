{{-- resources/views/blocks/rendered/logo-slider.blade.php --}}


<div>
    <livewire:blocks.logo-slider-block
        :logos="$logos ?? []"
        :title="$title ?? null"
        :slides-per-view="$slides_per_view ?? 4"
        :auto-play="$auto_play ?? true"
        :auto-play-speed="$auto_play_speed ?? 3000"
        :show-navigation="$show_navigation ?? true"
        :show-pagination="$show_pagination ?? false"
    />
</div>