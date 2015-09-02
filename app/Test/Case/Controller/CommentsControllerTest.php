<?php
App::uses('CommentsController', 'Controller');

require_once dirname(__FILE__) . DS . 'OssControllerTest.php';

/**
 * CommentsController Test Case
 */
class CommentsControllerTest extends OssControllerTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.comment',
        'app.user',
        'app.slide',
        'app.category',
        'plugin.tags.tag',
        'plugin.tags.tagged'
    );

    /**
     * testAdd method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->goIntoLoginStatus('Comments');

        $data = array(
            'Comment' => array(
                'slide_id' => 1,
                'content' => 'CommentTestAdd1',
                'return_url' => '/sushi'
            )
        );
        $result = $this->testAction('/comments/add', array(
            'data' => $data,
            'method' => 'post',
            'return' => 'contents'
        ));

        $this->assertContains('/sushi', $this->headers['Location']);

        App::uses('Comment', 'Model');
        $comment = new Comment();
        $comment->useDbConfig = 'test';
        $comment->recursive = -1;
        $rec = $comment->findByContent('CommentTestAdd1');
        $this->assertTrue(count($rec) == 1);
    }

    /**
     * testAddFail method
     *
     * @expectedException MissingViewException
     */
    public function testAddFail()
    {
        $this->goIntoLoginStatus('Comments');

        $data = array(
            'Comment' => array(
                'slide_id' => 1,
                'content' => '',
                'return_url' => '/sushi'
            )
        );
        $result = $this->testAction('/comments/add', array(
            'data' => $data,
            'method' => 'post',
            'return' => 'contents'
        ));
        // Confirm catching exception...
    }

    /**
     * testDelete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->goIntoLoginStatus('Comments');

        $data = array(
            'Comment' => array(
                'slide_id' => 1,
                'content' => 'CommentTestAdd1',
                'return_url' => '/sushi'
            )
        );
        $result = $this->testAction('/comments/add', array(
            'data' => $data,
            'method' => 'post',
            'return' => 'contents'
        ));

        App::uses('Comment', 'Model');
        $comment = new Comment();
        $comment->useDbConfig = 'test';
        $comment->recursive = -1;
        $rec = $comment->findByContent('CommentTestAdd1');
        $comment_id = $rec['Comment']['id'];

        $result = $this->testAction(
            '/comments/delete/' . $comment_id . '?return_url=/sashimi',
            array(
                'method' => 'POST',
                'return' => 'contents'
            )
        );
        $this->assertContains('/sashimi', $this->headers['Location']);
    }
}