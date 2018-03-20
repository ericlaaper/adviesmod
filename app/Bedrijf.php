<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Bedrijf
 *
 * @package App
 * @property string $bedrijfsnaam
 * @property string $achternaam
*/
class Bedrijf extends Model
{
    use SoftDeletes;

    protected $fillable = ['bedrijfsnaam', 'achternaam_id'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAchternaamIdAttribute($input)
    {
        $this->attributes['achternaam_id'] = $input ? $input : null;
    }
    
    public function achternaam()
    {
        return $this->belongsTo(Relatiemanager::class, 'achternaam_id')->withTrashed();
    }
    
}
