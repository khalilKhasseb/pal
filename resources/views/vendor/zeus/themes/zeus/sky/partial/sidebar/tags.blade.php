 <!-- .widget -->
 <div class="widget">
    <h4 class="sidebar-widget-title">Popular Tags</h4>
    <div class="widget-content">
        <div class="tag-cloud">
            @foreach ($papular_tags as $tag )
            <a href="{{route('tags' , [
                'type' => $tag->type,
                'slug' => $tag->slug
            ])}}" class="btn">{{$tag->name}}</a>

            @endforeach

        </div>
        <!-- .tag-cloud -->
    </div>
    <!-- .widget-content -->
</div>
<!-- .widget -->
