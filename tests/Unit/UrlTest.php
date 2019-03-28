<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Utils\Url;

class UrlTest extends TestCase
{
    /**
     * @test
     */
    public function it_shortens_urls()
    {
        $url = 'https://vk.com/id343244650?z=photo343244650_394923801%2Falbum343244650_0%2Frev';
        $url = Url::shorten($url);
        $this->assertEquals($url, 'photo343244650_394923801');

        $url = 'https://vk.com/maxflex';
        $url = Url::shorten($url);
        $this->assertEquals($url, 'maxflex');
    }
}
