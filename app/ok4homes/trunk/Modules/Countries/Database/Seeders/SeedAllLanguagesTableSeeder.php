<?php

namespace Modules\Countries\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedAllLanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
  
        if(DB::table('all_languages')->get()->count() == 0)
        {
        $tasks = [
                    [
                    'name' => 'English',
                    'lang_code' => 'en',
                    ],
                    [
                    'name' => 'Afar',
                    'lang_code' => 'aa',
                    ],
                    [
                    'name' => 'Abkhazian',
                    'lang_code' => 'ab',
                    ],
                    [
                    'name' =>'Afrikaans',
                    'lang_code' => 'af',
                    ],
                    [
                    'name' => 'Amharic',
                    'lang_code' => 'am',
                    ],
                    [
                    'name' =>'Arabic',
                    'lang_code' => 'ar',
                    ],
                    [
                    'name' => 'Assamese',
                    'lang_code' => 'as',
                    ],
                    [
                    'name' => 'Aymara',
                    'lang_code' => 'ay',
                    ],
                    [
                    'name' => 'Azerbaijani',
                    'lang_code' => 'az',
                    ],
                    [
                    'name' => 'Bashkir',
                    'lang_code' => 'ba',
                    ],
                    [
                    'name' => 'Belarusian',
                    'lang_code' => 'be',
                    ],
                    [
                    'name' => 'Bulgarian',
                    'lang_code' => 'bg',
                    ],
                    [
                    'name' => 'Bihari',
                    'lang_code' => 'bh',
                    ],

                    [
                    'name' => 'Bislama', 
                    'lang_code' => 'bi',
                    ],

                    [
                    'name' => 'Bengali/Bangla', 
                    'lang_code' => 'bn',
                    ],
                    [
                    'name' => 'Tibetan',
                    'lang_code' => 'bo',
                    ],
                    [
                    'name' => 'Breton',
                    'lang_code' => 'br',
                    ],
                    [
                    'name' => 'Catalan', 
                    'lang_code' => 'ca',
                    ],
                    [
                    'name' => 'Corsican', 
                    'lang_code' => 'co',
                    ],
                    [
                    'name' => 'Czech', 
                    'lang_code' => 'cs',
                    ],
                    [
                    'name' => 'Welsh', 
                    'lang_code' => 'cy',
                    ],
                    [
                    'name' =>  'Danish', 
                    'lang_code' => 'da',
                    ],
                    [
                    'name' => 'German',
                    'lang_code' => 'de',
                    ],
                    [
                    'name' => 'Bhutani',
                    'lang_code' => 'dz',
                    ],
                    [
                    'name' => 'Greek',
                    'lang_code' => 'el',
                    ],
                    [
                    'name' => 'Esperanto', 
                    'lang_code' => 'eo',
                    ],
                    [
                    'name' => 'Spanish',
                    'lang_code' => 'es',
                    ],
                    [
                    'name' => 'Estonian', 
                    'lang_code' => 'et',
                    ],
                    [
                    'name' =>'Basque', 
                    'lang_code' => 'eu',
                    ],
                    [
                    'name' => 'Persian', 
                    'lang_code' => 'fa',
                    ],
                    [
                    'name' => 'Finnish', 
                    'lang_code' => 'fi',
                    ],
                    [
                    'name' => 'Fiji', 
                    'lang_code' => 'fj',
                    ],
                    [
                    'name' => 'Faeroese',
                    'lang_code' => 'fo',
                    ],
                    [
                    'name' => 'French', 
                    'lang_code' => 'fr',
                    ],
                    [
                    'name' => 'Frisian',
                    'lang_code' => 'fy',
                    ],
                    [
                    'name' => 'Irish' ,
                    'lang_code' => 'ga',
                    ],
                    [
                    'name' => 'Scots/Gaelic', 
                    'lang_code' => 'gd',
                    ],
                    [
                    'name' => 'Galician',
                    'lang_code' => 'gl',
                    ],
                    [
                    'name' => 'Guarani', 
                    'lang_code' => 'gn',
                    ],
                    [
                    'name' => 'Gujarati', 
                    'lang_code' => 'gu',
                    ],
                    [
                    'name' => 'Hausa',
                    'lang_code' => 'ha',
                    ],
                    [
                    'name' => 'Hindi', 
                    'lang_code' => 'hi',
                    ],
                    [
                    'name' => 'Croatian' ,
                    'lang_code' => 'hr',
                    ],
                    [
                    'name' => 'Hungarian', 
                    'lang_code' => 'hu',
                    ],
                    [
                    'name' => 'Armenian',
                    'lang_code' => 'hy',
                    ],
                    [
                    'name' => 'Interlingua', 
                    'lang_code' => 'ia',
                    ],
                    [
                    'name' => 'Interlingue', 
                    'lang_code' => 'ie',
                    ],
                    [
                    'name' => 'Inupiak',  
                    'lang_code' => 'ik',
                    ],
                    [
                    'name' => 'Indonesian',
                    'lang_code' => 'in',
                    ],
                    [
                    'name' => 'Icelandic',
                    'lang_code' => 'is',
                    ],
                    [
                    'name' => 'Italian', 
                    'lang_code' => 'it',
                    ],
                    [
                    'name' => 'Hebrew',
                    'lang_code' => 'iw',
                    ],
                    [
                    'name' =>  'Japanese',
                    'lang_code' => 'ja',
                    ],
                    [
                    'name' => 'Yiddish',
                    'lang_code' => 'ji',
                    ],
                    [
                    'name' => 'Javanese', 
                    'lang_code' => 'jw',
                    ],
                    [
                    'name' => 'Georgian', 
                    'lang_code' => 'ka',
                    ],
                    [
                    'name' => 'Kazakh',
                    'lang_code' => 'kk',
                    ],
                    [
                    'name' => 'Greenlandic',
                    'lang_code' => 'kl',
                    ],
                    [
                    'name' => 'Cambodian' ,
                    'lang_code' => 'km',
                    ],
                    [
                    'name' => 'Kannada', 
                    'lang_code' => 'kn',
                    ],
                    [
                    'name' => 'Korean', 
                    'lang_code' => 'ko',
                    ],
                    [
                    'name' => 'Kashmiri',
                    'lang_code' => 'ks',
                    ],
                    [
                    'name' => 'Kurdish' ,
                    'lang_code' => 'ku',
                    ],
                    [
                    'name' => 'Kirghiz',
                    'lang_code' => 'ky',
                    ],
                    [
                    'name' => 'Latin', 
                    'lang_code' => 'la',
                    ],
                    [
                    'name' => 'Lingala',
                    'lang_code' => 'ln',
                    ],
                    [
                    'name' => 'Laothian',
                    'lang_code' => 'lo',
                    ],
                    [
                    'name' => 'Lithuanian', 
                    'lang_code' => 'lt',
                    ],
                    [
                    'name' =>  'Latvian/Lettish',
                    'lang_code' => 'lv',
                    ],
                    [
                    'name' => 'Malagasy', 
                    'lang_code' => 'mg',
                    ],
                    [
                    'name' => 'Maori', 
                    'lang_code' => 'mi',
                    ],
                    [
                    'name' => 'Macedonian', 
                    'lang_code' => 'mk',
                    ],
                    [
                    'name' => 'Malayalam', 
                    'lang_code' => 'ml',
                    ],
                    [
                    'name' => 'Mongolian', 
                    'lang_code' => 'mn',
                    ],
                    [
                    'name' => 'Moldavian', 
                    'lang_code' => 'mo',
                    ],
                    [
                    'name' => 'Marathi', 
                    'lang_code' => 'mr',
                    ],
                    [
                    'name' => 'Malay', 
                    'lang_code' => 'ms',
                    ],
                    [
                    'name' => 'Maltese', 
                    'lang_code' => 'mt',
                    ],
                    [
                    'name' => 'Burmese', 
                    'lang_code' => 'my',
                    ],
                    [
                    'name' => 'Nauru', 
                    'lang_code' => 'na',
                    ],
                    [
                    'name' => 'Nepali', 
                    'lang_code' => 'ne',
                    ],
                    [
                    'name' => 'Dutch', 
                    'lang_code' => 'nl',
                    ],
                    [
                    'name' => 'Norwegian', 
                    'lang_code' => 'no',
                    ],
                    [
                    'name' => 'Occitan', 
                    'lang_code' => 'oc',
                    ],
                    [
                    'name' => '(Afan)/Oromoor/Oriya', 
                    'lang_code' => 'om',
                    ],
                    [
                    'name' => 'Punjabi', 
                    'lang_code' => 'pa',
                    ],

                    [
                    'name' => 'Polish', 
                    'lang_code' => 'pl',
                    ],
                    [
                    'name' => 'Pashto/Pushto', 
                    'lang_code' => 'ps',
                    ],
                    [
                    'name' => 'Portuguese', 
                    'lang_code' => 'pt',
                    ],
                    [
                    'name' => 'Quechua', 
                    'lang_code' => 'qu',
                    ],
                    [
                    'name' => 'Rhaeto-Romance', 
                    'lang_code' => 'rm',
                    ],
                    [
                    'name' => 'Kirundi', 
                    'lang_code' => 'rn',
                    ],
                    [
                    'name' => 'Romanian', 
                    'lang_code' => 'ro',
                    ],
                    [
                    'name' => 'Russian', 
                    'lang_code' => 'ru',
                    ],
                    [
                    'name' => 'Kinyarwanda', 
                    'lang_code' => 'rw',
                    ],
                    [
                    'name' => 'Sanskrit', 
                    'lang_code' => 'sa',
                    ],
                    [
                    'name' => 'Sindhi', 
                    'lang_code' => 'sd',
                    ],
                    [
                    'name' => 'Sangro', 
                    'lang_code' => 'sg',
                    ],
                    [
                    'name' => 'Serbo-Croatian', 
                    'lang_code' => 'sh',
                    ],
                    [
                    'name' => 'Singhalese', 
                    'lang_code' => 'si',
                    ],
                    [
                    'name' => 'Slovak', 
                    'lang_code' => 'sk',
                    ],
                    [
                    'name' => 'Slovenian', 
                    'lang_code' => 'sl',
                    ],
                    [
                    'name' => 'Samoan', 
                    'lang_code' => 'sm',
                    ],
                    [
                    'name' => 'Shona', 
                    'lang_code' => 'sn',
                    ],
                    [
                    'name' => 'Somali', 
                    'lang_code' => 'so',
                    ], 
                    [
                    'name' => 'Albanian', 
                    'lang_code' => 'sq',
                    ],
                    [
                    'name' => 'Serbian', 
                    'lang_code' => 'sr',
                    ], 
                    [
                    'name' => 'Siswati', 
                    'lang_code' => 'ss',
                    ], 
                    [
                    'name' => 'Sesotho', 
                    'lang_code' => 'st',
                    ], 
                    [
                    'name' => 'Sundanese', 
                    'lang_code' => 'su',
                    ], 
                    [
                    'name' => 'Swedish', 
                    'lang_code' => 'sv',
                    ], 
                    [
                    'name' => 'Swahili', 
                    'lang_code' => 'sw',
                    ], 
                    [
                    'name' => 'Tamil', 
                    'lang_code' => 'ta',
                    ], 
                    [
                    'name' => 'Telugu', 
                    'lang_code' => 'te',
                    ], 
                    [
                    'name' => 'Tajik', 
                    'lang_code' => 'tg',
                    ], 
                    [
                    'name' => 'Thai', 
                    'lang_code' => 'th',
                    ], 
                    [
                    'name' => 'Tigrinya', 
                    'lang_code' => 'ti',
                    ], 
                    [
                    'name' => 'Turkmen', 
                    'lang_code' => 'tk',
                    ], 
                    [
                    'name' => 'Tagalog', 
                    'lang_code' => 'tl',
                    ], 
                    [
                    'name' => 'Setswana', 
                    'lang_code' => 'tn',
                    ], 
                    [
                    'name' => 'Tonga', 
                    'lang_code' => 'to',
                    ], 
                    [
                    'name' => 'Turkish', 
                    'lang_code' => 'tr',
                    ], 
                    [
                    'name' => 'Tsonga', 
                    'lang_code' => 'ts',
                    ], 
                    [
                    'name' => 'Tatar', 
                    'lang_code' => 'tt',
                    ], 
                    [
                    'name' => 'Twi', 
                    'lang_code' => 'tw',
                    ], 
                    [
                    'name' => 'Ukrainian', 
                    'lang_code' => 'uk',
                    ], 
                    [
                    'name' => 'Urdu', 
                    'lang_code' => 'ur',
                    ], 
                    [
                    'name' => 'Uzbek', 
                    'lang_code' => 'uz',
                    ], 
                    [
                    'name' => 'Vietnamese', 
                    'lang_code' => 'vi',
                    ], 
                    [
                    'name' => 'Volapuk', 
                    'lang_code' => 'vo',
                    ], 
                    [
                    'name' => 'Wolof', 
                    'lang_code' => 'wo',
                    ], 

                    [
                    'name' => 'Xhosa', 
                    'lang_code' => 'xh',
                    ], 
                    [
                    'name' => 'Yoruba', 
                    'lang_code' => 'yo',
                    ], 
                    [
                    'name' => 'Chinese', 
                    'lang_code' => 'zh',
                    ], 
                    [
                    'name' => 'Zulu', 
                    'lang_code' => 'zu',
                    ]
                ];
         DB::table('all_languages')->insert($tasks);
        }

         
    }
}
