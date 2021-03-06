<?php

namespace App\Nova;

use App\Nova\Metrics\NewBoxesPerDay;
use App\Nova\Metrics\NewBoxesProgress;
use DinandMentink\Markdown\Markdown;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown as DefaultMarkdown;
use Laravel\Nova\Fields\MorphedByMany;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Spatie\TagsField\Tags;

class Box extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Box::class;

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
    public static $search = [
        'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

            Panel::make('Media', [
                Image::make('Header')
                    ->help('A banner image for the box company.')
                    ->store($this->handleStorage('/headers', 'header'))
                    ->preview($this->handleImage())
                    ->thumbnail($this->handleImage())
                    ->required(),
//
                Image::make('Logo')
                    ->help('The box company\'s logo.')
                    ->store($this->handleStorage('/logos', 'logo'))
                    ->preview($this->handleImage())
                    ->thumbnail($this->handleImage())
                    ->required(),
            ]),

            Panel::make('Content', [
                Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),

                Text::make('Excerpt', 'short')
                    ->help('A short description of the boxes contents.')
                    ->required(),

                Markdown::make('Description')
                    ->help("A detailed description of the box and related information.")
                    ->uploads()
                    ->required(),

                URL::make('Website')
                    ->help("A URL linking to the company's website.")
                    ->required(),

                Text::make('Price Range', 'priceRange')
                    ->onlyOnIndex(),
            ]),

            Panel::make('Details', [
                Tags::make('Tags')
                    ->help('Press enter to set tag')
                    ->withMeta([
                        "placeholder" => "Add tags... Press [enter] to set tags."
                    ]),
                URL::make('RSS')
                    ->hideFromIndex()
                    ->help("A direct link an RSS feed to display company updates."),
            ]),

            MorphMany::make('Price Points', 'prices', Price::class),

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
            NewBoxesProgress::make(),
            NewBoxesPerDay::make(),
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
        return [];
    }
}
