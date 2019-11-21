<?php
namespace AcornDB\Model;

use AcornDB\Model\Taxonomy;

/**
 * Tag class.
 *
 * @author Mickael Burguet <www.rundef.com>
 */
class Tag extends Taxonomy
{
    /**
     * @var string
     */
    protected $taxonomy = 'post_tag';
}
