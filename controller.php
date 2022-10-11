<?php 
namespace Concrete\Package\EmailObfuscator;

defined('C5_EXECUTE') or die(_('Access Denied.'));

use Core;
use Concrete\Core\Package\Package;
use Concrete\Package\EmailObfuscator\Src\PackageServiceProvider;

class Controller extends Package
{

    protected $pkgHandle = 'email_obfuscator';
    protected $appVersionRequired = '9.1.2';
    protected $pkgVersion = '3.0.0';

	protected $pkgAutoloaderRegistries = [
		'src' => 'Concrete\Package\EmailObfuscator\Src',
	];


    public function getPackageName()
    {
        return t('V3 Email Obfuscator');
    }

    public function getPackageDescription()
    {
        return t('Automatically obfuscates all the e-mail addresses on your site to a form that most spambots cannot read.');
    }

    public function on_start()
    {
        $app = Core::getFacadeApplication();
        $sp = new PackageServiceProvider($app);
        $sp->register();
        $sp->registerEvents();
    }

}