<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task\{Task, Type};

class TasksControllerTest extends TestCase
{
    const API_URL = 'api/v1/tasks';

    /** @test **/
    public function it_validates_request()
    {
        // empty url
        $response = $this->json('POST', self::API_URL, [
            'type' => Type::LIKE,
            'original_url' => '',
        ]);

        $response->assertJson([
            'errors' => [
                'original_url' => [trans('validation.task.required')]
            ]
        ]);

        // url should start with vk.com
        $response = $this->json('POST', self::API_URL, [
            'type' => Type::LIKE,
            'original_url' => 'sdfasdfadsfdasf',
        ]);

        $response->assertJson([
            'errors' => [
                'original_url' => [trans('validation.task.wrong_host')]
            ]
        ]);

        // url should have one of the allowed types
        $response = $this->json('POST', self::API_URL, [
            'type' => '321',
            'original_url' => 'https://vk.com/maxflex',
        ]);

        $response->assertJson([
            'errors' => [
                'type' => [trans('validation.task.wrong_type')]
            ]
        ]);
    }
}
