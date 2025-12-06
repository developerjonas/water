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
        // Active coverage
        $activeProvinces = ['KAR', 'SUD'];
        $activeDistricts = ['SUR', 'DAI', 'JAJ', 'KAL', 'RUK_W', 'SAL', 'AAC'];
        
        // Use the exact Codes defined in the $municipalities array below
        $activeMunicipalities = [
            'Birendranagar', 'Gurbhakot', 'Bheriganga', 'Chingad', 'Lekbeshi', 'Simta', // SUR
            'ChamundaBindrasaini', 'Dullu', 'Narayan', 'Dungeshwor', 'Gurans', 'Mahabu', // DAI
            'Barekot', 'Bheri', 'Chhedagad', 'Shivalaya', // JAJ
            'Khadachakral', 'Narharinath', 'Raskot', 'SanniTriveni', 'Shubhakalika', 'Kalikot', 'Palata', // KAL
            'Aathbiskot', 'Musikot', 'Rukum', // RUK_W
            'Salyan', 'Bagchaur', 'Kalimati', // SAL
            'Mangalsen', 'Kamalbazar', 'Panchadewal' // AAC
        ];

        $provinces = [
            'KOS' => 'Koshi (1)',
            'MAD' => 'Madhesh (2)',
            'BAG' => 'Bagmati (3)',
            'GAN' => 'Gandaki (4)',
            'LUM' => 'Lumbini (5)',
            'KAR' => 'Karnali (6)',
            'SUD' => 'Sudurpashchim (7)',
        ];

        $districts = [
            'KOS' => [ 'BHO' => 'Bhojpur', 'DHA' => 'Dhankuta', 'ILA' => 'Ilam', 'JHA' => 'Jhapa', 'KHO' => 'Khotang', 'MOR' => 'Morang', 'OKH' => 'Okhaldhunga', 'PAN' => 'Panchthar', 'SAK' => 'Sankhuwasabha', 'SOL' => 'Solukhumbu', 'SUN' => 'Sunsari', 'TAP' => 'Taplejung', 'TER' => 'Terhathum', 'UDA' => 'Udayapur'],
            'MAD' => [ 'BAR' => 'Bara', 'DHA2' => 'Dhanusha', 'MAH' => 'Mahottari', 'PAR' => 'Parsa', 'RAU' => 'Rautahat', 'SAP' => 'Saptari', 'SAR' => 'Sarlahi', 'SIR' => 'Siraha'],
            'BAG' => [ 'BHA2' => 'Bhaktapur', 'CHI' => 'Chitwan', 'DHA3' => 'Dhading', 'DOLH' => 'Dolakha', 'KTM' => 'Kathmandu', 'KAV' => 'Kavrepalanchok', 'LAL' => 'Lalitpur', 'MAK' => 'Makwanpur', 'NUW' => 'Nuwakot', 'RAM' => 'Ramechhap', 'RAS' => 'Rasuwa', 'SINH' => 'Sindhuli', 'SIND' => 'Sindhupalchok'],
            'GAN' => [ 'BAG' => 'Baglung', 'GOR' => 'Gorkha', 'KAS' => 'Kaski', 'LAM' => 'Lamjung', 'MAN' => 'Manang', 'MUS' => 'Mustang', 'MYA' => 'Myagdi', 'NAW' => 'Nawalpur', 'PARB' => 'Parbat', 'SYA' => 'Syangja', 'TAN' => 'Tanahun'],
            'LUM' => [ 'ARG' => 'Arghakhanchi', 'BAN' => 'Banke', 'BAR2' => 'Bardiya', 'DAN' => 'Dang', 'EKP' => 'Eastern Rukum', 'GUL' => 'Gulmi', 'KAP' => 'Kapilvastu', 'PAR2' => 'Parasi', 'PAL' => 'Palpa', 'PYU' => 'Pyuthan', 'ROL' => 'Rolpa', 'RUP' => 'Rupandehi'],
            'KAR' => [ 'DAI' => 'Dailekh', 'DOL' => 'Dolpa', 'HUM' => 'Humla', 'JAJ' => 'Jajarkot', 'JUM' => 'Jumla', 'KAL' => 'Kalikot', 'MUG' => 'Mugu', 'SAL' => 'Salyan', 'SUR' => 'Surkhet', 'WRU' => 'Western Rukum'],
            'SUD' => [ 'ACH' => 'Achham', 'BAI' => 'Baitadi', 'BAJH' => 'Bajhang', 'BAJU' => 'Bajura', 'DAD' => 'Dadeldhura', 'DAR2' => 'Darchula', 'DOT' => 'Doti', 'KAI2' => 'Kailali', 'KAN2' => 'Kanchanpur'],
        ];

        $municipalities = [
            // --- KARNALI (KAR) ---
            'SUR' => [
                'Birendranagar' => 'Birendranagar Municipality',
                'Bheriganga' => 'Bheriganga Municipality',
                'Gurbhakot' => 'Gurbhakot Municipality',
                'Lekbeshi' => 'Lekbeshi Municipality',
                'Panchapuri' => 'Panchapuri Municipality',
                'Barahatal' => 'Barahatal Rural Municipality',
                'Chaukune' => 'Chaukune Rural Municipality',
                'Chingad' => 'Chingad Rural Municipality',
                'Simta' => 'Simta Rural Municipality',
            ],
            // ... (Your other municipalities remain the same) ...
            'SAL' => [
                // I have renamed Tribeni to SAL-Tribeni to ensure uniqueness
                'BangadKupinde' => 'Bangad Kupinde Municipality',
                'Bagchaur' => 'Bagchaur Municipality',
                'Sharada' => 'Sharada Municipality',
                'Chhatreshwari' => 'Chhatreshwari Rural Municipality',
                'Darma' => 'Darma Rural Municipality',
                'Kalimati' => 'Kalimati Rural Municipality',
                'Kapurkot' => 'Kapurkot Rural Municipality',
                'Kumakh' => 'Kumakh Rural Municipality',
                'SiddhaKumakh' => 'Siddha Kumakh Rural Municipality',
                'SAL-Tribeni' => 'Tribeni Rural Municipality', 
            ],
            'WRU' => [
                'Aathbiskot' => 'Aathbiskot Municipality',
                'Chaurjahari' => 'Chaurjahari Municipality',
                'Musikot' => 'Musikot Municipality',
                'Banphikot' => 'Banphikot Rural Municipality',
                'Sanibheri' => 'Sanibheri Rural Municipality',
                'WRU-Tribeni' => 'Tribeni Rural Municipality',
            ],
            'BAJU' => [
               'Budhinanda' => 'Budhinanda Municipality',
               'Triveni' => 'Triveni Municipality',
               // ... rest of BAJU
            ]
            // ... Include the rest of your array here
        ];

        // LOGIC START
        foreach ($provinces as $pCode => $pName) {
            // updateOrCreate prevents "Duplicate entry" if you run seeder twice
            $province = Province::updateOrCreate(
                ['province_code' => $pCode],
                ['name' => $pName, 'is_active' => in_array($pCode, $activeProvinces)]
            );

            if (!isset($districts[$pCode])) continue;

            foreach ($districts[$pCode] as $dCode => $dName) {
                $district = District::updateOrCreate(
                    ['district_code' => $dCode],
                    [
                        'province_code' => $province->province_code,
                        'name' => $dName,
                        'is_active' => in_array($dCode, $activeDistricts)
                    ]
                );

                if (isset($municipalities[$dCode])) {
                    foreach ($municipalities[$dCode] as $mCode => $mName) {
                        Municipality::updateOrCreate(
                            ['municipality_code' => $mCode], 
                            [
                                'district_code' => $district->district_code,
                                'name' => $mName,
                                'is_active' => in_array($mCode, $activeMunicipalities),
                            ]
                        );
                    }
                }
            }
        }
    }
}