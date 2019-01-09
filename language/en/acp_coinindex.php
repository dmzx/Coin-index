<?php
/**
*
* @package phpBB Extension - Coin index
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'COININDEX_ENABLE'					=> 'Enable Coin index',
	'COININDEX_ENABLE_EXPLAIN'			=> 'Enable the Coin on index extension.',
	'COININDEX_PLACEHOLDER'				=> 'Cryptocurrency',
	'COININDEX_PLACEHOLDER_NAME'		=> 'Cryptoname',
	'COININDEX_PLACEHOLDER_CURRENCY'	=> 'Currency',
	'COININDEX_PLACEHOLDER_SIZE'		=> 'Format',
	'COININDEX'							=> 'Set Coin',
	'COININDEX_EXPLAIN'					=> '<em>We have price widgets for over 400 cryptocurrencies. <br />Prices can be denoted in BTC and in 13 fiat currencies: <br />usd, eur, cny, gbp, rub, cad, jpy, hkd, brl, idr, aud, krw, inr, try and zar. <br /><br />Our widgets have 3 different formats with the following resolutions:<br />
- 300 x 135 = small<br />
- 300 x 240 = medium<br />
- 300 x 340 = large<br /><br />
To generate a price widget follow 4 simple steps: <br />
- Fill in the cryptocurrency<br />
- Fill in the cryptoname<br />
- Fill in the currency<br />
- Fill in the format
</em>',
	'COININDEX_TEXT'					=> 'Coin name',
	'COININDEX_CURRENCY'				=> 'Currency',
	'COININDEX_SIZE'					=> 'Format size',
	'COININDEX_MORE_LINKS'				=> 'Add Coin',
	'COININDEX_SAVED'					=> 'Coin index settings saved',
	'COININDEX_VERSION'					=> 'Version',
));
