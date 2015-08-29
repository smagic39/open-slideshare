<?php
App::uses('ComponentCollection', 'Controller');
App::uses('Component', 'Controller');
App::uses('FileConverterComponent', 'Controller/Component');

/**
 * FileConverterComponent Test Case
 */
class FileConverterComponentTest extends CakeTestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $Collection = new ComponentCollection();
        $this->FileConverter = new FileConverterComponent($Collection);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FileConverter);

        parent::tearDown();
    }

    /**
     * testGetMimeType
     *
     */
    public function testGetMimeType()
    {
        $dir = dirname(dirname(dirname(dirname(__FILE__)))) . DS . "Data";

        // pptx
        $result = $this->FileConverter->get_mime_type($dir . DS . "test.pptx");
        $this->assertTrue(in_array($result,
            array(
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.ms-powerpoint',
                'application/vnd.ms-office',
            )
        ));

        // ppt
        $result = $this->FileConverter->get_mime_type($dir . DS . "test.ppt");
        $this->assertTrue(in_array($result,
            array(
                'application/vnd.ms-powerpoint',
                'application/vnd.ms-office',
            )
        ));

        // pdf
        $result = $this->FileConverter->get_mime_type($dir . DS . "test.pdf");
        $this->assertEqual('application/pdf', $result);
    }

    /**
     * filterProvider
     *
     */
    public function filterProvider()
    {
        return array(
            array("abc", "abc"),
            array("abc  def", "abc def"),
            array("a\r\rb", "a b"),
            array(hex2bin('ef83bc'), ""),
            array("\f", ""),
            array("", ""),
        );
    }

    /**
     * testFilterScript
     *
     * @dataProvider filterProvider
     */
    public function testFilterScript($a, $expected)
    {
        $method = new ReflectionMethod($this->FileConverter, 'filter_script');
        $method->setAccessible(true);
        $result = $method->invoke($this->FileConverter, $a);
        $this->assertEqual($result, $expected);
    }
}
