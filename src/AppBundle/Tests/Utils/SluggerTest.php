<?php

namespace Tests\Utils;

use AppBundle\Utils\Slugger;

/**
 * Unit test for the application utils.
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ phpunit -c app
 *
 */
class SluggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getSlugs
     */
    public function testSlugify($string, $slug)
    {
        $slugger = new Slugger();
        $result = $slugger->slugify($string);

        $this->assertEquals($slug, $result);
    }

    public function getSlugs()
    {
        return array(
            array('Lorem Ipsum'     , 'lorem-ipsum'),
            array('  Lorem Ipsum  ' , 'lorem-ipsum'),
            array(' lOrEm  iPsUm  ' , 'lorem-ipsum'),
            array('!Lorem Ipsum!'   , 'lorem-ipsum'),
            array('lorem-ipsum'     , 'lorem-ipsum'),
        );
    }
}
