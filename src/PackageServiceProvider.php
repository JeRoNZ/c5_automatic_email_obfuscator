<?php 
namespace Concrete\Package\EmailObfuscator\Src;

defined('C5_EXECUTE') or die(_('Access Denied.'));

use Core;
use Config;
use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Page\View\PageView;
use Concrete\Core\Support\Facade\Events;

class PackageServiceProvider extends Provider
{

    public function register()
    {
        if (!$this->app->bound('email_obfuscator/obfuscator')) {
            $this->app->singleton('email_obfuscator/obfuscator', function () {
                $method = Config::get('app.obfuscator.method', 'html');
                $name = Core::make('helper/text')->camelcase($method);
                $obfuscatorClass = '\Concrete\Package\EmailObfuscator\Src\EmailObfuscator\\' . $name . 'Obfuscator';
                if (!class_exists($obfuscatorClass)) {
                    throw new \Exception(t("Invalid email obfuscation method defined: %s", $method));
                }
                return new $obfuscatorClass;
            });
        }
    }

    public function registerEvents()
    {
        $helper = new EmailObfuscationHelper();

        Events::addListener('on_page_output', function ($event) use ($helper) {
            $helper->handle($event);
        });
        Events::addListener('on_start', function ($event) {
            if ($event->hasArgument('view')) {
                $view = $event->getArgument('view');
                if ($view instanceof PageView) {
                    Core::make('email_obfuscator/obfuscator')->registerViewAssets();
                }
            }
        });
    }

}