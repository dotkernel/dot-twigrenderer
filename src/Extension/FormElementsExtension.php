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
use Zend\Form\Element\Button;
use Zend\Form\Element\Captcha;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Collection;
use Zend\Form\Element\Color;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Date;
use Zend\Form\Element\DateSelect;
use Zend\Form\Element\DateTime;
use Zend\Form\Element\DateTimeLocal;
use Zend\Form\Element\DateTimeSelect;
use Zend\Form\Element\Email;
use Zend\Form\Element\File;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Image;
use Zend\Form\Element\Month;
use Zend\Form\Element\MonthSelect;
use Zend\Form\Element\MultiCheckbox;
use Zend\Form\Element\Number;
use Zend\Form\Element\Password;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Range;
use Zend\Form\Element\Search;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Tel;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Time;
use Zend\Form\Element\Url;
use Zend\Form\Element\Week;
use Zend\Form\Fieldset;

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
