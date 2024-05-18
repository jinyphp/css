<?php
namespace Jiny\Css;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

use Illuminate\Routing\Router;
use Jiny\Admin\Http\Middleware\AdminSetup;
use Jiny\Admin\Http\Middleware\AdminAuth;
use Jiny\Admin\Http\Middleware\IsAdmin;
use Jiny\Admin\Http\Middleware\SuperAdminMiddleware;

class JinyCssServiceProvider extends ServiceProvider
{
    private $package = "jiny-css";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 설정파일 복사
        // php artisan vendor:publish --tag=config
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/css/setting.php'),
        ],'config');

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');


        $this->flexbox();
        $this->table();
        $this->forms();
        $this->componentLinks();
        $this->block();
        $this->images();

        $this->display();

    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {


        });

    }

    protected function display()
    {
        Blade::component($this->package.'::components.'.'display.table', 'display-table');
        Blade::component($this->package.'::components.'.'display.table-cell', 'display-table-cell');

    }

    protected function forms()
    {
        //Form
            /**
             * 폼 요소
             */
            Blade::component($this->package.'::components.'.'forms.form', 'form');
            Blade::component(\Jiny\Css\View\Components\Forms\FormRow::class, "form-row");
            Blade::component($this->package.'::components.'.'forms.row', 'form-row');
            Blade::component(\Jiny\Css\View\Components\FormHor::class, "form-hor");
            Blade::component($this->package.'::components.'.'forms.inline', 'form-inline');
            Blade::component(\Jiny\Css\View\Components\FormLabel::class, "form-label");
            Blade::component(\Jiny\Css\View\Components\FormItem::class, "form-item");
            //Blade::component($this->package.'::components.'.'forms.label', 'form-label');
            //Blade::component($this->package.'::components.'.'forms.item', 'form-item');
            Blade::component($this->package.'::components.'.'forms.input', 'form-input');
            Blade::component($this->package.'::components.'.'forms.text', 'form-text');
            Blade::component($this->package.'::components.'.'forms.email', 'form-email');
            Blade::component($this->package.'::components.'.'forms.number', 'form-number');
            Blade::component($this->package.'::components.'.'forms.radio', 'form-radio');
            Blade::component($this->package.'::components.'.'forms.checkbox', 'form-checkbox');
            Blade::component($this->package.'::components.'.'forms.checkbox', 'checkbox');
            Blade::component($this->package.'::components.'.'forms.input', 'input');
            Blade::component($this->package.'::components.'.'forms.select', 'select');
            Blade::component($this->package.'::components.'.'forms.option', 'option');
            Blade::component($this->package.'::components.'.'forms.textarea', 'textarea');

            Blade::component($this->package.'::components.'.'forms.progress', 'progress');

            Blade::component($this->package.'::components.'.'forms.formPost', 'form-post');
            Blade::component($this->package.'::components.'.'forms.formPatch', 'form-patch');
            Blade::component($this->package.'::components.'.'forms.submit', 'form-submit');
    }

    protected function flexbox()
    {

        // ## flex 박스
        // Blade::component('jinyui::components.'.'flex.row', 'flex-row');
        // Blade::component('jinyui::components.'.'flex.col', 'flex-col'); // 세로배치
        Blade::component($this->package.'::components.'.'flex.center', 'flex-center'); //가운데

        // flex박스를 양쪽으로 배치를 합니다.
        Blade::component($this->package.'::components.'.'flex.between', 'flex-between');

        Blade::component($this->package.'::components.'.'flex.end', 'flex-end');
        // Blade::component('jinyui::components.'.'flex.item', 'flex-item');

        Blade::component($this->package.'::components.'.'flex.column_center', 'flex-column-center'); //가운데

        // ## divide by flex
        // Blade::component('jinyui::components.'.'flex.divide', 'divide');
        // Blade::component('jinyui::components.'.'flex.divide-y', 'divide-y');
        // Blade::component('jinyui::components.'.'flex.divide-item', 'divide-item');

        // ## grid
        Blade::component($this->package.'::components.'.'flex.grid', 'grid');
    }

    protected function table($type="tailwind")
    {
        //Table
        if($type == "bootstrap") {
            Blade::component(\Jiny\Css\View\Components\Tables\Table::class, "table");
            Blade::component(\Jiny\Css\View\Components\Tables\TableHead::class, 'table-head');
            Blade::component(\Jiny\Css\View\Components\Tables\TableHead::class, 'thead');
            Blade::component(\Jiny\Css\View\Components\Tables\TableBody::class, 'table-body');
            Blade::component(\Jiny\Css\View\Components\Tables\TableBody::class, 'tbody');
            Blade::component($this->package.'::components.'.'tables.'.$type.'.check-all', 'table-check-all');
            Blade::component($this->package.'::components.'.'tables.'.$type.'.check-all', 'table-allcheck');
            Blade::component($this->package.'::components.'.'tables.'.$type.'.check', 'table-check');
        } else {
            // Tailwind
            Blade::component($this->package.'::components.'.'tables.'.$type.'.table', 'table');
            Blade::component($this->package.'::components.'.'tables.'.$type.'.th', 'th');
            Blade::component($this->package.'::components.'.'tables.'.$type.'.td', 'td');
            Blade::component($this->package.'::components.'.'tables.'.$type.'.td_center', 'td-center');

        }

    }

    protected function componentLinks()
    {
         // 링크
         Blade::component($this->package.'::components.'.'link.a', 'link');
         Blade::component($this->package.'::components.'.'link.void', 'link-void');
    }

    protected function block()
    {
        // Box model
        Blade::component($this->package.'::components.'.'box.box', 'box');
        Blade::component($this->package.'::components.'.'box.block', 'block');
        Blade::component($this->package.'::components.'.'box.callout-info', 'callout-info');
    }

    protected function images()
    {
        //Images
        Blade::component($this->package.'::components.'.'images.img', 'img');
        Blade::component($this->package.'::components.'.'images.img-cover', 'img-cover');
        Blade::component($this->package.'::components.'.'images.round', 'img-round');
        Blade::component($this->package.'::components.'.'images.circle', 'img-circle');
        Blade::component($this->package.'::components.'.'images.res', 'img-res');
        Blade::component($this->package.'::components.'.'images.thumb', 'img-thumb');

        Blade::component($this->package.'::components.'.'images.avata', 'avata'); //아바타 이미지 출력

        Blade::component($this->package.'::components.'.'figure.figure', 'figure');
        Blade::component($this->package.'::components.'.'figure.text', 'figure-text');

    }

}
