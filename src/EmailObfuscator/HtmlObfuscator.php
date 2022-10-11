<?php 
namespace Concrete\Package\EmailObfuscator\Src\EmailObfuscator;
defined('C5_EXECUTE') or die('Access Denied');

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Http\ResponseAssetGroup;

class HtmlObfuscator extends AbstractObfuscator
{

    public function registerViewAssets()
    {
        $al = AssetList::getInstance();
        $al->register(
            'javascript', 'email_obfuscator/html', 'js/email_deobfuscator_html.js', array(),
            'email_obfuscator'
        );

        $r = ResponseAssetGroup::get();
        $r->requireAsset('javascript', 'email_obfuscator/html');
    }

    public function obfuscateMail($email)
    {
        $ret = "";
        $email = str_replace("@", "(at)", $email);
        for ($i = 0; $i < strlen($email); $i++) {
            $ret .= "&#" . ord($email[$i]) . ";";
        }
        return $ret;
    }

    public function obfuscateMailtoLinkHref($href)
    {
        $href = $this->obfuscateMail(str_replace("mailto:", "", $href));
        return "#MAIL:" . $href;
    }

}