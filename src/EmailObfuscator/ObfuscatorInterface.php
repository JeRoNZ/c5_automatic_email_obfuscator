<?php 
namespace Concrete\Package\EmailObfuscator\Src\EmailObfuscator;

defined('C5_EXECUTE') or die(_('Access Denied.'));

interface ObfuscatorInterface
{

    public function obfuscateMail($email);
    public function obfuscateMailtoLinkHref($href);

}