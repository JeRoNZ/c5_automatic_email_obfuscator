<?php 
namespace Concrete\Package\EmailObfuscator\Src\EmailObfuscator;
defined('C5_EXECUTE') or die(_('Access Denied.'));


abstract class AbstractObfuscator implements ObfuscatorInterface
{

    public function registerViewAssets()
    {
        // Register assets if needed
    }

    public function obfuscateMail($email)
    {
        return $email;
    }

    public function obfuscateMailtoLinkHref($href)
    {
        return $href;
    }

}