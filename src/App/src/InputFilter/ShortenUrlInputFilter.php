<?php

declare(strict_types=1);

namespace App\InputFilter;

use Laminas\InputFilter\Input;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator;
use Laminas\Filter;

class ShortenUrlInputFilter extends InputFilter
{
    public function init()
    {
        parent::init();

        $inputs = $this->generateInputs();
        foreach ($inputs as $input) {
            $this->add($input);
        }
    }

    private function generateInputs(): array
    {
        $inputs = [];

        $url = new Input('url');
        $url->setRequired(true);
        $url->getFilterChain()->attach(new Filter\StringTrim());
        $url
            ->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\Callback(
                function (string $value) {
                    return filter_var($value, FILTER_VALIDATE_URL);
                }
            ));
        $inputs[] = $url;

        return $inputs;
    }
}
