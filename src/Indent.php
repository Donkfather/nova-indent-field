<?php

namespace Donkfather\Indent;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Indent extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'indent';

    /**
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * Indent constructor.
     * @param Field $field
     * @param null $attribute
     * @param callable|null $resolveCallback
     */
    public function __construct(Field $field, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct('', $attribute, $resolveCallback);
        $this->withMeta(['child' => $field]);
        $this->level();
    }

    /**
     * @param int $level
     * @return $this
     */
    public function level(int $level = 2)
    {
        $paddingClass = $level * 2;
        $this->withMeta([
            'wrapperAttributes' => [
                'class' => "pl-{$paddingClass}"
            ]
        ]);

        return $this;
    }


    /**
     * Retrieve values of dependency fields
     *
     * @param mixed $resource
     * @param string $attribute
     * @return array|mixed
     */
    protected function resolveAttribute($resource, $attribute)
    {
        $this->child()->resolve($resource);

        return [];
    }

    /**
     * Fills the attributes of the model within the container if the dependencies for the container are satisfied.
     *
     * @param NovaRequest $request
     * @param string $requestAttribute
     * @param object $model
     * @param string $attribute
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        $this->child()->fill($request, $model);
    }

    /**
     * @return mixed
     */
    public function child(): Field
    {
        return $this->meta['child'];
    }
}
