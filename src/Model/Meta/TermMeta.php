<?php
namespace TinyPixel\AcornDB\Model\Meta;

use TinyPixel\AcornDB\Model\Term;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Meta: Term
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class TermMeta extends Meta
{
    /** @var string */
    protected $table = 'termmeta';

    /** @var string */
    protected $primaryKey = 'meta_id';

    /** @var array */
    protected $fillable = ['meta_key', 'meta_value', 'term_id'];

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }
}
