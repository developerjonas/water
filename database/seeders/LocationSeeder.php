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
        // Active coverage (2 Provinces, 7 Districts, 24 Municipalities)
        $activeProvinces = ['KAR', 'SUD'];
        $activeDistricts = ['SUR', 'DAI', 'JAJ', 'KAL', 'RUK_W', 'SAL', 'AAC'];
        $activeMunicipalities = [
            'Birendranagar',
            'Gurbhakot',
            'Bheriganga',
            'Chingad',
            'Lekbeshi',
            'Simta', // SUR
            'ChamundaBindrasaini',
            'Dullu',
            'Narayan',
            'Dungeshwor',
            'Gurans',
            'Mahabu', // DAI
            'Barekot',
            'Bheri',
            'Chhedagad',
            'Shivalaya', // JAJ
            'Khadachakral',
            'Narharinath',
            'Raskot',
            'SanniTriveni',
            'Shubhakalika',
            'Kalikot',
            'Palata', // KAL
            'Aathbiskot',
            'Music',
            'Rukum', // RUK_W
            'Salyan',
            'Bagchaur',
            'Kalimati', // SAL
            'Mangalsen',
            'Kamalbazar',
            'Panchadewal' // AAC
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

            'KOS' => [
                'BHO' => 'Bhojpur',
                'DHA' => 'Dhankuta',
                'ILA' => 'Ilam',
                'JHA' => 'Jhapa',
                'KHO' => 'Khotang',
                'MOR' => 'Morang',
                'OKH' => 'Okhaldhunga',
                'PAN' => 'Panchthar',
                'SAK' => 'Sankhuwasabha',
                'SOL' => 'Solukhumbu',
                'SUN' => 'Sunsari',
                'TAP' => 'Taplejung',
                'TER' => 'Terhathum',
                'UDA' => 'Udayapur',
            ],
            'MAD' => [
                'BAR' => 'Bara',
                'DHA2' => 'Dhanusha',
                'MAH' => 'Mahottari',
                'PAR' => 'Parsa',
                'RAU' => 'Rautahat',
                'SAP' => 'Saptari',
                'SAR' => 'Sarlahi',
                'SIR' => 'Siraha',
            ],
            'BAG' => [
                'BHA2' => 'Bhaktapur',
                'CHI' => 'Chitwan',
                'DHA3' => 'Dhading',
                'DOLH' => 'Dolakha',
                'KTM' => 'Kathmandu',
                'KAV' => 'Kavrepalanchok',
                'LAL' => 'Lalitpur',
                'MAK' => 'Makwanpur',
                'NUW' => 'Nuwakot',
                'RAM' => 'Ramechhap',
                'RAS' => 'Rasuwa',
                'SINH' => 'Sindhuli',
                'SIND' => 'Sindhupalchok',
            ],
            'GAN' => [
                'BAG' => 'Baglung',
                'GOR' => 'Gorkha',
                'KAS' => 'Kaski',
                'LAM' => 'Lamjung',
                'MAN' => 'Manang',
                'MUS' => 'Mustang',
                'MYA' => 'Myagdi',
                'NAW' => 'Nawalpur',
                'PARB' => 'Parbat',
                'SYA' => 'Syangja',
                'TAN' => 'Tanahun',
            ],
            'LUM' => [
                'ARG' => 'Arghakhanchi',
                'BAN' => 'Banke',
                'BAR2' => 'Bardiya',
                'DAN' => 'Dang',
                'EKP' => 'Eastern Rukum',
                'GUL' => 'Gulmi',
                'KAP' => 'Kapilvastu',
                'PAR2' => 'Parasi',
                'PAL' => 'Palpa',
                'PYU' => 'Pyuthan',
                'ROL' => 'Rolpa',
                'RUP' => 'Rupandehi',
            ],
            'KAR' => [
                'DAI' => 'Dailekh',
                'DOL' => 'Dolpa',
                'HUM' => 'Humla',
                'JAJ' => 'Jajarkot',
                'JUM' => 'Jumla',
                'KAL' => 'Kalikot',
                'MUG' => 'Mugu',
                'SAL' => 'Salyan',
                'SUR' => 'Surkhet',
                'WRU' => 'Western Rukum',
            ],
            'SUD' => [
                'ACH' => 'Achham',
                'BAI' => 'Baitadi',
                'BAJH' => 'Bajhang',
                'BAJU' => 'Bajura',
                'DAD' => 'Dadeldhura',
                'DAR2' => 'Darchula',
                'DOT' => 'Doti',
                'KAI2' => 'Kailali',
                'KAN2' => 'Kanchanpur',
            ],
        ];

        // District -> Municipalities (slug => full official name)
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
            'DAI' => [
                'Aathabis' => 'Aathabis Municipality',
                'ChamundaBindrasaini' => 'Chamunda Bindrasaini Municipality',
                'Dullu' => 'Dullu Municipality',
                'Narayan' => 'Narayan Municipality',
                'Bhairabi' => 'Bhairabi Rural Municipality',
                'Bhagawatimai' => 'Bhagawatimai Rural Municipality',
                'Dungeshwar' => 'Dungeshwar Rural Municipality',
                'Gurans' => 'Gurans Rural Municipality',
                'Mahabu' => 'Mahabu Rural Municipality',
                'Naumule' => 'Naumule Rural Municipality',
                'Thantikandh' => 'Thantikandh Rural Municipality',
            ],
            'JAJ' => [
                'Bheri' => 'Bheri Municipality',
                'Chhedagad' => 'Chhedagad Municipality',
                'Nalgad' => 'Nalgad Municipality',
                'Barekot' => 'Barekot Rural Municipality',
                'Junichande' => 'Junichande Rural Municipality',
                'Kushe' => 'Kushe Rural Municipality',
                'Shivalaya' => 'Shivalaya Rural Municipality',
            ],
            'JUM' => [
                'Chandannath' => 'Chandannath Municipality',
                'Guthichaur' => 'Guthichaur Rural Municipality',
                'Hima' => 'Hima Rural Municipality',
                'Kanakasundari' => 'Kanakasundari Rural Municipality',
                'Patarasi' => 'Patarasi Rural Municipality',
                'Sinja' => 'Sinja Rural Municipality',
                'Tatopani' => 'Tatopani Rural Municipality',
                'Tila' => 'Tila Rural Municipality',
            ],
            'DOL' => [
                'ThuliBheri' => 'Thuli Bheri Municipality',
                'Tripurasundari' => 'Tripurasundari Municipality',
                'DolpoBuddha' => 'Dolpo Buddha Rural Municipality',
                'Jagadulla' => 'Jagadulla Rural Municipality',
                'Kaike' => 'Kaike Rural Municipality',
                'Mudkechula' => 'Mudkechula Rural Municipality',
                'SheyPhoksundo' => 'Shey Phoksundo Rural Municipality',
            ],
            'HUM' => [
                'Simkot' => 'Simkot Municipality',
                'Adanchuli' => 'Adanchuli Rural Municipality',
                'Chankheli' => 'Chankheli Rural Municipality',
                'Kharpunath' => 'Kharpunath Rural Municipality',
                'Namkha' => 'Namkha Rural Municipality',
                'Sarkegad' => 'Sarkegad Rural Municipality',
                'Tanjakot' => 'Tanjakot Rural Municipality',
            ],
            'KAL' => [
                'Khandachakra' => 'Khandachakra Municipality',
                'Raskot' => 'Raskot Municipality',
                'Tilagufa' => 'Tilagufa Municipality',
                'Mahawai' => 'Mahawai Rural Municipality',
                'Naraharinath' => 'Naraharinath Rural Municipality',
                'Pachaljharana' => 'Pachaljharana Rural Municipality',
                'Palata' => 'Palata Rural Municipality',
                'SanniTriveni' => 'Sanni Triveni Rural Municipality',
            ],
            'MUG' => [
                'ChhayanathRara' => 'Chhayanath Rara Municipality',
                'Khatyad' => 'Khatyad Rural Municipality',
                'MugumKarmarong' => 'Mugum Karmarong Rural Municipality',
                'Soru' => 'Soru Rural Municipality',
            ],
            'SAL' => [
                'BangadKupinde' => 'Bangad Kupinde Municipality',
                'Bagchaur' => 'Bagchaur Municipality',
                'Sharada' => 'Sharada Municipality',
                'Chhatreshwari' => 'Chhatreshwari Rural Municipality',
                'Darma' => 'Darma Rural Municipality',
                'Kalimati' => 'Kalimati Rural Municipality',
                'Kapurkot' => 'Kapurkot Rural Municipality',
                'Kumakh' => 'Kumakh Rural Municipality',
                'SiddhaKumakh' => 'Siddha Kumakh Rural Municipality',
                'Tribeni' => 'Tribeni Rural Municipality',
            ],
            'WRU' => [
                'Aathbiskot' => 'Aathbiskot Municipality',
                'Chaurjahari' => 'Chaurjahari Municipality',
                'Musikot' => 'Musikot Municipality',
                'Banphikot' => 'Banphikot Rural Municipality',
                'Sanibheri' => 'Sanibheri Rural Municipality',
                'Tribeni' => 'Tribeni Rural Municipality',
            ],

            // --- SUDURPASCHIM (SUD) ---
            'ACH' => [
                'Kamalbazar' => 'Kamalbazar Municipality',
                'Mangalsen' => 'Mangalsen Municipality',
                'PanchadewalBinayak' => 'Panchadewal Binayak Municipality',
                'Sanphebagar' => 'Sanphebagar Municipality',
                'BannigadhiJayagadh' => 'Bannigadhi Jayagadh Rural Municipality',
                'Chaurpati' => 'Chaurpati Rural Municipality',
                'Dhakari' => 'Dhakari Rural Municipality',
                'Mellekh' => 'Mellekh Rural Municipality',
                'Ramaroshan' => 'Ramaroshan Rural Municipality',
                'Turmakhand' => 'Turmakhand Rural Municipality',
            ],
            'BAI' => [
                'Dasharathchand' => 'Dasharathchand Municipality',
                'Melauli' => 'Melauli Municipality',
                'Patan' => 'Patan Municipality',
                'Purchaudi' => 'Purchaudi Municipality',
                'Dilasaini' => 'Dilasaini Rural Municipality',
                'Dogdakedar' => 'Dogdakedar Rural Municipality',
                'Pancheshwar' => 'Pancheshwar Rural Municipality',
                'Shivanath' => 'Shivanath Rural Municipality',
                'Sigas' => 'Sigas Rural Municipality',
                'Surnaya' => 'Surnaya Rural Municipality',
            ],
            'BAJH' => [
                'JayaPrithvi' => 'Jaya Prithvi Municipality',
                'Bungal' => 'Bungal Municipality',
                'Bitthadchir' => 'Bitthadchir Rural Municipality',
                'ChhabisPathibhera' => 'Chhabis Pathibhera Rural Municipality',
                'Durgathali' => 'Durgathali Rural Municipality',
                'Kedarsyu' => 'Kedarsyu Rural Municipality',
                'Masta' => 'Masta Rural Municipality',
                'Surma' => 'Surma Rural Municipality',
                'Talkot' => 'Talkot Rural Municipality',
                'Thalara' => 'Thalara Rural Municipality',
            ],
            'BAJU' => [
                'Budhinanda' => 'Budhinanda Municipality',
                'Triveni' => 'Triveni Municipality',
                'Badimalika' => 'Badimalika Municipality',
                'Budhiganga' => 'Budhiganga Rural Municipality',
                'Chhededaha' => 'Chhededaha Rural Municipality',
                'Gaumul' => 'Gaumul Rural Municipality',
                'Himali' => 'Himali Rural Municipality',
                'Jagannath' => 'Jagannath Rural Municipality',
                'SwamikartikKhapar' => 'Swamikartik Khapar Rural Municipality',
            ],
            'DAD' => [
                'Amargadhi' => 'Amargadhi Municipality',
                'Parshuram' => 'Parshuram Municipality',
                'Aalital' => 'Aalital Rural Municipality',
                'Ajaymeru' => 'Ajaymeru Rural Municipality',
                'Bhageshwar' => 'Bhageshwar Rural Municipality',
                'Ganyapadhura' => 'Ganyapadhura Rural Municipality',
                'Navadurga' => 'Navadurga Rural Municipality',
            ],
            'DAR2' => [
                'Mahakali' => 'Mahakali Municipality',
                'Shailyashikhar' => 'Shailyashikhar Municipality',
                'Apihimal' => 'Apihimal Rural Municipality',
                'Byas' => 'Byas Rural Municipality',
                'Duhun' => 'Duhun Rural Municipality',
                'Lekam' => 'Lekam Rural Municipality',
                'Malikarjun' => 'Malikarjun Rural Municipality',
                'Marma' => 'Marma Rural Municipality',
                'Naugad' => 'Naugad Rural Municipality',
            ],
            'DOT' => [
                'DipayalSilgadhi' => 'Dipayal Silgadhi Municipality',
                'Shikhar' => 'Shikhar Municipality',
                'Aadarsha' => 'Aadarsha Rural Municipality',
                'Badikedar' => 'Badikedar Rural Municipality',
                'BogtanPhudsil' => 'Bogtan Phudsil Rural Municipality',
                'Jorayal' => 'Jorayal Rural Municipality',
                'KISingh' => 'K.I. Singh Rural Municipality',
                'Purbichauki' => 'Purbichauki Rural Municipality',
            ],
            'KAI2' => [
                'Dhangadhi' => 'Dhangadhi Sub-Metropolitan City',
                'Lamkichuha' => 'Lamkichuha Municipality',
                'Tikapur' => 'Tikapur Municipality',
                'Ghodaghodi' => 'Ghodaghodi Municipality',
                'Bhajani' => 'Bhajani Municipality',
                'Godawari' => 'Godawari Municipality',
                'Gauriganga' => 'Gauriganga Municipality',
                'Bardagoriya' => 'Bardagoriya Rural Municipality',
                'Chure' => 'Chure Rural Municipality',
                'Janaki' => 'Janaki Rural Municipality',
                'Joshipur' => 'Joshipur Rural Municipality',
                'Kailari' => 'Kailari Rural Municipality',
                'Mohanyal' => 'Mohanyal Rural Municipality',
            ],
            'KAN2' => [
                'Bhimdatta' => 'Bhimdatta Municipality',
                'Krishnapur' => 'Krishnapur Municipality',
                'Mahakali' => 'Mahakali Municipality',
                'Punarbas' => 'Punarbas Municipality',
                'Shuklaphanta' => 'Shuklaphanta Municipality',
                'Bedkot' => 'Bedkot Municipality',
                'Belauri' => 'Belauri Municipality',
                'Beldandi' => 'Beldandi Rural Municipality',
                'Laljhadi' => 'Laljhadi Rural Municipality',
            ],
        ];


        foreach ($provinces as $pCode => $pName) {
            $province = Province::create([
                'province_code' => $pCode,
                'name' => $pName,
                'is_active' => in_array($pCode, $activeProvinces),
            ]);

            foreach ($districts[$pCode] as $dCode => $dName) {
                $district = District::create([
                    'province_code' => $province->province_code,
                    'district_code' => $dCode,
                    'name' => $dName,
                    'is_active' => in_array($dCode, $activeDistricts),
                ]);

                if (isset($municipalities[$dCode])) {
                    foreach ($municipalities[$dCode] as $mCode => $mName) {
                        Municipality::create([
                            'district_code' => $district->district_code,
                            'municipality_code' => $mCode,
                            'name' => $mName,
                            'is_active' => in_array($mCode, $activeMunicipalities),
                        ]);
                    }
                }
            }
        }
    }
}
