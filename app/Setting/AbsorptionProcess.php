<?php

namespace HR\Setting;

use Illuminate\Database\Eloquent\Model;

class AbsorptionProcess extends Model
{
    protected $fillable = ['boxes'];

    public function setBoxesAttribute($value)
    {
        $this->attributes['boxes'] = json_encode($value);
    }

    public function getBoxesAttribute($value)
    {
        return json_decode($value);
    }
}
