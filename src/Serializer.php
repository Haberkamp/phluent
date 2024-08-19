<?php

namespace Phluent;

class Serializer
{
    public static function serialize(mixed $value): string
    {
        if ($value === "\x00") {
            return 'Binary String: 0x00';
        }

        if ($value === "\n") {
            return "'\\n\n'";
        }

        if ($value === "\r") {
            return "'\\r\n'";
        }

        if (is_array($value)) {
            $items = implode(', ', array_map(fn ($item) => self::serialize($item), $value));

            return 'Array (' . count($value) . ') [' . $items . ']';
        }

        if (is_string($value)) {
            return '\'' . $value . '\'';
        }

        if (is_int($value)) {
            return (string)$value;
        }

        if (is_float($value)) {
            $float = unpack("f", pack("f", $value))[1];
            $precision = str_replace('0.', '', (string)$float);
            $maxPrecision = strlen($precision) > 3 ? 3 : strlen($precision);

            $result = number_format($float, $maxPrecision, '.', '');

            $result = rtrim($result, '0');
            if (str_ends_with($result, '.')) {
                $result .= '0';
            }

            return $result;
        }

        if ($value === null) {
            return 'null';
        }

        return $value ? 'true' : 'false';
    }
}
