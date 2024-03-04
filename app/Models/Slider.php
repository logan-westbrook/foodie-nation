<?php

namespace App\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Slider extends UpdaterModel
{
    use HasFactory;
    use FileUploadTrait;

    public function deleteSlider()
    {
        self::removeImage($this->image);
        $this->delete();
    }

    public function setAndSave(
        Request $request,
        ?string $oldPath = null
    ): ?self {
        /*
         * as set up on, on request create, image is required
         * so we don't need to worry about $this->image being empty
         * unless it's an edit which is acceptable
        **/
        $image = self::uploadFile(
            $request,
            'image',
            $oldPath
        ) ?: $this->image;

        return $this
            ->setImage($image)
            ->setOffer($request->offer)
            ->setTitle($request->title)
            ->setSubTitle($request->sub_title)
            ->setShortDescription($request->short_description)
            ->setButtonLink($request->button_link)
            ->setStatus($request->status)
            ->saveModel();
    }

    public static function createNewSliderFromRequest(Request $request): ?self
    {
        return self::createNewModel()
            ->setAndSave($request);
    }

    public function updateSliderFromRequest(Request $request): ?self
    {
        return $this
            ->setAndSave($request, $this->image);
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setOffer(?string $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setSubTitle(string $subTitle): self
    {
        $this->sub_title = $subTitle;

        return $this;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->short_description = $shortDescription;

        return $this;
    }

    public function setButtonLink(?string $buttonLink): self
    {
        $this->button_link = $buttonLink;

        return $this;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
