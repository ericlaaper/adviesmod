<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Klanten
 *
 * @package App
 * @property string $voornaam
 * @property string $achternaam
 * @property string $email
 * @property string $password
 * @property string $naam
 * @property string $geslacht
*/
class Klanten extends Model
{
    use SoftDeletes;

    protected $fillable = ['voornaam', 'achternaam', 'email', 'password', 'geslacht', 'naam_id'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setNaamIdAttribute($input)
    {
        $this->attributes['naam_id'] = $input ? $input : null;
    }
    
    public function naam()
    {
        return $this->belongsTo(Bedrijf::class, 'naam_id')->withTrashed();
    }
    
}
