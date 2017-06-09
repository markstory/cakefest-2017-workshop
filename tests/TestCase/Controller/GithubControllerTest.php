<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GithubController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GithubController Test Case
 */
class GithubControllerTest extends IntegrationTestCase
{
    /**
     * Test view method
     *
     * @vcr github_ok
     * @return void
     */
    public function testView()
    {
        $this->get('/github/view/lorenzo');
        $this->assertResponseOk();
        $this->assertResponseContains('success');
        $this->assertResponseContains('true');
    }

    /**
     * Test view method
     *
     * @vcr github_fail
     * @return void
     */
    public function testViewFailure()
    {
        $this->get('/github/view/nopenopenope');
        $this->assertResponseOk();
        $this->assertResponseContains('success');
        $this->assertResponseContains('false');
    }
}
