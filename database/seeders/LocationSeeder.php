<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            'KAR' => 'Karnali (6)',
            'SUD' => 'Sudurpashchim (7)',
        ];

        $districts = [
            'KAR' => [
                'SUR' => 'Surkhet',
                'DAI' => 'Dailekh',
                'JUM' => 'Jumla',
                'DOL' => 'Dolpa',
                'HUM' => 'Humla',
                'SAL' => 'Salyan',
                'JAJ' => 'Jajarkot',
                'RUK_W' => 'Rukum West',
                'KAL' => 'Kalikot',
                'MUG' => 'Mugu',
            ],
            'SUD' => [
                'BHA' => 'Bajhang',
                'KAI' => 'Kailali',
                'KAN' => 'Kanchanpur',
                'DOT' => 'Doti',
                'DDL' => 'Dadeldhura',
                'BAI' => 'Baitadi',
                'BAJ' => 'Bajura',
                'DAR' => 'Darchula',
                'AAC' => 'Achham',
            ],
        ];

        $municipalities = [
            'SUR' => ['Birendranagar' => 'Birendranagar Municipality', 'Gurbhakot' => 'Gurbhakot Municipality', 'Bheriganga' => 'Bheriganga Municipality'],
            'DAI' => ['ChamundaBindrasaini' => 'Chamunda Bindrasaini Municipality', 'Dullu' => 'Dullu Municipality', 'Narayan' => 'Narayan Municipality'],
            'JUM' => ['Chandannath' => 'Chandannath Municipality', 'Guthichaur' => 'Guthichaur Rural Municipality', 'Hima' => 'Hima Rural Municipality'],
            'DOL' => ['ThuliBheri' => 'Thuli Bheri Municipality', 'Dolpa' => 'Dolpa Rural Municipality'],
            'HUM' => ['Simkot' => 'Simkot Municipality', 'Namkha' => 'Namkha Rural Municipality'],
            'SAL' => ['Salyan' => 'Salyan Municipality', 'Bagchaur' => 'Bagchaur Rural Municipality'],
            'JAJ' => ['Chhedagad' => 'Chhedagad Municipality', 'Kandel' => 'Kandel Rural Municipality'],
            'RUK_W' => ['Music' => 'Musikot Municipality', 'Rukum' => 'Rukum Rural Municipality'],
            'KAL' => ['Kalikot' => 'Kalikot Municipality', 'Palata' => 'Palata Rural Municipality'],
            'MUG' => ['Mugu' => 'Mugu Municipality', 'Soru' => 'Soru Rural Municipality'],
            'BHA' => ['Bajhang' => 'Bajhang Municipality', 'JayaPrithvi' => 'Jaya Prithvi Rural Municipality'],
            'KAI' => ['Dhangadhi' => 'Dhangadhi Municipality', 'Lamkichuha' => 'Lamkichuha Municipality'],
            'KAN' => ['Mahakali' => 'Mahakali Municipality', 'Panchadewal' => 'Panchadewal Rural Municipality'],
            'DOT' => ['Doti' => 'Doti Municipality', 'Shikhar' => 'Shikhar Rural Municipality'],
            'DDL' => ['Dadeldhura' => 'Dadeldhura Municipality', 'Alital' => 'Alital Rural Municipality'],
            'BAI' => ['Baitadi' => 'Baitadi Municipality', 'Melauli' => 'Melauli Rural Municipality'],
            'BAJ' => ['Bajura' => 'Bajura Municipality', 'Budhiganga' => 'Budhiganga Rural Municipality'],
            'DAR' => ['Darchula' => 'Darchula Municipality', 'Api' => 'Api Rural Municipality'],
            'AAC' => ['Mangalsen' => 'Mangalsen Municipality', 'Kamalbazar' => 'Kamalbazar Municipality'],
        ];

        foreach ($provinces as $pCode => $pName) {
            $province = Province::create([
                'province_code' => $pCode,
                'name' => $pName,
                'is_active' => false,
            ]);

            foreach ($districts[$pCode] as $dCode => $dName) {
                $district = District::create([
                    'province_code' => $province->province_code, // link via code
                    'district_code' => $dCode,
                    'name' => $dName,
                    'is_active' => false,
                ]);

                if (isset($municipalities[$dCode])) {
                    foreach ($municipalities[$dCode] as $mCode => $mName) {
                        Municipality::create([
                            'district_code' => $district->district_code, // link via code
                            'municipality_code' => $mCode,
                            'name' => $mName,
                            'is_active' => false,
                        ]);
                    }
                }
            }
        }
    }
}