<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Mod1
 *
 * @package App
 * @property string $achternaam
 * @property integer $mod1vr1
 * @property string $mod1opm1
 * @property integer $mod1vr2
 * @property string $mod1opm2
 * @property string $created_by
*/
class Mod1 extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['mod1vr1', 'mod1opm1', 'mod1vr2', 'mod1opm2', 'achternaam_id', 'created_by_id'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAchternaamIdAttribute($input)
    {
        $this->attributes['achternaam_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMod1vr1Attribute($input)
    {
        $this->attributes['mod1vr1'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMod1vr2Attribute($input)
    {
        $this->attributes['mod1vr2'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }
    
    public function achternaam()
    {
        return $this->belongsTo(Klanten::class, 'achternaam_id')->withTrashed();
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
}
