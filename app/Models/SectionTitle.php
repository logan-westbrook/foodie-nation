<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SectionTitle extends Model
{
    use HasFactory;

    protected $fillable = [ 'key', 'value' ];

    public const array TITLES = [
        'why_choose_top_title',
        'why_choose_main_title',
        'why_choose_sub_title',
    ];

    public static function updateTitlesFromRequest(Request $request): void
    {
        foreach(self::TITLES as $title) {
            self::updateOrCreate(
                [ 'key' => $title ],
                [ 'value' => $request->$title ],
            );
        }
    }

    /** @return SectionTitle[] */
    public static function fetchSectionTitles(): Collection
    {
        return SectionTitle::whereIn(
            'key',
            self::TITLES
        )->pluck('value', 'key');
    }
}
