<?php
namespace TinyPixel\AcornDB\Model;

use TinyPixel\AcornDB\Model\Taxonomy;

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
