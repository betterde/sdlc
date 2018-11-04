<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
	protected $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc2RsYy5pdFwvYXV0aFwvc2lnbmluIiwiaWF0IjoxNTQwNzM1OTMyLCJleHAiOjE1NDMzMjc5MzIsIm5iZiI6MTU0MDczNTkzMiwianRpIjoiWjg4THBzcUVaU3lFY1RQNiIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.VsqaFyiNQ--PEPr__hSQD-LfucPJkSrMNUXkJQqgJNg';

	/**
	 * 测试创建项目
	 *
	 * Date: 2018/11/4
	 * @author George
	 */
    public function testCreateProject()
    {
    	$response = $this->postJson('/project', [
    		'name' => 'EIP',
    		'description' => 'Enterprise Information Platform',
    		'type_id' => 1,
    		'owner' => 1,
    		'status' => 'analysis',
    		'public' => 1
		], [
			'Authorization' => $this->token
		]);

    	$response->assertStatus(200);
    }

	/**
	 * 测试获取项目
	 *
	 * Date: 2018/11/4
	 * @author George
	 */
	public function testGetProjects()
	{
		$response = $this->getJson('/project', [
			'Authorization' => $this->token
		]);

		$response->assertStatus(200);
    }
}
