<?php
namespace TinyPixel\AcornDB\Model;

use TinyPixel\AcornDB\Model\Model;
use TinyPixel\AcornDB\Model\Taxonomy;
use TinyPixel\AcornDB\Concerns\AdvancedCustomFields;
use TinyPixel\AcornDB\Concerns\MetaFields;

/**
 * WordPress Term
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class Term extends Model
{
    use MetaFields;
    use AdvancedCustomFields;

    /**
     * @var string
     */
    protected $table = 'terms';

    /**
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taxonomy()
    {
        return $this->hasOne(Taxonomy::class, 'term_id');
    }
}
