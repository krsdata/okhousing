<?php

namespace Modules\Countries\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedAllCountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); 
       if(DB::table('all_countries')->get()->count() == 0)
        {
            $tasks =[
                [
                'name' => 'Afghanistan',
                'flag' => 'af',
                'code' => 'afg',
                'callingCodes' => 93,
                'currency' =>'Afghanis',
                'currency_code' =>'AF',
                'symbol' => '؋',
                ],
                [
                'name' => 'Albania',
                'flag' => 'al',
                'code' => 'alb',
                'callingCodes' => 355,
                'currency' =>'Leke',
                'currency_code' =>'ALL',
                'symbol' => 'Lek',
                ],

                [
                'name' => 'Argentina',
                'flag' => 'ar',
                'code' => 'arg',
                'callingCodes' => 54,
                'currency' =>'Pesos',
                'currency_code' =>'ARS',
                'symbol' =>'$' ,
                ],

                [
                'name' => 'Aruba',
                'flag' => 'aw' ,
                'code' =>'abw' ,
                 'callingCodes' => 297,   
                'currency' =>'Guilders',
                'currency_code' =>'AWG',
                'symbol' =>  'ƒ',
                ],

                [
                'name' => 'Australia',
                'flag' => 'au' ,
                'code' => 'aus',
                'callingCodes' => 61,
                'currency' => 'Dollars',
                'currency_code' =>'AUD',
                'symbol' => '$' ,
                ],

                [
                'name' => 'Azerbaijan',
                'flag' => 'az',
                'code' =>  'aze', 
                'callingCodes' => 994,
                'currency' => 'New Manats',
                'currency_code' => 'AZ',
                'symbol' => 'ман',
                ],

                [
                'name' => 'Bahamas',
                'flag' => 'bs', 
                'code' => 'bhs',
                'callingCodes' => 1242,
                'currency' => 'Dollars',
                'currency_code' => 'BSD',
                'symbol' =>  '$',
                ],
                [
                'name' =>'Barbados',
                'flag' => 'bb',
                'code' => 'brb',
                'callingCodes' => 1246,
                'currency' =>  'Dollars',
                'currency_code' => 'BBD',
                'symbol' =>  '$',
                ],

                [
                'name' =>'Belarus',
                'flag' =>'by', 
                'code' =>  'blr',
                'callingCodes' => 375,
                'currency' => 'Rubles',
                'currency_code' =>  'BYR',
                'symbol' =>  'p.',
                ],

                [
                'name' =>'Belgium',
                'flag' =>'be', 
                'code' =>  'bel',
                'callingCodes' => 32,
				'currency' =>  'Euro',
                'currency_code' =>  'EUR',
                'symbol' =>  '€',
                ],

                [
                'name' =>'Bermuda',
                'flag' =>'bm', 
                'code' => 'bmu',
                'callingCodes' => 1441,
				'currency' => 'Dollars',
                'currency_code' => 'BMD',
                'symbol' => '$',
                ],

                [
                'name' =>'Bosnia and Herzegovina',
                'flag' =>'ba', 
                'code' => 'bih',
                'callingCodes' => 387,
				'currency' => 'Convertible Marka',
                'currency_code' => 'BAM',
                'symbol' => 'KM',
                ],

                [
                'name' =>'Botswana',
                'flag' =>'bw', 
                'code' => 'bwa',
               'callingCodes' => 267,
			   'currency' => 'Pula\'s',
                'currency_code' => 'BWP',
                'symbol' => 'P',
                ],

                [
                'name' =>'Brazil',
                'flag' =>'br', 
                'code' => 'bra',
                'callingCodes' => 55,
				'currency' =>'Reais',
                'currency_code' => 'BRL',
                'symbol' => 'R$',
                ],

                [
                'name' =>'Brunei Darussalam',
                'flag' =>'bn', 
                'code' => 'brn',
                'callingCodes' => 673,
				'currency' =>'Dollars', 
                'currency_code' => 'BND',
                'symbol' => '$',
                ],

                [
                'name' =>'Bulgaria',
                'flag' =>'bg', 
                'code' => 'bgr',
                'callingCodes' => 359,
				'currency' =>'Leva', 
                'currency_code' => 'BG',
                'symbol' =>'лв',
                ],

                [
                'name' =>'Cambodia',
                'flag' =>'kh', 
                'code' => 'khm',
                'callingCodes' => 855,
				'currency' =>'Riels', 
                'currency_code' =>'KHR',
                'symbol' =>'៛',
                ],

                [
                'name' =>'Canada',
                'flag' =>'ca', 
                'code' => 'can',
                'callingCodes' => 1,
				'currency' =>'Dollars', 
                'currency_code' =>'CAD',
                'symbol' =>'$',
                ],

                [
                'name' =>'Cayman Islands',
                'flag' =>'ky', 
                'code' => 'cym',
                'callingCodes' => 1345,'currency' =>'Dollars', 
                'currency_code' => 'KYD',
                'symbol' =>'$',
                ],

                [
                'name' =>'Chile',
                'flag' =>'cl', 
                'code' => 'chl',
                'callingCodes' => 56,'currency' =>'Pesos',  
                'currency_code' => 'CLP',
                'symbol' =>'$',
                ],

                [
                'name' =>'China',
                'flag' =>'cn', 
                'code' => 'chn',
                'callingCodes' => 86,'currency' =>'Yuan Renminbi', 
                'currency_code' => 'CNY',
                'symbol' =>'¥',
                ],

                [
                'name' =>'Colombia',
                'flag' =>'co', 
                'code' => 'col',
                'callingCodes' => 57,'currency' =>'Pesos', 
                'currency_code' => 'COP',
                'symbol' =>'$',
                ],

                [
                'name' => 'Costa Rica',
                'flag' =>'cr', 
                'code' => 'cri',
                'callingCodes' => 506,'currency' =>'Colón', 
                'currency_code' => 'CRC',
                'symbol' => '₡',
                ],

                [
                'name' =>'Croatia',
                'flag' =>'hr', 
                'code' => 'hrv',
                'callingCodes' => 385,'currency' =>'Kuna', 
                'currency_code' => 'HRK',
                'symbol' =>'kn',
                ],

                [
                'name' =>'Cuba',
                'flag' =>'cu', 
                'code' => 'cub',
                'callingCodes' => 53,'currency' =>'Pesos', 
                'currency_code' => 'CUP',
                'symbol' =>'₱',
                ],

                [
                'name' =>'Cyprus',
                'flag' =>'cy', 
                'code' => 'cyp',
                'callingCodes' => 357,'currency' =>'Euro', 
                'currency_code' => 'EUR',
                'symbol' =>'€',
                ],

                [
                'name' =>'Denmark',
                'flag' =>'dk', 
                'code' => 'dnk',
                'callingCodes' => 45,'currency' =>'Kroner',  
                'currency_code' => 'DKK',
                'symbol' =>'kr',
                ],

                [
                'name' =>'Dominican Republic',
                'flag' =>'do', 
                'code' => 'dom',
               'callingCodes' => 1809, 'currency' =>'Pesos',  
                'currency_code' => 'DOP',
                'symbol' =>'RD$',
                ],

                [
                'name' =>'Egypt',
                'flag' =>'eg', 
                'code' => 'egy',
                'callingCodes' => 20,'currency' =>'Pounds',   
                'currency_code' => 'EGP',
                'symbol' =>'£',
                ],

                [
                'name' =>'El Salvador',
                'flag' =>'sv', 
                'code' => 'slv',
                'callingCodes' => 503,'currency' =>'Colones',   
                'currency_code' => 'SVC',
                'symbol' =>'$',
                ],

                [
                'name' =>'Fiji', 
                'flag' =>'fj', 
                'code' => 'fji',
                'callingCodes' => 679,'currency' =>'Dollars',   
                'currency_code' => 'FJD',
                'symbol' =>'$',
                ],

                [
                'name' =>'France', 
                'flag' =>'fr', 
                'code' => 'fra',
                'callingCodes' => 33,'currency' =>'Euro',   
                'currency_code' =>  'EUR',
                'symbol' =>'€'
                ],

                [
                'name' =>'Ghana', 
                'flag' =>'gh', 
                'code' => 'gha',
                'callingCodes' => 233,'currency' =>'Cedis',   
                'currency_code' =>  'GHC',
                'symbol' =>'¢',
                ],

                [
                'name' =>'Gibraltar',  
                'flag' =>'gi', 
                'code' => 'gib',
                'callingCodes' => 350,'currency' =>'Pounds',   
                'currency_code' =>  'GIP',
                'symbol' =>'£',
                ],
                [
                'name' =>'Greece', 
                'flag' =>'gr', 
                'code' => 'grc',
                'callingCodes' => 30,'currency' =>'Euro',    
                'currency_code' => 'EUR',
                'symbol' =>'€',
                ],

                [
                'name' =>'Guatemala',
                'flag' =>'gt', 
                'code' => 'gtm',
                'callingCodes' => 502,'currency' =>'Quetzales',     
                'currency_code' => 'GTQ',
                'symbol' =>'Q',
                ],

                [
                'name' =>'Guernsey',
                'flag' =>'gg', 
                'code' => 'ggy',
                'callingCodes' => null,'currency' =>'Pounds',     
                'currency_code' => 'GGP',
                'symbol' =>'£',
                ],

                [
                'name' =>'Guyana',
                'flag' =>'gy', 
                'code' => 'guy',
                'callingCodes' => 592,'currency' => 'Dollars',    
                'currency_code' => 'GYD',
                'symbol' =>'$',
                ],

                [
                'name' =>'Honduras',
                'flag' =>'hn', 
                'code' => 'hnd',
                'callingCodes' => 504,'currency' => 'Lempiras',    
                'currency_code' => 'HNL',
                'symbol' =>'L',
                ],

                [
                'name' => 'Hong Kong',
                'flag' =>'hk', 
                'code' => 'hkg',
                'callingCodes' => 852,'currency' => 'Dollars',   
                'currency_code' => 'HKD',
                'symbol' => '$',
                ],

                [
                'name' => 'Hungary', 
                'flag' =>'hu', 
                'code' => 'hun',
                'callingCodes' => 36,'currency' => 'Forint',   
                'currency_code' => 'HUF',
                'symbol' => 'Ft',
                ],

                [
                'name' => 'Iceland', 
                'flag' =>'is', 
                'code' => 'isl',
                'callingCodes' => 354,'currency' => 'Kronur',   
                'currency_code' => 'ISK',
                'symbol' => 'kr',
                ],

                [
                'name' => 'India', 
                'flag' =>'in', 
                'code' => 'ind',
                'callingCodes' => '+91', 
                'currency' =>  'Rupees',   
                'currency_code' => 'INR',
                'symbol' => '₹',
                ],

                [
                'name' => 'Indonesia', 
                'flag' =>'id', 
                'code' => 'idn',
                'callingCodes' => 62,'currency' =>'Rupiahs',   
                'currency_code' => 'IDR',
                'symbol' => 'Rp',
                ],

                [
                'name' =>'Ireland', 
                'flag' =>'ie', 
                'code' => 'irl',
                'callingCodes' => 353,'currency' =>'Euro',   
                'currency_code' => 'EUR',
                'symbol' =>'€',
                ],

                [
                'name' =>'Isle of Man', 
                'flag' =>'im', 
                'code' => 'imn',
                'callingCodes' => 44,'currency' =>'Pounds',   
                'currency_code' => 'IMP',
                'symbol' => '£',
                ],

                [
                'name' =>'Israel', 
                'flag' =>'il', 
                'code' => 'isr', 
                'callingCodes' => 972,'currency' => 'New Shekels',   
                'currency_code' =>  'ILS',
                'symbol' => '₪',
                ],        

                [
                'name' => 'Italy', 
                'flag' =>'it', 
                'code' => 'ita', 
               'callingCodes' => 39, 'currency' =>'Euro',   
                'currency_code' =>'EUR',
                'symbol' => '€',
                ],        

                [
                'name' => 'Jamaica', 
                'flag' =>'jm', 
                'code' => 'jam', 
                'callingCodes' => 1876,'currency' =>'Dollars',  
                'currency_code' =>'JMD', 
                'symbol' => 'J$',
                ],        

                [
                'name' => 'Japan',
                'flag' =>'jp', 
                'code' => 'jpn', 
                'callingCodes' => 81,'currency' =>'Yen',  
                'currency_code' =>'JPY', 
                'symbol' => '¥',
                ],       

                [
                'name' => 'Jersey', 
                'flag' =>'je', 
                'code' => 'jey', 
                'callingCodes' => null,'currency' => 'Pounds',  
                'currency_code' =>'JEP',
                'symbol' => '£',
                ],       
                [
                'name' => 'Kazakhstan',
                'flag' =>'kz', 
                'code' => 'kaz', 
                'callingCodes' => 7,'currency' =>'Tenge',   
                'currency_code' =>'KZT',
                'symbol' => 'лв',
                ],       

                [
                'name' => 'Kyrgyzstan',
                'flag' =>'kg', 
                'code' => 'kgz', 
                'callingCodes' => 996,'currency' =>'Soms',   
                'currency_code' =>'KGS',
                'symbol' => 'лв',
                ],

                [
                'name' =>'Latvia',
                'flag' =>'lv', 
                'code' => 'lva', 
                'callingCodes' => 371,'currency' => 'Lati',   
                'currency_code' =>'LVL',
                'symbol' =>'Ls',
                ], 

                [
                'name' =>'Lebanon',
                'flag' =>'lb', 
                'code' => 'lbn', 
                'callingCodes' => 961,'currency' => 'Pounds',   
                'currency_code' =>'LBP',
                'symbol' => '£',
                ],       

               /* [
                'name' =>'Lebanon',
                'flag' =>'lb', 
                'code' => 'lbn', 
                'callingCodes' => null,'currency' => 'Pounds',   
                'currency_code' =>'LBP',
                'symbol' => '£',
                ], */      

                [
                'name' => 'Liberia', 
                'flag' =>'lr', 
                'code' => 'lbr', 
                'callingCodes' => 231,'currency' => 'Dollars',  
                'currency_code' =>'LRD',
                'symbol' => '$',
                ],       

                [
                'name' =>  'Liechtenstein',
                'flag' =>'li', 
                'code' => 'lie', 
                'callingCodes' => 423,'currency' => 'Switzerland Francs',  
                'currency_code' =>'CHF',
                'symbol' => 'CHF',
                ],       

                [
                'name' =>  'Lithuania',
                'flag' =>'lt', 
                'code' => 'ltu', 
                'callingCodes' => 370,'currency' =>'Litai',  
                'currency_code' =>'LTL',
                'symbol' => 'Lt',
                ], 

                [
                'name' =>'Luxembourg',
                'flag' =>'lu',
                'code' => 'lux', 
                'callingCodes' => 352,'currency' =>'Euro',  
                'currency_code' =>'EUR',
                'symbol' => '€',
                ],  

                [
                'name' => 'Malaysia',
                'flag' =>'my',
                'code' => 'mys', 
                'callingCodes' => 60,'currency' =>'Ringgits',  
                'currency_code' =>'MYR',
                'symbol' => 'RM',
                ],

                [
                'name' =>'Malta',
                'flag' =>'mt',
                'code' => 'mlt', 
                'callingCodes' => 356,'currency' => 'Euro',  
                'currency_code' =>'EUR',
                'symbol' => '€',
                ],  
                [
                'name' => 'Mauritius',
                'flag' =>'mu',
                'code' => 'mus', 
                'callingCodes' => 230,'currency' => 'Rupees', 
                'currency_code' =>'MUR',
                'symbol' => '₨',
                ],

                [
                'name' =>  'Mexico',
                'flag' =>'mx',
                'code' => 'mex', 
                'callingCodes' => 52,'currency' => 'Pesos', 
                'currency_code' =>'MX',
                'symbol' => '$',
                ], 

                [
                'name' => ' Mongolia',
                'flag' =>'mn',
                'code' => 'mng', 
                'callingCodes' => 976,'currency' =>  'Tugriks', 
                'currency_code' =>'MNT',
                'symbol' => '₮',
                ],

                [
                'name' =>  'Mozambique',
                'flag' =>'mz',
                'code' => 'moz', 
                'callingCodes' => 258,'currency' => 'Meticais', 
                'currency_code' =>'MZ',
                'symbol' =>'MT',
                ], 
               /* [
                'name' =>  'Mozambique',
                'flag' =>'mz',
                'code' => 'moz', 
                'callingCodes' => null,'currency' => 'Meticais', 
                'currency_code' =>'MZ',
                'symbol' =>'MT',
                ], */
                [
                'name' =>'Namibia',
                'flag' =>'na',
                'code' => 'nam', 
                'callingCodes' => 264,'currency' =>  'Dollars', 
                'currency_code' =>'NAD',
                'symbol' =>'$',
                ], 

                [
                'name' =>'Nepal',
                'flag' =>'np',
                'code' => 'npl', 
                'callingCodes' => 977,'currency' => 'Rupees', 
                'currency_code' =>'NPR',
                'symbol' => '₨',
                ], 

                [
                'name' => 'Netherlands',
                'flag' =>'nl',
                'code' => 'nld', 
                'callingCodes' => 31,'currency' => 'Euro',
                'currency_code' => 'EUR',
                'symbol' =>  '€',
                ], 

                [
                'name' => 'New Zealand',
                'flag' => 'nz',
                'code' => 'nzl', 
                'callingCodes' => 64,'currency' => 'Dollars', 
                'currency_code' =>  'NZD',
                'symbol' =>  '$',
                ], 
                [
                'name' =>'Nicaragua',
                'flag' => 'ni',
                'code' => 'nic', 
                'callingCodes' => 505,'currency' =>'Cordobas',
                'currency_code' =>  'NIO',
                'symbol' =>   'C$',
                ], 

                [
                'name' =>'Nigeria',
                'flag' => 'ng',
                'code' => 'nga', 
                'callingCodes' => 234,'currency' =>'Nairas',
                'currency_code' =>  'NG',
                'symbol' => '₦',
                ], 

                [
                'name' =>'Norway',
                'flag' => 'no',
                'code' => 'nor', 
                'callingCodes' => 47,'currency' =>'Krone',
                'currency_code' =>  'NOK', 
                'symbol' => 'kr',
                ], 

                [
                'name' =>'Oman',
                'flag' =>  'om',
                'code' =>  'omn', 
                'callingCodes' => 968,'currency' =>'Rials',
                'currency_code' =>  'OMR',
                'symbol' => '﷼',
                ], 

                [
                'name' => 'Pakistan',
                'flag' => 'pk',
                'code' =>  'pak', 
                'callingCodes' => 92,'currency' =>'Rupees', 
                'currency_code' =>  'PKR',
                'symbol' => '₨',
                ], 

                [
                'name' =>'Panama',
                'flag' =>'pa',
                'code' => 'pan',
                'callingCodes' => 507,'currency' =>'Balboa', 
                'currency_code' =>   'PAB',
                'symbol' => 'B/.',
                ], 
                [
                'name' => 'Paraguay',
                'flag' =>  'py',
                'code' => 'pry',
                'callingCodes' => 595,'currency' =>'Guarani', 
                'currency_code' =>  'PYG', 
                'symbol' => 'Gs',
                ], 
                [
                'name' => 'Peru', 
                'flag' => 'pe',
                'code' =>'per',
                'callingCodes' => 51,'currency' =>'Nuevos Soles', 
                'currency_code' => 'PE', 
                'symbol' => 'S/.',
                ], 
                [
                'name' => 'Philippines',
                'flag' =>  'ph', 
                'code' =>  'phl', 
                'callingCodes' => 63,'currency' =>'Pesos',
                'currency_code' =>'PHP',
                'symbol' => 'Php',
                ], 
                [
                'name' => 'Poland',
                'flag' => 'pl',
                'code' => 'pol', 
                'callingCodes' => 48,'currency' => 'Zlotych', 
                'currency_code' =>'PL',
                'symbol' => 'zł',
                ], 
                [
                'name' =>'Qatar', 
                'flag' => 'qa',
                'code' => 'qat',  
                'callingCodes' => 974,'currency' =>  'Rials',  
                'currency_code' =>'QAR',
                'symbol' => '﷼',
                ], 
                [
                'name' =>'Romania',
                'flag' => 'ro',
                'code' => 'rou',   
                'callingCodes' => 40,'currency' => 'New Lei',   
                'currency_code' =>'RO',
                'symbol' => 'lei',
                ], 
                [
                'name' =>'Saudi Arabia', 
                'flag' =>  'sa',
                'code' =>'sau',   
               'callingCodes' => 966, 'currency' => 'Riyals',   
                'currency_code' =>'SAR',
                'symbol' =>'﷼',
                ],
                [
                'name' =>'Serbia', 
                'flag' => 'rs',
                'code' =>'srb',   
                'callingCodes' => 381,'currency' => 'Dinars', 
                'currency_code' =>'RSD',
                'symbol' => 'Дин.',
                ],
                [
                'name' => 'Seychelles', 
                'flag' => 'sc', 
                'code' =>'syc',  
                'callingCodes' => 248,'currency' => 'Rupees',   
                'currency_code' =>'SCR',
                'symbol' => '₨',
                ],
                [
                'name' =>  'Singapore', 
                'flag' =>  'sg', 
                'code' =>'sgp',   
               'callingCodes' => 65, 'currency' => 'Dollars',    
                'currency_code' =>'SGD',
                'symbol' =>  '$',
                ],
                [
                'name' =>  'Slovenia', 
                'flag' => 'si', 
                'code' => 'svn',    
                'callingCodes' => 386,'currency' => 'Euro',   
                'currency_code' =>'EUR',
                'symbol' =>'€',
                ],
                [
                'name' =>  'Solomon Islands',  
                'flag' => 'sb',
                'code' => 'slb',    
                'callingCodes' => 677,'currency' =>'Dollars',   
                'currency_code' =>'SBD', 
                'symbol' =>'$',
                ],
                [
                'name' =>  'Somalia',
                'flag' =>  'so',
                'code' => 'som' ,
                'callingCodes' => 252,'currency' =>'Shillings',  
                'currency_code' => 'SOS',
                'symbol' =>'S',
                ],
                [
                'name' =>  'South Africa',
                'flag' =>  'za',
                'code' =>'zaf',  
                'callingCodes' => 27,'currency' => 'Rand', 
                'currency_code' =>  'ZAR',
                'symbol' => 'R',
                ],
                [
                'name' => 'Spain',
                'flag' =>  'es',
                'code' => 'esp',  
                'callingCodes' => 34,'currency' => 'Euro',
                'currency_code' =>  'EUR',
                'symbol' => '€',
                ],
                [
                'name' =>  'Sri Lanka',
                'flag' => 'lk',
                'code' =>'lka',  
                'callingCodes' => 94,'currency' =>  'Rupees',
                'currency_code' => 'LKR',
                'symbol' => '₨',
                ],
                [
                'name' =>   'Suriname',
                'flag' => 'sr', 
                'code' =>'sur',  
                'callingCodes' => 597,'currency' =>'Dollars',
                'currency_code' =>  'SRD', 
                'symbol' =>'$',
                ],
                [
                'name' =>   'Sweden',
                'flag' =>  'se', 
                'code' =>'swe', 
                'callingCodes' => 46,'currency' =>'Kronor', 
                'currency_code' =>  'SEK',
                'symbol' =>'kr',
                ],
                [
                'name' =>  'Switzerland',
                'flag' =>  'ch', 
                'code' =>'che', 
                'callingCodes' => 41,'currency' =>'Francs',
                'currency_code' =>  'CHF',
                'symbol' => 'CHF',
                ],
                [
                'name' =>   'Thailand', 
                'flag' =>   'th',  
                'code' => 'tha', 
                'callingCodes' => '66',
                'currency' =>'Baht',
                'currency_code' =>  'THB',
                'symbol' => '฿',
                ],
                [
                'name' =>   'Trinidad and Tobago',
                'flag' =>  'tt', 
                'code' =>'tto',
                'callingCodes' => 1868,'currency' =>'Dollars', 
                'currency_code' =>  'TTD',
                'symbol' =>'TT$',
                ],
                [
                'name' => 'Turkey', 
                'flag' => 'tr',
                'code' =>'tur',
               'callingCodes' => 90, 'currency' =>'Lira',
                'currency_code' =>  'TRY',
                'symbol' =>'TL',
                ],
               /* [
                'name' => 'Turkey', 
                'flag' => 'tr',
                'code' =>'tur',
                'callingCodes' => null,'currency' =>'Liras',
                'currency_code' =>  'TRY',
                'symbol' => '£',
                ],*/
                [
                'name' => 'Tuvalu', 
                'flag' => 'tv',
                'code' =>'tuv',
                'callingCodes' => 688,'currency' =>'Dollars',
                'currency_code' => 'TVD',
                'symbol' =>  '$',
                ],
                [
                'name' => 'Ukraine',  
                'flag' =>  'ua',
                'code' =>'ukr',
                'callingCodes' => 380,'currency' =>'Hryvnia',
                'currency_code' =>  'UAH',
                'symbol' =>  '₴',
                ],
                [
                'name' => 'United States of America',  
                'flag' =>  'us',
                'code' => 'usa',
                'callingCodes' => 1,'currency' =>'Dollars',
                'currency_code' =>  'USD',
                'symbol' =>   '$',
                ],
                [
                'name' => 'Uruguay',  
                'flag' =>  'uy',
                'code' => 'ury',
                'callingCodes' => 598,'currency' => 'Pesos',
                'currency_code' =>  'UYU',
                'symbol' =>   '$U',
                ],
                [
                'name' =>'Uzbekistan', 
                'flag' =>   'uz',
                'code' => 'uzb',
                'callingCodes' => 998,'currency' =>'Sums',
                'currency_code' =>  'UZS',
                'symbol' =>  'лв',
                ],
                [
                'name' =>'Yemen',
                'flag' =>   'ye',
                'code' => 'yem',
                'callingCodes' => 967,'currency' => 'Rials',
                'currency_code' =>'YER',
                'symbol' => '﷼',
                ],
                [
                'name' =>'Zimbabwe', 
                'flag' =>  'zw',
                'code' =>  'zwe',
                'callingCodes' => 263,'currency' => 'Zimbabwe Dollars',
                'currency_code' =>'ZWD',
                'symbol' => 'Z$',
                ]
            ];
            DB::table('all_countries')->insert($tasks);
        }
    }
}
