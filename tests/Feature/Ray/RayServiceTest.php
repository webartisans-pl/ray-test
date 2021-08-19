<?php

namespace Tests\Feature\Ray;

use App\Models\User;
use Tests\TestCase;

class RayServiceTest extends TestCase
{
    /**
     * Example of var_dump() / dump() / dd() approach
     *
     * @test
     */
    public function ddApproach(): void
    {
        $users = User::query()->get();

        // Object var_dump()
        var_dump($users->first());

        // Collection dump()
        dump($users);

        // Array dd()
        dd($users->toArray());
    }

    /**
     * Very basic examples of ray() usage
     *
     * @test
     */
    public function basics(): void
    {
        // String
        ray('Dobry wieczór, Web Artisans!');

        // Multiple arguments
        ray('a string', ['a' => 1, 'b' => 2, 'c' => 3]);

        // Pause
        ray()->pause();

        // Object
        ray(app());

        // Colorize
        ray('Jetem zielony!')->green();
        ray('Jestem pomarańczowy!')->orange();

        // Die
        rd('Zakończ tutaj.');

        // Will not be dispalyed
        ray('Tego nie zobaczymy');
    }

    /**
     * Open new screen in ray app
     *
     * @test
     */
    public function newScreen(): void
    {
        ray()->newScreen();

        ray('Jetem zielony!')->green();

        ray()->newScreen();

        ray('Jestem pomarańczowy!')->orange();
        ray('Jestem czerwony!')->red();
    }

    /**
     * Display Ray notification
     *
     * @test
     */
    public function notify()
    {
        ray()->notify('Moja notyfiikacja');
    }
}
