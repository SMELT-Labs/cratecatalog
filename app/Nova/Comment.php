<?php

namespace App\Nova;

use App\Nova\Actions\ApproveComment;
use App\Nova\Actions\RejectComment;
use App\Nova\Metrics\NewComments;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasOneThrough;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use \Spatie\Comments\Models\Comment as CommentModel;

class Comment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Spatie\Comments\Models\Comment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [


            Image::make('Avatar')
                ->thumbnail($this->handleImage($this->commentator?->avatar))
                ->preview($this->handleImage($this->commentator?->avatar))
                ->onlyOnIndex(),

//            Text::make('title', function (CommentModel $comment) {
//                return $comment->topLevel()->commentable?->commentableName() ?? 'Deleted...';
//            })->readonly(),

            MorphTo::make('Commentator')->types([
                User::class,
            ])->searchable(),

//            Text::make('Original text')->onlyOnIndex(),

            Text::make('', function (CommentModel $comment) {
                if (! $url = $comment?->commentUrl()) {
                    return '';
                }

                return "<a target=\"show_comment\" href=\"{$url}\" class='text-sky-500 hover:bg-sky-700 underline' style='text-decoration: underline'>{$comment->text}</a>";

            })->asHtml()->hideFromDetail(),

            Markdown::make('Original text')->hideFromIndex(),



            Text::make('status', function(CommentModel $comment) {
                if ($comment->isApproved()) {
                    return "<div class='inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100' style='	color: rgb(22 101 52);'>Approved</div>";
                }

                return "<div class='inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100' style='color: rgb(133 77 14);'>Pending</div>";
            })->asHtml(),

            DateTime::make('Created at')->default(function () {
                return now();
            })->onlyOnDetail(),

            MorphMany::make('Comments'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            NewComments::make()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            ApproveComment::make(),
            RejectComment::make()
        ];
    }
}
