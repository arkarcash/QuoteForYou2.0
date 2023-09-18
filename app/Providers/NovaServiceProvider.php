<?php

namespace App\Providers;

use App\Nova\Ads;
use App\Nova\Author;
use App\Nova\Banner;
use App\Nova\Blog;
use App\Nova\Book;
use App\Nova\BookAuthor;
use App\Nova\BookCategory;
use App\Nova\message;
use App\Nova\Month;
use App\Nova\Note;
use App\Nova\Category;
use App\Nova\Dashboards\Main;
use App\Nova\Order;
use App\Nova\Payment;
use App\Nova\Product;
use App\Nova\ProductPhoto;
use App\Nova\Report;
use App\Nova\Tag;
use App\Nova\User;
use App\Nova\Voice;
use App\Nova\VoiceCategory;
use App\Observers\MessageObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Element;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function () {
            \App\Models\message::observe(MessageObserver::class);
        });

        Nova::footer(function ($request){
            return 'Click For Freedom @ 2023';
        });

        Nova::mainMenu(function (\Illuminate\Http\Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('presentation-chart-bar'),
                MenuSection::resource(Month::class)->icon('chart-square-bar'),
                MenuSection::resource(message::class)->icon('chat'),
                MenuSection::resource(User::class)->icon('user-group'),
                MenuSection::resource(Ads::class)->icon('currency-dollar'),
                MenuSection::resource(Blog::class)->icon('chat-alt'),
                MenuSection::resource(Report::class)->icon('receipt-refund'),
                MenuSection::resource(Banner::class)->icon('view-boards'),

                MenuSection::make('Book', [
                    MenuItem::resource(BookAuthor::class),
                    MenuItem::resource(BookCategory::class),
                    MenuItem::resource(Book::class),
                ])->icon('credit-card')->collapsable(),

                MenuSection::make('Voice For You', [
                    MenuItem::resource(VoiceCategory::class),
                    MenuItem::resource(Voice::class),
                ])->icon('credit-card')->collapsable(),

                MenuSection::make('Poem & Quote', [
                    MenuItem::resource(Tag::class),
                    MenuItem::resource(Author::class),
                    MenuItem::resource(Note::class),
                ])->icon('pencil')->collapsable(),


            ];
        });



    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'ivan@gmail.com'
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {

            return [
                new Main,
            ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
