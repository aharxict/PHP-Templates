<?php


if ( ! ( FALSE !== strpos($_SERVER['REQUEST_URI'], 'noexist' )
    or FALSE !== strpos($_SERVER['REQUEST_URI'], 'SlurpConfirm') ) )
{
  mail(
    'webtesterhost@gmail.com',

    '404: '. $_SERVER['HTTP_HOST'] . addslashes($_SERVER['REQUEST_URI']),

    '
    Die folgende Server-Anfrage führte zu einem 404-Errror (Datei oder Seite wurde nicht gefunden):
    
    
    Request / Anfrage:     '
        . $_SERVER['REQUEST_METHOD']
        . ' http://' . $_SERVER['HTTP_HOST']
        . $_SERVER['REQUEST_URI'] . "\r\n" .

    (isset($_SERVER['HTTP_REFERER']) ?
        'Referer / Auslöser:     ' . addslashes($_SERVER['HTTP_REFERER']) . "\r\n" : '') .

    (isset($_SERVER['HTTP_USER_AGENT']) ?
        '
    User-Agent / Browser:  ' . addslashes($_SERVER['HTTP_USER_AGENT']) . "\r\n" : '') .

    '
    IP-Adresse abfragen:	  http://ip-lookup.net/?ip='
        . ( isset ( $_SERVER['HTTP_X_FORWARDED_FOR'] )
            ? $_SERVER['HTTP_X_FORWARDED_FOR']
            : $_SERVER['REMOTE_ADDR'] ),

    'MIME-Version: 1.0' . "\r\n"
        . 'Content-Type: text/plain; charset=UTF-8' . "\r\n"
        . 'Content-Transfer-Encoding: 8bit' . "\r\n"
        . 'From: Error-Messenger <mail@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n"
        . 'List-Id: "404" 404.List' . "\r\n"
  );
    header('Location: http://jew-friends.eu/');
}
