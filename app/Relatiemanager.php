<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Relatiemanager
 *
 * @package App
 * @property string $voornaam
 * @property string $achternaam
 * @property string $email
 * @property string $geslacht
*/
class Relatiemanager extends Model
{
    use SoftDeletes;

    protected $fillable = ['voornaam', 'achternaam', 'email', 'geslacht'];
    
    
    
}
