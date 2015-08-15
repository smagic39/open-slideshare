<?php

/**
 * SlideFixture.
 */
class SlideFixture extends CakeTestFixture
{
    /**
     * Import.
     *
     * @var array
     */
    public $import = array('model' => 'Slide');

    /**
     * Records.
     *
     * @var array
     */
    public $records = array(
        array(
            'id' => '1',
            'user_id' => '1',
            'name' => 'TestSlide1',
            'description' => 'The Description of TestSlide1',
            'downloadable' => 0,
            'category_id' => '1',
            'created' => '2015-02-01 00:00:00',
            'modified' => '2015-02-01 01:00:00',
            'key' => '4ea2abecba74eda5521fff924d9e5062',
            'extension' => '.pdf',
            'convert_status' => '100',
            'page_view' => '99',
            'download_count' => '0',
            'embedded_view' => '33',
        ),
        array(
            'id' => '2',
            'user_id' => '1',
            'name' => 'TestSlide2',
            'description' => 'The Description of TestSlide2',
            'downloadable' => 1,
            'category_id' => '1',
            'created' => '2015-03-01 00:00:00',
            'modified' => '2015-03-01 01:00:00',
            'key' => '1cf9ff7657312d63072439632e6110bd',
            'extension' => '.pptx',
            'convert_status' => '100',
            'page_view' => '99',
            'download_count' => '11',
            'embedded_view' => '33',
        ),
    );
}
