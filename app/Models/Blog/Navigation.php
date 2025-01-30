<?php

namespace App\Models\Blog;



use Illuminate\Database\Eloquent\Relations\MorphToMany;
use \LaraZeus\Sky\Models\Navigation as Model;
use App\Traits\PanelResource;
class Navigation extends Model
{


     use PanelResource;
}
