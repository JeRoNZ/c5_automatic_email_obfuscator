<?php 
namespace Concrete\Package\EmailObfuscator\Src\EmailObfuscator;

defined('C5_EXECUTE') or die('Access Denied');

use Core;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Http\ResponseAssetGroup;

class RtlObfuscator extends AbstractObfuscator
{

    public function registerViewAssets()
    {
        $al = AssetList::getInstance();
        $al->register(
            'javascript', 'email_obfuscator/rtl', 'js/email_deobfuscator_rtl.js', array(),
            'email_obfuscator'
        );

        $r = ResponseAssetGroup::get();
        $r->requireAsset('javascript', 'email_obfuscator/rtl');
    }

    public function obfuscateMail($email)
    {
        $ret = '<span style="unicode-bidi:bidi-override; direction: rtl;">';
        $ret .= strrev($email);
        $ret .= '</span>';
        return $ret;
    }

    public function obfuscateMailtoLinkHref($href)
    {
        return "#MAIL:" . strrev(str_replace("mailto:", "", $href));
    }

}
