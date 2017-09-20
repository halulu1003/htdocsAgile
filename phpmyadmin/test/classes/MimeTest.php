<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * tests for PhpMyAdmin\Mime
 *
 * @package PhpMyAdmin-test
 */
namespace PhpMyAdmin;

use PhpMyAdmin\Mime;

/**
 * Test for mime detection.
 *
 * @package PhpMyAdmin-test
 */
class MimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for Mime::detect
     *
     * @param string $test   MIME to test
     * @param string $output Expected output
     *
     * @return void
     * @dataProvider providerForTestDetect
     */
    public function testDetect($test, $output)
    {

        $this->assertEquals(
            Mime::detect($test),
            $output
        );
    }

    /**
     * Provider for testDetect
     *
     * @return array data for testDetect
     */
    public function providerForTestDetect()
    {
        return array(
            array(
                'pma',
                'application/octet-stream'
            ),
            array(
                'GIF',
                'image/gif'
            ),
            array(
                "\x89PNG",
                'image/png'
            ),
            array(
                chr(0xff) . chr(0xd8),
                'image/jpeg'
            ),
        );
    }
}
