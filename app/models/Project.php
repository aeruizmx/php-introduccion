<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDefaultImage;

class Project extends Model{
    use HasDefaultImage;
    
    protected $table = 'projects';

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
      
        return "Project duration: $years years $extraMonths months";
    }
}
