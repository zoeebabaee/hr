<?php
namespace HR\ViewComposers;

use Carbon\Carbon;
use HR\Content;
use HR\ContentCategory;
use HR\Message;

class Folder{
    public static function index()
    {
        $counter = array(
            'deleted' => Message::onlyTrashed()->where('read_at',null)->count(),
            'inbox' => Message::all()->where('read_at',null)->count()
        );
        return $counter;
    }
}
