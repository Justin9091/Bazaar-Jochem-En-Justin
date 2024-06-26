<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validatie Taalregels
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels bevatten de standaardfoutmeldingen gebruikt door
    | de validator class. Sommige van deze regels hebben meerdere versies zoals
    | de grootte regels. Voel je vrij om elk van deze berichten hier aan te passen.
    |
    */

    'accepted' => 'De :attribute moet worden geaccepteerd.',
    'accepted_if' => 'De :attribute moet worden geaccepteerd wanneer :other :value is.',
    'active_url' => 'De :attribute is geen geldige URL.',
    'after' => 'De :attribute moet een datum zijn na :date.',
    'after_or_equal' => 'De :attribute moet een datum zijn na of gelijk aan :date.',
    'alpha' => 'De :attribute mag alleen letters bevatten.',
    'alpha_dash' => 'De :attribute mag alleen letters, cijfers, streepjes en underscores bevatten.',
    'alpha_num' => 'De :attribute mag alleen letters en cijfers bevatten.',
    'array' => 'De :attribute moet een array zijn.',
    'ascii' => 'De :attribute mag alleen enkelbyte alfanumerieke tekens en symbolen bevatten.',
    'before' => 'De :attribute moet een datum zijn voor :date.',
    'before_or_equal' => 'De :attribute moet een datum zijn voor of gelijk aan :date.',
    'between' => [
        'array' => 'De :attribute moet tussen :min en :max items bevatten.',
        'file' => 'De :attribute moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'De :attribute moet tussen :min en :max liggen.',
        'string' => 'De :attribute moet tussen :min en :max tekens zijn.',
    ],
    'boolean' => 'Het :attribute veld moet waar of onwaar zijn.',
    'confirmed' => 'De :attribute bevestiging komt niet overeen.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => 'De :attribute is geen geldige datum.',
    'date_equals' => 'De :attribute moet een datum zijn gelijk aan :date.',
    'date_format' => 'De :attribute komt niet overeen met het formaat :format.',
    'decimal' => 'De :attribute moet :decimal decimalen bevatten.',
    'declined' => 'De :attribute moet worden geweigerd.',
    'declined_if' => 'De :attribute moet worden geweigerd wanneer :other :value is.',
    'different' => 'De :attribute en :other moeten verschillend zijn.',
    'digits' => 'De :attribute moet :digits cijfers bevatten.',
    'digits_between' => 'De :attribute moet tussen :min en :max cijfers bevatten.',
    'dimensions' => 'De :attribute heeft ongeldige afmetingen voor afbeeldingen.',
    'distinct' => 'Het :attribute veld heeft een dubbele waarde.',
    'doesnt_end_with' => 'De :attribute mag niet eindigen met een van de volgende: :values.',
    'doesnt_start_with' => 'De :attribute mag niet beginnen met een van de volgende: :values.',
    'email' => 'De :attribute moet een geldig e-mailadres zijn.',
    'ends_with' => 'De :attribute moet eindigen met een van de volgende: :values.',
    'enum' => 'De geselecteerde :attribute is ongeldig.',
    'exists' => 'De geselecteerde :attribute is ongeldig.',
    'file' => 'De :attribute moet een bestand zijn.',
    'filled' => 'Het :attribute veld moet een waarde hebben.',
    'gt' => [
        'array' => 'De :attribute moet meer dan :value items bevatten.',
        'file' => 'De :attribute moet groter zijn dan :value kilobytes.',
        'numeric' => 'De :attribute moet groter zijn dan :value.',
        'string' => 'De :attribute moet langer zijn dan :value tekens.',
    ],
    'gte' => [
        'array' => 'De :attribute moet :value items of meer bevatten.',
        'file' => 'De :attribute moet groter zijn dan of gelijk aan :value kilobytes.',
        'numeric' => 'De :attribute moet groter zijn dan of gelijk aan :value.',
        'string' => 'De :attribute moet langer zijn dan of gelijk aan :value tekens.',
    ],
    'image' => 'De :attribute moet een afbeelding zijn.',
    'in' => 'De geselecteerde :attribute is ongeldig.',
    'in_array' => 'Het :attribute veld bestaat niet in :other.',
    'integer' => 'De :attribute moet een geheel getal zijn.',
    'ip' => 'De :attribute moet een geldig IP-adres zijn.',
    'ipv4' => 'De :attribute moet een geldig IPv4-adres zijn.',
    'ipv6' => 'De :attribute moet een geldig IPv6-adres zijn.',
    'json' => 'De :attribute moet een geldige JSON-string zijn.',
    'lowercase' => 'De :attribute moet in kleine letters zijn.',
    'lt' => [
        'array' => 'De :attribute moet minder dan :value items bevatten.',
        'file' => 'De :attribute moet kleiner zijn dan :value kilobytes.',
        'numeric' => 'De :attribute moet kleiner zijn dan :value.',
        'string' => 'De :attribute moet korter zijn dan :value tekens.',
    ],
    'lte' => [
        'array' => 'De :attribute mag niet meer dan :value items bevatten.',
        'file' => 'De :attribute moet kleiner zijn dan of gelijk aan :value kilobytes.',
        'numeric' => 'De :attribute moet kleiner zijn dan of gelijk aan :value.',
        'string' => 'De :attribute moet korter zijn dan of gelijk aan :value tekens.',
    ],
    'mac_address' => 'De :attribute moet een geldig MAC-adres zijn.',
    'max' => [
        'array' => 'De :attribute mag niet meer dan :max items bevatten.',
        'file' => 'De :attribute mag niet groter zijn dan :max kilobytes.',
        'numeric' => 'De :attribute mag niet groter zijn dan :max.',
        'string' => 'De :attribute mag niet groter zijn dan :max tekens.',
    ],
    'max_digits' => 'De :attribute mag niet meer dan :max cijfers bevatten.',
    'mimes' => 'De :attribute moet een bestand zijn van het type: :values.',
    'mimetypes' => 'De :attribute moet een bestand zijn van het type: :values.',
    'min' => [
        'array' => 'De :attribute moet ten minste :min items bevatten.',
        'file' => 'De :attribute moet ten minste :min kilobytes zijn.',
        'numeric' => 'De :attribute moet ten minste :min zijn.',
        'string' => 'De :attribute moet ten minste :min tekens zijn.',
    ],
    'min_digits' => 'De :attribute moet ten minste :min cijfers bevatten.',
    'missing' => 'Het :attribute veld moet ontbreken.',
    'missing_if' => 'Het :attribute veld moet ontbreken wanneer :other :value is.',
    'missing_unless' => 'Het :attribute veld moet ontbreken tenzij :other :value is.',
    'missing_with' => 'Het :attribute veld moet ontbreken wanneer :values aanwezig is.',
    'missing_with_all' => 'Het :attribute veld moet ontbreken wanneer :values aanwezig zijn.',
    'multiple_of' => 'De :attribute moet een veelvoud zijn van :value.',
    'not_in' => 'De geselecteerde :attribute is ongeldig.',
    'not_regex' => 'Het :attribute formaat is ongeldig.',
    'numeric' => 'De :attribute moet een getal zijn.',
    'password' => [
        'letters' => 'De :attribute moet ten minste één letter bevatten.',
        'mixed' => 'De :attribute moet ten minste één hoofdletter en één kleine letter bevatten.',
        'numbers' => 'De :attribute moet ten minste één cijfer bevatten.',
        'symbols' => 'De :attribute moet ten minste één symbool bevatten.',
        'uncompromised' => 'De gegeven :attribute is verschenen in een datalek. Kies alstublieft een andere :attribute.',
    ],
    'present' => 'Het :attribute veld moet aanwezig zijn.',
    'prohibited' => 'Het :attribute veld is verboden.',
    'prohibited_if' => 'Het :attribute veld is verboden wanneer :other :value is.',
    'prohibited_unless' => 'Het :attribute veld is verboden tenzij :other in :values is.',
    'prohibits' => 'Het :attribute veld verbiedt :other om aanwezig te zijn.',
    'regex' => 'Het :attribute formaat is ongeldig.',
    'required' => 'Het :attribute veld is verplicht.',
    'required_array_keys' => 'Het :attribute veld moet invoer bevatten voor: :values.',
    'required_if' => 'Het :attribute veld is verplicht wanneer :other :value is.',
    'required_if_accepted' => 'Het :attribute veld is verplicht wanneer :other is geaccepteerd.',
    'required_unless' => 'Het :attribute veld is verplicht tenzij :other in :values is.',
    'required_with' => 'Het :attribute veld is verplicht wanneer :values aanwezig is.',
    'required_with_all' => 'Het :attribute veld is verplicht wanneer :values aanwezig zijn.',
    'required_without' => 'Het :attribute veld is verplicht wanneer :values niet aanwezig is.',
    'required_without_all' => 'Het :attribute veld is verplicht wanneer geen van :values aanwezig is.',
    'same' => 'De :attribute en :other moeten overeenkomen.',
    'size' => [
        'array' => 'De :attribute moet :size items bevatten.',
        'file' => 'De :attribute moet :size kilobytes zijn.',
        'numeric' => 'De :attribute moet :size zijn.',
        'string' => 'De :attribute moet :size tekens zijn.',
    ],
    'starts_with' => 'De :attribute moet beginnen met een van de volgende: :values.',
    'string' => 'De :attribute moet een tekenreeks zijn.',
    'timezone' => 'De :attribute moet een geldige tijdzone zijn.',
    'unique' => 'De :attribute is al in gebruik.',
    'uploaded' => 'Het :attribute uploaden is mislukt.',
    'uppercase' => 'De :attribute moet in hoofdletters zijn.',
    'url' => 'De :attribute moet een geldige URL zijn.',
    'ulid' => 'De :attribute moet een geldige ULID zijn.',
    'uuid' => 'De :attribute moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Aangepaste Validatie Taalregels
    |--------------------------------------------------------------------------
    |
    | Hier kunt u aangepaste validatieberichten voor attributen specificeren met de
    | conventie "attribuut.regel" om de regels snel te benoemen. Dit maakt het snel
    | specificeren van een specifieke aangepaste taalregel voor een bepaalde attribuutregel mogelijk.
    |
    */

    'custom' => [
        'attribuut-naam' => [
            'regel-naam' => 'aangepast-bericht',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Aangepaste Validatie Attributen
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels worden gebruikt om onze attribuutplaatsaanduiding
    | te vervangen door iets leesbaarders zoals "E-mailadres" in plaats van "e-mail". Dit helpt ons gewoon om onze boodschap expressiever te maken.
    |
    */

    'attributes' => [],

];
