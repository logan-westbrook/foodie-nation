<?php

namespace App\Traits;

trait HtmlCreatorTrait
{
    public const int ACTION_WIDTH = 150;

    protected static function createButton(
        string $route,
        int $id,
        string $iconType,
        string $classes = '',
    ): string {
        $link = route($route, $id);

        return <<<HTML
            <a href="$link" class="ml-2 btn $classes">
                <i class="fas fa-$iconType"></i>
            </a>
            HTML;
    }

    public static function createStatusHtml(int $status): string {
        return $status === 1
            ? <<<HTML
                <span class="badge badge-primary">Active</span>
                HTML
            : <<<HTML
                <span class="badge badge-danger">Inactive</span>
                HTML;
    }

    public static function createIcon(string $icon): string {
        return <<<HTML
            <i style="font-size:30px;" class="$icon"></i>
            HTML;
    }

    public static function createImage(string $image): string
    {
        return <<<HTML
            <img width="100" height="100" src="$image" alt="image">
            HTML;
    }

    public static function createEditDeleteActionButtons(
        string $id,
        string $routePrefix,
    ): string {
        $editButton = self::createButton(
            "$routePrefix.edit",
            $id,
            'edit',
            'btn-primary'
        );

        $deleteButton = self::createButton(
            "$routePrefix.destroy",
            $id,
            'trash',
            'btn-danger delete-item'
        );

        return <<<HTML
            $editButton
            $deleteButton
            HTML;
    }
}

