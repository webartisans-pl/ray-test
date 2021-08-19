<?php

namespace Tests\Feature\Ray;

use App\Events\User\RolesUpdated;
use App\Events\User\UserCreated;
use App\Events\User\UsersCachedUpdated;
use App\Jobs\SendInvitations;
use App\Jobs\SendMarketingNotifications;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RayLaravelServiceTest extends TestCase
{
    /**
     * Basic examples of showQueries
     *
     * @test
     */
    public function showQueries(): void
    {
        /**
         * Will be displayed
         */
        ray()->showQueries();

        User::query()
            ->where('email', 'aga@webartisans.pl')
            ->first(); // Will be displayed

        ray()->stopShowingQueries();


        // Closure
        ray()->showQueries(function () {
            User::query()
                ->where('email', 'karol@webartisans.pl')
                ->first(); // Will be displayed
        });


        /**
         * Will not be displayed
         */
        User::query()
            ->where('email', 'rafal@webartisans.pl')
            ->first();

    }

    /**
     * Ray can count queries
     *
     * @test
     */
    public function countQueries()
    {
        ray()->countQueries(function () {
            User::all();
            User::query()->get();
            User::query()->where('email', 'rafal@webartisans.pl')->get();
        });
    }

    /**
     * You can add ray() in query builder
     *
     * @test
     */
    public function rayInQuery(): void
    {
        User::query()
            ->whereNull('password')
            ->ray()
            ->whereNotNull('google_id')
            ->ray()
            ->isVerified() // SCOPE
            ->ray()
            ->first();

    }

    /**
     * Display events
     *
     * @test
     */
    public function showEvents(): void
    {
        /**
         * @var User $user
         */
        $user = User::query()->first();


        ray()->showEvents();

        // Without param
        event(new UsersCachedUpdated());

        // With param
        event(new UserCreated($user));

        ray()->stopShowingEvents();


        // Will not be displayed
        event(new RolesUpdated($user, []));
    }

    /**
     * Display jobs
     *
     * @test
     */
    public function showJobs(): void
    {
        /**
         * Will be displayed
         */
        ray()->showJobs();
        dispatch(new SendInvitations());
        ray()->stopShowingJobs();

        /**
         * Will not be displayed
         */
        dispatch(new SendMarketingNotifications());
    }

    /**
     * Display cache
     *
     * @test
     */
    public function showCache(): void
    {
        /**
         * Will be displayed
         */
        ray()->showCache();
        Cache::put('web-artisan', ["Web", "Artisans"]);
        Cache::get('web-artisan');
        ray()->stopShowingCache();

        /**
         * Will not be displayed
         */
        Cache::get('web-artisan-2');
    }

    /**
     * Display https requests
     *
     * @test
     */
    public function showRequests(): void
    {
        /**
         * Will be displayed
         */
        ray()->showHttpClientRequests();
        ray(route('api.v1.users.index'));
        Http::get(route('api.v1.users.index'));
        ray()->stopShowingHttpClientRequests();

        /**
         * Will not be displayed
         */
        $user = User::query()->first();
        ray($user);
        Http::get(route('api.v1.users.show', ['user' => $user]));
    }

    /**
     * Display mail template
     *
     * @test
     */
    public function mailable(): void
    {
        ray()->mailable(new UserRegistered());
    }

    /**
     * Display information about models
     *
     * @test
     */
    public function models(): void
    {
        $users = User::all();

        ray()->model($users[0]);
        ray()->model($users[0], $users[1]);
        ray()->models(User::query()->take(2)->get());
    }
}
