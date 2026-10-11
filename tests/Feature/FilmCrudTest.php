<?php

namespace Tests\Feature;

use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilmCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_film_index_page_can_be_opened(): void
    {
        $response = $this->get(route('films.index'));

        $response->assertStatus(200);
        $response->assertSee('Katalog Film');
    }

    public function test_film_can_be_searched_by_title(): void
    {
        $film = Film::factory()->create([
            'title' => 'Petualangan Alicia',
        ]);

        Film::factory()->create([
            'title' => 'Film Lainnya',
        ]);

        $response = $this->get(route('films.index', [
            'search' => 'Petualangan Alicia',
        ]));

        $response->assertStatus(200);
        $response->assertSee('Petualangan Alicia');
        $response->assertDontSee('Film Lainnya');
    }

    public function test_film_can_be_created(): void
    {
        $response = $this->post(route('films.store'), [
            'title' => 'Film Baru Alicia',
            'director' => 'Andi',
            'genre' => 'Drama',
            'release_year' => 2024,
            'duration' => 120,
            'synopsis' => 'Film untuk pengujian.',
        ]);

        $response->assertRedirect(route('films.index'));

        $this->assertDatabaseHas('films', [
            'title' => 'Film Baru Alicia',
            'director' => 'Andi',
        ]);
    }

    public function test_film_creation_fails_when_title_is_missing(): void
    {
        $response = $this->post(route('films.store'), [
            'title' => '',
            'director' => 'Andi',
            'genre' => 'Drama',
            'release_year' => 2024,
            'duration' => 120,
            'synopsis' => 'Film untuk pengujian.',
        ]);

        $response->assertSessionHasErrors('title');

        $this->assertDatabaseMissing('films', [
            'director' => 'Andi',
        ]);
    }

    public function test_film_can_be_updated(): void
    {
        $film = Film::factory()->create([
            'title' => 'Judul Lama',
        ]);

        $response = $this->put(route('films.update', $film), [
            'title' => 'Judul Baru',
            'director' => $film->director,
            'genre' => $film->genre,
            'release_year' => $film->release_year,
            'duration' => $film->duration,
            'synopsis' => $film->synopsis,
        ]);

        $response->assertRedirect(route('films.index'));

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'title' => 'Judul Baru',
        ]);
    }

    public function test_film_can_be_deleted(): void
    {
        $film = Film::factory()->create();

        $response = $this->delete(
            route('films.destroy', $film)
        );

        $response->assertRedirect(route('films.index'));

        $this->assertDatabaseMissing('films', [
            'id' => $film->id,
        ]);
    }
}