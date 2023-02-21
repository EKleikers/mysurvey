<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'              => ':attribute moet geaccepteerd zijn.',
    'active_url'            => ':attribute is geen geldige URL.',
    'after'                 => ':attribute moet een datum na :date zijn.',
    'after_or_equal'        => ':attribute moet een datum na of gelijk aan :date zijn.',
    'alpha'                 => ':attribute mag alleen letters bevatten.',
    'alpha_dash'            => ':attribute mag alleen letters, nummers, underscores (_) en streepjes (-) bevatten.',
    'alpha_num'             => ':attribute mag alleen letters en nummers bevatten.',
    'array'                 => ':attribute moet geselecteerde elementen bevatten.',
    'before'                => ':attribute moet een datum voor :date zijn.',
    'before_or_equal'       => ':attribute moet een datum voor of gelijk aan :date zijn.',
    'between'               => [
        'array'     => ':attribute moet tussen :min en :max items bevatten.',
        'file'      => ':attribute moet tussen :min en :max kilobytes zijn.',
        'numeric'   => ':attribute moet tussen :min en :max zijn.',
        'string'    => ':attribute moet tussen :min en :max karakters zijn.',
    ],
    'boolean'               => ':attribute moet \'true\' of \'false\' zijn.',
    'confirmed'             => ':attribute bevestiging komt niet overeen.',
    'date'                  => ':attribute moet een datum bevatten.',
    'date_equals' => 'Het :attribute moet een datum zijn die gelijk is aan :date.',
    'date_format'           => ':attribute moet een geldig datum formaat bevatten.',
    'different'             => ':attribute en :other moeten verschillend zijn.',
    'digits'                => ':attribute moet bestaan uit :digits cijfers.',
    'digits_between'        => ':attribute moet bestaan uit minimaal :min en maximaal :max cijfers.',
    'dimensions'            => ':attribute heeft geen geldige afmetingen voor afbeeldingen.',
    'distinct'              => ':attribute heeft een dubbele waarde.',
    'email'                 => ':attribute is geen geldig e-mailadres.',
    'exists'                => ':attribute bestaat niet.',
    'ends_with' => ':attribute moet eindigen op een van de volgende: :values',
    'file'                  => ':attribute moet een bestand zijn.',
    'filled'                => ':attribute is verplicht.',
    'gt' => [
        'numeric' => 'Het :attribute moet groter zijn dan :value.',
        'file' => 'Het :attribute  moet groter zijn dan :value kilobytes.',
        'string' => 'Het :attribute moet groter zijn dan :value karakters.',
        'array' => 'Het :attribute moet meer dan :value items bevatten.',
    ],
    'gte' => [
        'numeric' => 'Het :attribute moet groter zijn dan of gelijk zijn aan :value.',
        'file' => 'Het :attribute moet groter zijn dan of gelijk zijn aan :value kilobytes.',
        'string' => 'Het :attribute moet groter zijn dan of gelijk zijn aan :value karakters.',
        'array' => 'Het :attribute moet :value items of meer hebben.',
    ],
    'image'                 => ':attribute moet een afbeelding zijn.',
    'in'                    => ':attribute is ongeldig.',
    'in_array'              => ':attribute bestaat niet in :other.',
    'integer'               => ':attribute moet een getal zijn.',
    'ip'                    => ':attribute moet een geldig IP-adres zijn.',
    'ipv4'                  => ':attribute moet een geldig IPv4-adres zijn.',
    'ipv6'                  => ':attribute moet een geldig IPv6-adres zijn.',
    'json'                  => ':attribute moet een geldige JSON-string zijn.',
    'lt' => [
        'numeric' => 'Het :attribute moet kleiner zijn dan :value.',
        'file' => 'Het :attribute moet kleiner zijn dan :value kilobytes.',
        'string' => 'Het :attribute moet minder zijn dan :value karakters.',
        'array' => 'Het :attribute moet minder dan :value items bevatten.',
    ],
    'lte' => [
        'numeric' => 'Het :attribute moet kleiner zijn dan of gelijk zijn aan :value.',
        'file' => 'Het :attribute moet kleiner zijn dan of gelijk zijn aan: :value kilobytes.',
        'string' => 'Het :attribute moet kleiner zijn dan of gelijk zijn aan :value karakters.',
        'array' => 'Het :attribute mag niet meer dan :value items bevatten.',
    ],
    'max'                   => [
        'array'     => ':attribute mag niet meer dan :max items bevatten.',
        'file'      => ':attribute mag niet meer dan :max kilobytes zijn.',
        'numeric'   => ':attribute mag niet hoger dan :max zijn.',
        'string'    => ':attribute mag niet uit meer dan :max karakters bestaan.',
    ],
    'mimes'                 => ':attribute moet een bestand zijn van het bestandstype :values.',
    'mimetypes'             => ':attribute moet een bestand zijn van het bestandstype :values.',
    'min'                   => [
        'array'     => ':attribute moet minimaal :min items bevatten.',
        'file'      => ':attribute moet minimaal :min kilobytes zijn.',
        'numeric'   => ':attribute moet minimaal :min zijn.',
        'string'    => ':attribute moet minimaal :min karakters zijn.',
    ],
    'not_in'                => 'Het formaat van :attribute is ongeldig.',
    'not_regex' => 'Het :attribute formaat is ongeldig.',
    'numeric'               => ':attribute moet een nummer zijn.',
    'present'               => ':attribute moet beschikbaar zijn.',
    'regex'                 => ':attribute formaat is ongeldig.',
    'required'              => ':attribute is verplicht.',
    'required_if'           => ':attribute is verplicht indien :other gelijk is aan :value.',
    'required_unless'       => ':attribute is verplicht tenzij :other gelijk is aan :values.',
    'required_with'         => ':attribute is verplicht i.c.m. :values',
    'required_with_all'     => ':attribute is verplicht i.c.m. :values',
    'required_without'      => ':attribute is verplicht als :values niet ingevuld is.',
    'required_without_all'  => ':attribute is verplicht als :values niet ingevuld zijn.',
    'same'                  => ':attribute en :other moeten overeenkomen.',
    'size'                  => [
        'array'     => ':attribute moet :size items bevatten.',
        'file'      => ':attribute moet :size kilobyte zijn.',
        'numeric'   => ':attribute moet :size zijn.',
        'string'    => ':attribute moet :size karakters zijn.',
    ],
    'starts_with' => 'Het :attribute moet beginnen met een van de volgende: :values',
    'string'                => ':attribute moet een tekenreeks zijn.',
    'timezone'              => ':attribute moet een geldige tijdzone zijn.',
    'unique'                => ':attribute is al in gebruik.',
    'uploaded'              => 'Het uploaden van :attribute is mislukt.',
    'url'                   => ':attribute is geen geldige URL.',
    'uuid' => 'Het :attribute moet een geldige UUID zijn.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */


    'custom'    => [
        'turnover'    => [
            'integer' => 'Bedrijfsomzet moet een getal zijn.',
        ],
        'attribute-name'    => [
            'rule-name' => 'bericht op maat',
        ],
        'email'             => [
            'unique'    => ':attribute is al geregistreerd.',
        ],
        'password'          => [
            'min'   => ':attribute moet langer zijn dan :min tekens',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'    => [
        'address'               => 'adres',
        'age'                   => 'leeftijd',
        'available'             => 'beschikbaar',
        'body'                  => 'inhoud',
        'city'                  => 'stad',
        'content'               => 'inhoud',
        'country'               => 'land',
        'date'                  => 'datum',
        'day'                   => 'dag',
        'description'           => 'omschrijving',
        'email'                 => 'e-mailadres',
        'excerpt'               => 'uittreksel',
        'first_name'            => 'voornaam',
        'gender'                => 'geslacht',
        'hour'                  => 'uur',
        'last_name'             => 'achternaam',
        'message'               => 'boodschap',
        'minute'                => 'minuut',
        'mobile'                => 'mobiel',
        'month'                 => 'maand',
        'name'                  => 'naam',
        'password'              => 'wachtwoord',
        'password_confirmation' => 'wachtwoord bevestiging',
        'phone'                 => 'telefoonnummer',
        'second'                => 'seconde',
        'sex'                   => 'geslacht',
        'size'                  => 'grootte',
        'subject'               => 'onderwerp',
        'time'                  => 'tijd',
        'title'                 => 'titel',
        'username'              => 'gebruikersnaam',
        'year'                  => 'jaar',
    ],
];
