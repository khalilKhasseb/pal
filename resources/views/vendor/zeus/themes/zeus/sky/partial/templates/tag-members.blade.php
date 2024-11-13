<section class="bg-team-section">
    <div class="container">
        <div class="row">
            <div class="volunteers-option">
                <div class="row">
                    @foreach ($posts as $post)
                        <x-theme.team-member-card :member="$post" />
                    @endforeach
                    <!-- .col-lg-3 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .volume-option -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
