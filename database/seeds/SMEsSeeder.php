<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class SMEsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        $est    = ['Één','Twee', 'Meer dan twee'];
        $prov   = ['Drenthe','Flevoland','Friesland','Gelderland','Groningen','Limburg','Noord-Brabant','Noord-Holland','Overijssel','Utrecht','Zeeland','Zuid-Holland'];
        $act    = ['Uitsluitend in Nederland','Voornamelijk binnen Nederland maar ook daarbuiten','Voornamelijk buiten Nederland'];
        $leg    = ['Eenmanszaak','Vennootschap onder firma (vof)','Commanditaire vennootschap (cv)','Besloten vennootschap (bv)','Naamloze vennootschap (nv)','Stichting','Vereniging'];
        $sec    = ['Landbouw en visserij','Industrie','Bouwnijverheid','Groothandel','Detailhandel','Horeca','Vervoer','Adviesdiensten','Facilitaire diensten','Persoonlijke diensten','Algemene diensten','Zakelijk beheer','Zorg','Delfstoffen','Onderwijs','IT dienstverlening','Media en communicatie','Overheid'];
        $exist  = ['0 tot 1 jaar','1 tot 3 jaar','3 tot 10 jaar','10 tot 20 jaar','Meer dan 20 jaar'];
        $size   = ['1 persoon (zzp)','2-9 personen (micro)','10-49 personen (klein)','50-249 personen (midden)'];
        $turn   = ['<  100.000 €','100.000 € - 250.000 €','250.000 € - 500.000 €','500.000 € - 1.000.000 €','1.000.000 € - 2.000.000 €','2.000.000 € - 5.000.000 €','5.000.000 € - 10.000.000 €','10.000.000 €  >'];
        $sup    = ['Bedrijven (business-to-business)','Consumenten (business-to-customer)','Overheid (business-to-administration)','Non-profit instellingen'];
        $it     = ['IT is uitbesteed','IT is in huis','Een combinatie van bovenstaande'];

        DB::table('smes')->insert([
        'user_id'       => $faker->unique()->randomNumber($nbDigits = 2), // 'user_id' =>User::all()->random()->id,
        'company_name'  => $faker->unique()->name,
        'address1'      => $faker->streetAddress,
        'address2'      => $faker->streetAddress,
        'postcode'      => $faker->postcode,
        'town'          => $faker->city,
        'country'       => $faker->country,
        'establishment' => Arr::random($est),
        'province'      =>  Arr::random($prov),
        'active'        =>  Arr::random($act),
        'legal'         =>  Arr::random($leg),
        'sector'        =>  Arr::random($sec),
        'exist'         =>  Arr::random($exist),
        'size'          =>  Arr::random($size),
        'turnover'      =>  Arr::random($turn),
        'supply'        =>  Arr::random($sup),
        'it'            =>  Arr::random($it),
        'short_description' => $faker->text
        ]);
    }
}

    
      