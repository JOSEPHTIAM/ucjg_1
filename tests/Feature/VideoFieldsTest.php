<?php

namespace Tests\Feature;

use Tests\TestCase;

class VideoFieldsTest extends TestCase
{
    public function test_video_page_has_commentaire_field_and_creation_date_slot(): void
    {
        $response = $this->get('/videos-ucjg');

        $response->assertStatus(200);
        $response->assertSee('name="commentaire"');
        $response->assertSee('id="detailCreatedAt"');
    }
}
