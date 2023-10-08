<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Validator;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;
use TYPO3\CMS\Extbase\Validation\Exception\InvalidValidationOptionsException;

/**
 * Validator for string options
 */
final class StringOptionsValidator extends AbstractValidator
{
    /**
     * Array containing supported options
     * 
     * @var array
     */
    protected $supportedOptions = [
        'allowed' => [[], 'List of allowed strings', 'array'],
    ];

    /**
     * Checks if the given value is a string and one of the allowed strings
     *
     * @throws InvalidValidationOptionsException
     */
    public function isValid(mixed $value): void
    {
        // Check if allowed values only contain strings
        foreach($this->options['allowed'] as $allowed) {
            if (!is_string($allowed)) {
                throw new InvalidValidationOptionsException($this->translateErrorMessage('validator.stringOptions.allowedStringInvalid', 'chf_base'), 1691677298);
            }
        }

        // Check if value is a string
        if (!is_string($value)) {
            $this->addError($this->translateErrorMessage('validator.stringOptions.invalidString', 'chf_base'), 1691677428);

        // Check if value is one of the allowed values
        } elseif (!in_array($value, $this->options['allowed'])) {
            $this->addError($this->translateErrorMessage('validator.stringOptions.notAllowedValue', 'chf_base'), 1691677607);
        }
    }
}

?>