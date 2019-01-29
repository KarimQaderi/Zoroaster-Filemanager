<?php

    namespace KarimQaderi\ZoroasterFilemanager;

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\ServiceProvider;
    use KarimQaderi\Zoroaster\Sidebar\FieldMenu\MenuItem;
    use KarimQaderi\Zoroaster\Zoroaster;

    class FilemanagerServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            $this->loadViewsFrom(__DIR__ . '/../resources/views' , 'Zoroaster-filemanager');

            $this->publishes([
                __DIR__ . '/../dist' => public_path('Zoroaster-assets/Zoroaster-Filemanager')
            ] , 'Zoroaster-filemanager-assets');

            $this->app->booted(function(){
                $this->routes();
            });

            Zoroaster::style(asset('/Zoroaster-assets/Zoroaster-Filemanager/style.css'));
            Zoroaster::script(asset('/Zoroaster-assets/Zoroaster-Filemanager/Zoroaster-Filemanager.js'));

            Zoroaster::jsRoute([
                'Zoroaster-filemanager.updateFile',
                'Zoroaster-filemanager.createFolder',
                'Zoroaster-filemanager.getData',
                'Zoroaster-filemanager.getInfo',
                'Zoroaster-filemanager.removeFile',
                'Zoroaster-filemanager.rename',
                'Zoroaster-filemanager.getFilemanager',
            ]);

            Zoroaster::SidebarMenus([
                MenuItem::make()->route('Zoroaster-filemanager.index','مدیریت فایل')->icon('folder-2')
            ]);

        }

        /**
         * Register the tool's routes.
         *
         * @return void
         */
        protected function routes()
        {
            if($this->app->routesAreCached()){
                return;
            }

            Route::middleware(['web','can:Zoroaster' , 'can:ZoroasterFilemanager'])
                ->namespace('\KarimQaderi\ZoroasterFilemanager\Http\Controllers')
                ->prefix(config('Zoroaster.path').'/filemanager')
                ->as('Zoroaster-filemanager.')
                ->group(__DIR__ . '/../routes/web.php');
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
