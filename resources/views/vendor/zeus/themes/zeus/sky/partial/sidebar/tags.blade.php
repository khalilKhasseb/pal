 <!-- .widget -->
 <div class="widget">
     <h4 class="sidebar-widget-title">{{ __('Popular Tags') }}</h4>
     <div class="widget-content">
         <div class="tag-cloud">
             @foreach ($papular_tags as $tag)

                 @if ($tag->type !== null && $tag->type !== 'faq')
                     <a href="{{ route('tags', [
                         'type' => $tag->type,
                         'slug' => $tag->slug,
                     ]) }}"
                         class="btn">{{ $tag->name }}</a>
                 @endif
             @endforeach

         </div>
         <!-- .tag-cloud -->
     </div>
     <!-- .widget-content -->
 </div>
 <!-- .widget -->
