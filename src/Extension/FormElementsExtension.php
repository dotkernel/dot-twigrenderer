<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Captcha;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Color;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Date;
use Laminas\Form\Element\DateSelect;
use Laminas\Form\Element\DateTime;
use Laminas\Form\Element\DateTimeLocal;
use Laminas\Form\Element\DateTimeSelect;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\File;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Image;
use Laminas\Form\Element\Month;
use Laminas\Form\Element\MonthSelect;
use Laminas\Form\Element\MultiCheckbox;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Range;
use Laminas\Form\Element\Search;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Tel;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Element\Time;
use Laminas\Form\Element\Url;
use Laminas\Form\Element\Week;
use Laminas\Form\Fieldset;

/**
 * Class FormElementsExtension
 * @package Dot\Twig\Extension
 */
class FormElementsExtension extends AbstractExtension
{

    protected $formElements = [
        'Button' => Button::class,
        'Captcha' => Captcha::class,
        'Checkbox' => Checkbox::class,
        'Collection' => Collection::class,
        'Color' => Color::class,
        'Csrf' => Csrf::class,
        'Date' => Date::class,
        'DateSelect' => DateSelect::class,
        'DateTime' => DateTime::class,
        'DateTimeLocal' => DateTimeLocal::class,
        'DateTimeSelect' => DateTimeSelect::class,
        'Email' => Email::class,
        'File' => File::class,
        'Fieldset' => Fieldset::class,
        'Hidden' => Hidden::class,
        'Image' => Image::class,
        'Month' => Month::class,
        'MonthSelect' => MonthSelect::class,
        'MultiCheckbox' => MultiCheckbox::class,
        'Number' => Number::class,
        'Password' => Password::class,
        'Radio' => Radio::class,
        'Range' => Range::class,
        'Search' => Search::class,
        'Select' => Select::class,
        'Submit' => Submit::class,
        'Tel' => Tel::class,
        'Text' => Text::class,
        'Textarea' => Textarea::class,
        'Time' => Time::class,
        'Url' => Url::class,
        'Week' => Week::class
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'dot-form';
    }

    /**
     * @return array
     */
    public function getTests(): array
    {
        $tests = [];
        foreach ($this->formElements as $element => $class) {
            $tests[] = new TwigTest($element, function ($value) use ($class) {
                return ($value instanceof $class);
            });
        }

        return $tests;
    }
}
